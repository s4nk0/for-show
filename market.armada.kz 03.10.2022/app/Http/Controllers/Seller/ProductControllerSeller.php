<?php

namespace App\Http\Controllers\Seller;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Services\ProductService;
use App\Http\Services\Service;
use App\Imports\ProductImport;
use App\Models\Catalog;
use App\Models\Color;
use App\Models\Country;
use App\Models\Item;
use App\Models\Presence;
use App\Models\Product;
use App\Models\ProductStore;
use App\Models\Store;
use App\Models\Subcatalog;
use App\Models\Tarif;
use App\Models\TypeDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Mtownsend\XmlToArray\XmlToArray;
use Rap2hpoutre\FastExcel\FastExcel;

class ProductControllerSeller extends Controller
{
    protected $service;
    protected $productService;

    public function __construct(Service $service, ProductService $productService)
    {
        $this->service = $service;
        $this->productService = $productService;
    }

    public function index()
    {
        $storeIds = Store::where('user_id',Auth::id())
            ->pluck('id');
        $productsQuery = Product::whereIn('store_id',$storeIds);
        $countryIds = Product::whereIn('store_id',$storeIds)->pluck('country_id')->unique();
        $countries = Country::isActive()->whereIn('id',$countryIds)->select('id','title_ru','title_kz')->get();
        $priceMin = Product::whereIn('store_id',$storeIds)->min('price');
        $priceMax = Product::whereIn('store_id',$storeIds)->max('price');

        $all_item_ids = Product::whereIn('store_id',$storeIds)->pluck('item_id');
        $items = Item::whereIn('id',$all_item_ids)
            ->select('id','subcatalog_id','title')
            ->with('subcatalog:id,title,catalog_id','subcatalog.catalog:id,title')
            ->get();

        $productsQuery = $this->productService->filter($productsQuery);

        $products = $productsQuery->select('id','isActive','is_delivery','title','item_id','articul','store_id','images','price','presence_id','created_at','updated_at')
            ->where('item_id','!=',Item::DISCOUNT_ZONE_ID)
            ->orderBy('updated_at', 'desc')
            ->with('store','items','items.subcatalog','items.subcatalog.catalog')
            ->get();
        $is_import_csv = $products->pluck('store.is_import_csv');

        $stores = Store::where('user_id',Auth::id())->select('id', 'title')->get();

        return view('sellers.products.index',compact('products','countries','priceMin','priceMax','items', 'is_import_csv', 'stores'));
    }

    public function create()
    {
        $stores = $this->productService->getForCredit_stores();
        $this->productService->ifNotStore($stores);

        $items = $this->productService->getForCredit_items();
        $subcatalogs = $this->productService->getForCredit_subcatalogs($items);
        $catalogs = $this->productService->getForCredit_catalogs($subcatalogs)->where('onlyAdmins', 0);
        $countries = $this->productService->getForCredit_countries();
        $colors = $this->productService->getForCredit_colors();
        $presences = $this->productService->getForCredit_presences();
        $deliveries = $this->productService->getForCredit_deliveries();
        $pays = $this->productService->getForCredit_pays();

        return view('sellers.products.credit',compact('stores','catalogs','subcatalogs','items','countries','colors','presences','deliveries','pays'));
    }

    public function store(Request $request)
    {
        if($this->productService->ifNotTarif($request->store_id) != null)
        {
            return redirect()->route('seller.products.index')->with('error',$this->productService->ifNotTarif($request->store_id))->send();
        }
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric|min:100',
        ]);

        if ($validator->fails()) {
            return redirect()->route('seller.products.index')->with('error','???????? ???????????? ???????? ???????????? 100');
        }

        $data = Product::add($request->all());

        $items = $this->productService->getForCredit_item_by_id($request->item_id);
        $subcatalogs = $this->productService->getForCredit_subcatalogs($items);
        $catalogs = $this->productService->getForCredit_catalogs($subcatalogs);
        $data->isBoolean($request,'is_discount');
        $items = $this->productService->getForCredit_item_by_id($request->item_id);
        $subcatalogs = $this->productService->getForCredit_subcatalogs($items);
        $catalogs = $this->productService->getForCredit_catalogs($subcatalogs);
        $data->user_id = Auth::id();
        $data->subcatalog_id = $subcatalogs[0]->id;
        $data->catalog_id = $catalogs[0]->id;

        $data->uploadDataImages($request->images,'images', 'webp',null, true);
        $data->isBoolean($request,'isActive');
        $data->isJson($request,'colors');
        $data->isJson($request,'delivery_ids');
        $data->isJson($request,'pay_ids');
        $data->isBoolean($request,'is_price_from');
        $data->isBoolean($request,'is_price_none');
        $data->save();

        return redirect()->route('seller.products.index')->with('success','???????????????????? ??????????????????');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->productService->isProductInDiscountZone($id);
//        $data = $this->productService->replaceQuotation(Product::findOrFail($id));
        $data = Product::findOrFail($id);
        $this->service->ifNotAdmin($data);

        $stores = $this->productService->getForCredit_stores();
        $this->productService->ifNotStore($stores);
        $this->productService->replaceWithOldData($data);

        $items = $this->productService->getForCredit_items();
        $subcatalogs = $this->productService->getForCredit_subcatalogs($items);
        $catalogs = $this->productService->getForCredit_catalogs($subcatalogs)->where('onlyAdmins', 0);
        $countries = $this->productService->getForCredit_countries();
        $colors = $this->productService->getForCredit_colors();
        $presences = $this->productService->getForCredit_presences();
        $deliveries = $this->productService->getForCredit_deliveries();
        $pays = $this->productService->getForCredit_pays();

        return view('sellers.products.credit',compact('data','stores','catalogs','subcatalogs','items','countries','colors','presences','deliveries','pays'));
    }

    public function update(Request $request, $id)
    {
        $data = Product::findOrFail($id);
        $this->service->ifNotAdmin($data);

        $items = $this->productService->getForCredit_item_by_id($request->item_id);
        $subcatalogs = $this->productService->getForCredit_subcatalogs($items);
        $catalogs = $this->productService->getForCredit_catalogs($subcatalogs);

        $data->edit($request->all() + ['subcatalog_id' => $subcatalogs[0]->id,'catalog_id' => $catalogs[0]->id]);
        $data->user_id = Auth::id();
        $data->uploadDataImages($request->images,'images', 'webp',null, true);
        $data->isBoolean($request,'isActive');
        $data->isJson($request,'colors');
        $data->isJson($request,'delivery_ids');
        $data->isJson($request,'pay_ids');
        $data->isBoolean($request,'is_price_from');
        $data->isBoolean($request,'is_price_none');
        $data->isBoolean($request,'is_discount');
        $data->save();

        return redirect()->route('seller.products.index')->with('success','???????????????????? ??????????????????');
    }

    public function destroy($id)
    {
        $id = explode(',', $id);

        if(!is_array($id))
        {
            $id[] = $id;
        }

        foreach ($id as $item)
        {
            $data = Product::find($item);
            $this->service->ifNotAdmin($data);
            $data->delete();
        }

        if(count($id) > 1) {
            return back()->with('success','???????????? ??????????????');
        } else {
            return back()->with('success','?????????? ????????????');
        }
    }

//    public function selectSubcatalogs(Request $request)
//    {
//        $subcatalogIds = Item::pluck('subcatalog_id')->unique();
//        $subcatalogs = Subcatalog::where('catalog_id',$request->catalog_id)->whereIn('id',$subcatalogIds)->pluck('title','id');
//        $data = '<option value="" disabled selected>???????????????? ???? ????????????</option>';
//        foreach ($subcatalogs as $key=>$value)
//        {
//            $data = $data . '<option value="' . $key . '">' . $value . '</option>';
//        }
//        return response($data);
//    }
//
//    public function selectItems(Request $request)
//    {
//        $items = Item::where('subcatalog_id',$request->subcatalog_id)->pluck('title','id');
//        $data = '<option value="" disabled selected>???????????????? ???? ????????????</option>';
//        foreach ($items as $key=>$value)
//        {
//            $data = $data . '<option value="' . $key . '">' . $value . '</option>';
//        }
//        return response($data);
//    }

    private function  XmlGetData()
    {
        $storeIds = Store::where('user_id',Auth::id())
            ->pluck('id');
        $productsQuery = Product::whereIn('store_id',$storeIds);

        $products = $productsQuery->select('id','manufacture','country_id','width','height','depth','colors','is_delivery','delivery_type','seo_title','meta_description','meta_tags','isActive','title','status','user_id','item_id','articul','store_id','images','price','price_2','stock','created_at','updated_at','description')
            ->with('store')
            ->get();

        return $products;
    }

    public function exportdata($file_type)
    {

        $storeId = Store::where('user_id',Auth::id())
            ->select('id')->first();


        if($file_type == Product::XML_IMPORT.'file'){
            $data=$this->XmlGetData();
            // dd($data);
            $dom = new \DOMDocument();

            $dom->encoding = 'utf-8';

            $dom->xmlVersion = '1.0';

            $dom->formatOutput = true;
            $root = $dom->createElement('products');

            foreach ($data as $item)
            {
                $product_node = $dom->createElement('product');

                $child_node_id = $dom->createElement('id', $item->id);
                $product_node->appendChild($child_node_id);

                //     $product_node->appendChild($attr_product_id);
                $child_node_title = $dom->createElement('Title', $item->title);
                $product_node->appendChild($child_node_title);
                $child_node_isActive = $dom->createElement('IsActive', $item->isActive);
                $product_node->appendChild($child_node_isActive);
                //status
                $child_node_status = $dom->createElement('productstatus', $item->status);
                $product_node->appendChild($child_node_status);

                //end
                //user_id
                $child_node_userId = $dom->createElement('userId', $item->user_id);
                $product_node->appendChild($child_node_userId);

                //end
                //item id
                $child_node_itemId = $dom->createElement('itemId', $item->item_id);
                $product_node->appendChild($child_node_itemId);

                //end
                //articul
                $child_node_sku = $dom->createElement('sku', $item->articul);
                $product_node->appendChild($child_node_sku);

                //end
                //store_id
                $child_node_storeId = $dom->createElement('storeId', $item->store_id);
                $product_node->appendChild($child_node_storeId);

                //end
                //images
                $images=array();
                $images=$item->images;
                //dd($images);
                if (is_array($images))
                {
                    //dd('images');
                    foreach ($images as $image) {
                        if (!is_array($image)) {

                            // dd($image);
                            $child_node_image = $dom->createElement('image', $image);
                            $product_node->appendChild($child_node_image);
                        }
                        else
                        {
                            //  dd($image);
                            foreach ($image as $img)
                            {
                                $child_node_image = $dom->createElement('image', $img);
                                $product_node->appendChild($child_node_image);
                            }
                        }

                    }
                }

                //end
                //price
                $child_node_price = $dom->createElement('price', $item->price);
                $product_node->appendChild($child_node_price);

                //end

                //price2
                $child_node_price2 = $dom->createElement('price2', $item->price_2);
                $product_node->appendChild($child_node_price2);

                //end
                //stock
                $child_node_stock = $dom->createElement('stock', $item->stock);
                $product_node->appendChild($child_node_stock);

                //end
                //createdAt
                $child_node_createdAt = $dom->createElement('createdAt', $item->created_at);
                $product_node->appendChild($child_node_createdAt);

                //end

                //updatedAt
                $child_node_updateddAt = $dom->createElement('updateddAt', $item->updated_at);
                $product_node->appendChild($child_node_updateddAt);

                //end
                //description
                $child_node_description = $dom->createElement('description', htmlentities($item->description, ENT_XML1));
                $product_node->appendChild($child_node_description);

                //end
                //country_id
                $child_node_countryId = $dom->createElement('countryId', $item->country_id);
                $product_node->appendChild($child_node_countryId);

                //end
                //manufacture
                $child_node_manufacture = $dom->createElement('manufacturer', $item->manufacture);
                $product_node->appendChild($child_node_manufacture);

                //end
                //width
                $child_node_width = $dom->createElement('width', $item->width);
                $product_node->appendChild($child_node_width);

                //end
                //height
                $child_node_height = $dom->createElement('height', $item->height);
                $product_node->appendChild($child_node_height);

                //end
                //depth
                $child_node_depth = $dom->createElement('depth', $item->depth);
                $product_node->appendChild($child_node_depth);

                //end
                //colors
                if (is_array($item->colors))
                {
                    foreach ($item->colors as $color)
                    {
                        //echo $image;
                        if (!is_array($color)) {

                            // dd($image);
                            $child_node_color = $dom->createElement('color', $color);
                            $product_node->appendChild($child_node_color);
                        }
                        else
                        {
                            // dd($color);
                            foreach ($color as $col)
                            {
                                $child_node_color = $dom->createElement('color', $col);
                                $product_node->appendChild($child_node_color);
                            }
                        }

                    }
                }
                //end
                //is delivery
                $child_node_isDelivery = $dom->createElement('isDelivery', $item->is_delivery);
                $product_node->appendChild($child_node_isDelivery);

                //end
                //delivery_type
                if (is_array($item->delivery_type))
                {
                    foreach ($item->delivery_type as $delivery)
                    {
                        //echo $image;
                        if (!is_array($delivery)) {

                            // dd($image);
                            $child_node_deliveryType = $dom->createElement('deliveryType', $delivery);
                            $product_node->appendChild($child_node_deliveryType);
                        }
                        else
                        {
                            //dd($delivery);
                            foreach ($delivery as $del)
                            {
                                $child_node_deliveryType = $dom->createElement('deliveryType', $del);
                                $product_node->appendChild($child_node_deliveryType);
                            }
                        }

                    }
                }
                //end
                //seo_title
                $child_node_seoTitle = $dom->createElement('seoTitle', $item->seo_title);
                $product_node->appendChild($child_node_seoTitle);

                //end
                //meta_description
                $child_node_metaDescription = $dom->createElement('metaDescription', $item->meta_description);
                $product_node->appendChild($child_node_metaDescription);

                //end
                //meta_tags
                $child_node_metaTags = $dom->createElement('metaTags', $item->meta_tags);
                $product_node->appendChild($child_node_metaTags);

                //end
                // print_r($item->title);
                $root->appendChild($product_node);
            }

            $dom->appendChild($root);
            return response()->xmlProduct($dom->saveXML());
        }elseif ($file_type == Product::CSV_IMPORT){
            return Excel::download(new ProductExport($storeId->id),'products.csv',
                \Maatwebsite\Excel\Excel::CSV);


        }elseif ($file_type == Product::XLSX_IMPORT){
            return Excel::download(new ProductExport($storeId->id),'products.xlsx',
                \Maatwebsite\Excel\Excel::XLSX);
        }


    }

    public  function importxmldata()
    {
        return view('sellers.products.xmlUpload');
    }

    public  function importxmldatapost(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,txt,xml|max:20000',
        ]);

        $storeId = Store::where('user_id',Auth::id())
            ->select('id')->first();

        if($request->file->getClientOriginalExtension() == Product::XLSX_IMPORT){
            Excel::import(new ProductImport($storeId->id),$request->file('file'),\Maatwebsite\Excel\Excel::XLSX);

        }elseif ($request->file->getClientOriginalExtension() == Product::CSV_IMPORT){
            Excel::import(new ProductImport($storeId->id),$request->file('file'),\Maatwebsite\Excel\Excel::CSV);

        }elseif($request->file->getClientOriginalExtension() == Product::XML_IMPORT){
            $fileName = time().'.'.$request->file->extension();
            $id = Auth::id();
            $request->file->move(public_path('imports/xml/'.$id.'/'), $fileName);
            $path=public_path('imports/xml/'.$id.'/'.$fileName);
            $this->Importxml($path,$storeId->id);
        }

        return back();
    }

    private function Importxml($path,$import_store_id)
    {
        $storeIds = Store::where('user_id',Auth::id())
            ->get('id')->toArray();
        $ids=array();

        foreach ($storeIds as $id)
        {
            $ids[]=$id['id'];
        }
        // dd($ids);
        $xml=file_get_contents($path);
        $data = XmlToArray::convert($xml);
			$images=array();
        $product=new Product();
        if(count($data['product'])>1) {
            for ($i=0; $i<count($data['product']); $i++) {
                // $product = Product::updateOrInsert(array('id' => $data['product'][$i]['id'],'title'=>$data['product'][$i]['Title']));

                $product->title = $data['product'][$i]['Title'];
                if($data['product'][$i]['IsActive']!='0' && $data['product'][$i]['IsActive']!='1')
                {
                    // dd($data['product'][$i]['IsActive']);
                    die('???? ?????????? ?????????????? ???????????????? IsActive ?? ???????????????? ?? ??????????????????????????????'.$data['product'][$i]['id']);
                }

                $product->isActive = $data['product'][$i]['IsActive'];
                if($data['product'][$i]['status']='0' && $data['product'][$i]['status']!='1')
                {
                    // dd($data['product'][$i]['IsActive']);
                    die('???? ?????????? ?????????????? ???????????????? status ?? ???????????????? ?? ??????????????????????????????'.$data['product'][$i]['id']);

                }

                $product->status = $data['product'][$i]['status'];
                //  dd($data['product'][$i]['productstatus']);
//                if ($data['product'][$i]['userId'] == '0') {
//                    $userId = Auth::id();
//                } else {
//                    $userId = $data['product'][$i]['userId'];
//
//                }

                if ($data['product'][$i]['itemId'] != null) {
                    $itemId = $data['product'][$i]['itemId'];
                } else {
                    die("???? ?????????? ???????????? ItemID ?? ???????????????? ?? ??????????????????????????????".$data['product'][$i]['id']);
                }

                if($data['product'][$i]['sku']==null)
                {
                    die('???? ?????????? ?????????????? ???????????????? sku ?? ???????????????? ?? ??????????????????????????????'.$data['product'][$i]['id']);

                }
                $sku = $data['product'][$i]['sku'];
                //dd($sku);


                // dd($ids);

//                if(count($ids) > 0){
//                    if (!in_array($data['product'][$i]['storeId'],$ids)){
//
//                        // dd($storeIds);
//                        //   dd($stores);
//                        die('???? ?????????? ?????????????? ???????????????? StoreId ?? ???????????????? ?? ??????????????????????????????' .  $data['product'][$i]['id'] ?? '');
//                    }
//                }



                //  dd($data['product'][$i]['storeId']);

                $store_id =  $import_store_id;
                //  $product->images  = $data['product'][$i]['image'];
                // $img=json_encode($data['product'][$i]['image']);
                //dd($img);
                //$product->images = $img;


                if (isset($data['product'][$i]['image'])) {
//		$counter=count($data['product'][$i]['image']);
                    //dd($counter);
                    if(is_array($data['product'][$i]['image']))
                    {
                        $images= $data['product'][$i]['image'];
                    }
                    else
                    {
                        $images[]= $data['product'][$i]['image'];

                    }


                }

                $price = $data['product'][$i]['price'];
                if ($data['product'][$i]['price2'] != null) {
                    $price2 = $data['product'][$i]['price2'];
                }
                else
                {
                    $price2=0;
                }
                if ($data['product'][$i]['stock'] != null) {
                    if (preg_match('/^[0-9]+$/', $data['product'][$i]['stock'])) {
                        //dd($stock);
                        $stock = $data['product'][$i]['stock'];

                    }
                    else
                    {
                        die('???? ?????????? ?????????????? ???????????????? stock ?? ???????????????? ?? ??????????????????????????????'.$data['product'][$i]['id']);
                    }

                }
                else
                {
                    $stock=0;
                }
                //dd($data['product'][$i]['description']);
                if ($data['product'][$i]['description']!=null) {
                    $description = $data['product'][$i]['description'];
                    // dd($description);

                }
                else
                {
                    $description='';
                }
                if ($data['product'][$i]['countryId'] != null) {

                    if (preg_match('/^[0-9]+$/', $data['product'][$i]['countryId'])) {

                        $country = $data['product'][$i]['countryId'];
                        //dd($country);
                    }
                    else
                    {
                        die('???? ?????????? ?????????????? ???????????????? country_id ?? ???????????????? ?? ??????????????????????????????'.$data['product'][$i]['id']);

                    }
                }

                else
                {
                    $country=0;
                }
                if ($data['product'][$i]['manufacturer'] != null) {


                    $manufacturer = $data['product'][$i]['manufacturer'] ?? '';

                }

                if ($data['product'][$i]['width'] != null) {
                    if (preg_match('/^[0-9]+$/', $data['product'][$i]['width'])) {
                        $width = $data['product'][$i]['width'];
                    }
                    else
                    {
                        die('???? ?????????? ?????????????? ???????????????? productWidth ?? ???????????????? ?? ??????????????????????????????'.$data['product'][$i]['id']);
                    }
                }
                if ($data['product'][$i]['height'] != null) {
                    if (preg_match('/^[0-9]+$/', $data['product'][$i]['height'])) {
                        $height=$data['product'][$i]['height'];
                    }
                    else
                    {
                        die('???? ?????????? ?????????????? ???????????????? productHeight ?? ???????????????? ?? ??????????????????????????????'.$data['product'][$i]['id']);
                    }
                }

                if ($data['product'][$i]['depth'] != null) {
                    if (preg_match('/^[0-9]+$/', $data['product'][$i]['depth'])) {

                        $depth=$data['product'][$i]['depth'];
                    }
                    else
                    {
                        die('???? ?????????? ?????????????? ???????????????? productDepth ?? ???????????????? ?? ??????????????????????????????'.$data['product'][$i]['id']);
                    }
                }

                if (isset($data['product'][$i]['color'])) {

                    $colors[] = $data['product'][$i]['color'];
                }
                else
                {
                    $colors=null;
                }
                if ($data['product'][$i]['isDelivery']!=null) {
                    if($data['product'][$i]['isDelivery']!='0' && $data['product'][$i]['isDelivery']!='1')
                    {
                        // dd($data['product'][$i]['isDelivery']);
                        die('???? ?????????? ?????????????? ???????????????? isDelivery ?? ???????????????? ?? ??????????????????????????????'.$data['product'][$i]['id']);
                    }

                    $isDelivery = $data['product'][$i]['isDelivery'];
                }
                if (isset($data['product'][$i]['deliveryType'])) {

                    $deliveryType[] = $data['product'][$i]['deliveryType'];
                }else{
                    $deliveryType[] = null;
                }

                if ($data['product'][$i]['seoTitle']!=null) {

                    $seoTitle = $data['product'][$i]['seoTitle'];
                }
                if ($data['product'][$i]['metaDescription']!=null) {

                    $metaDescription = $data['product'][$i]['metaDescription'];

                }
                if ($data['product'][$i]['metaTags']!=null) {

                    $metaTags = $data['product'][$i]['metaTags'];

                }

                // $product = Product::updateOrInsert(array('id' => $data['product'][$i]['id']));
                //dd($data['product'][$i]);
                //dd($data['product'][$i]['Title']);
                $product = new Product();
                //dd($images);

                $product->title=$data['product'][$i]['Title'];
                $product->isActive=$data['product'][$i]['IsActive'];
                $product->status=$data['product'][$i]['productstatus'];
                $product->item_id=$itemId;
                $product->store_id=$store_id;

//                $product->images=$images;
                $product->price=$price;
                $product->price_2=$price2;
                $product->stock=$stock;
                $product->description=$description;
                $product->country_id=$country;
                $product->manufacture=$manufacturer ?? '';
                $product->width=$width ?? '';
                $product->height=$height ?? '';
                $product->depth=$depth ?? '';
                $product->is_delivery=$isDelivery;
                $product->delivery_ids=$deliveryType[0];
                $product->seo_title=$seoTitle ?? '';
                $product->meta_description=$metaDescription ?? '';
                $product->meta_tags=$metaTags ?? '';
                $product->articul=$sku;
                $product->colors=$colors;


                $product->save();

                //????????????????
                unset($images);
                unset($colors);
                unset($deliveryType);
            }
        }
    }

    public function exportExcel()
    {
        $products=$this->XmlGetData();
        $id=Auth::id();

        (new FastExcel($products))->export('exports/xls/prods'.$id.'.xlsx', function ($product) {
            $images=$product->images;
            // dd($product->is_active);
            // dd($product['images']);
            $prods= [
                'id' => $product->id,
                'title' => $product->title,
                'is Active'=>$product->isActive,
                'product Status'=>$product->status,
                'user id'=>$product->user_id,
                'Item id'=>$product->item_id,
                'Sku'=>$product->articul,
                'Store id'=>$product->store_id,
                'Price'=>$product->price,
                'Price 2'=>$product->price_2,
                'stock'=>$product->stock,
                'description'=>$product->description,
                'Country id'=>$product->country_id,
                'Manufacturer'=>$product->manufacture,
                'Width'=>$product->width,
                'Height'=>$product->height,
                'Depth'=>$product->depth,
                'is delivery'=>$product->is_delivery,
                'Seo title'=>$product->seo_title,
                'Meta description'=>$product->meta_description,
                'meta tags'=>$product->meta_tags,
            ];


            //$prods['images']=$product->images;
            if (is_array($product->images)) {

                foreach ($product->images as $key=>$value) {
                    // dd($image);
                    // echo $image;
                    //$prods['push']['image']=$image;
                    $prods['image'.$key]=$value;
                }
                //  array_push($prods,$imgarr);
            }

            //colors
            if (is_array($product->colors)) {

                foreach ($product->colors as $key2=>$value2) {
                    // dd($image);

                    //$prods['push']['image']=$image;
                    $prods['color'.$key2]=$value2;

                }
                if (is_array($prods['color'.$key2])) {
                    foreach ($prods['color' . $key2] as $key => $value) {
                        $prods['color' . $key] = $value;
                    }
                }
                //  array_push($prods,$imgarr);

            }
            //end

            //deliveryType
            if (is_array($product->delivery_type)) {

                foreach ($product->delivery_type as $key=>$value) {
                    // dd($image);
                    // echo $image;
                    //$prods['push']['image']=$image;
                    $prods['image'.$key]=$value;
                }
                //  array_push($prods,$imgarr);

            }
            //endDeliveryType
            // dd($prods);
            return $prods;
            //dd($prods);
        }

        );
        //return (new FastExcel($products))->download('exports/xls/prods'.$id.'.xlsx');

        return response()->download('exports/xls/prods'.$id.'.xlsx', "products.xlsx");

    }

    public function Importexcel($path)
    {
        $storeIds = Store::where('user_id',Auth::id())
            ->get('id')->toArray();
        $ids=array();

        foreach ($storeIds as $id)
        {
            $ids[]=$id['id'];
        }
        $collection = (new FastExcel)->import($path);
        foreach ($collection as $item)
        {
            // dd($item['is Active']);
            if($item['is Active']!='0' && $item['is Active']!='1')
            {
                // dd($data['product'][$i]['IsActive']);
                die('???? ?????????? ?????????????? ???????????????? IsActive ?? ???????????????? ?? ??????????????????????????????'.$item['id']);
            }
            if($item['product Status']!='0' && $item['product Status']!='1')
            {
                // dd($data['product'][$i]['IsActive']);
                die('???? ?????????? ?????????????? ???????????????? product status ?? ???????????????? ?? ??????????????????????????????'.$item['id']);
            }
            $userId=0;
            if ($item['user id']==0)
            {
                $userId=Auth::id();
            }
            else
            {
                $userId=$item['user id'];
            }
            $itemId='';
            if ($item['Item id'] != null) {
                $itemId = $item['Item id'];
            } else {
                die("???? ?????????? ???????????? ItemID ?? ???????????????? ?? ??????????????????????????????".$item['id']);
            }
            if ($item['articul']==null)
            {
                die('???? ?????????? ???????????? ?????????????? ?? ???????????????? ?? ?????????????????????????????? '.$item['id']);
            }
            if (!in_array($item['Store id'],$ids)){

                // dd($storeIds);
                //   dd($stores);
                die('???? ?????????? ?????????????? ???????????????? StoreId ?? ???????????????? ?? ?????????????????????????????? ' . $item['id']);


            }
            $price2=0;
            if ($item['Price 2'] != null) {
                $price2 = $item['Price 2'];
            }
            else
            {
                $price2=0;
            }
            $stock=0;
            if ($item['stock'] != null) {
                if (preg_match('/^[0-9]+$/', $item['stock'])) {
                    //dd($stock);
                    $stock = $item['stock'];

                }
                else
                {
                    die('???? ?????????? ?????????????? ???????????????? stock ?? ???????????????? ?? ??????????????????????????????'.$item['id']);
                }

            }
            else
            {
                $stock=0;
            }
            $description='';
            if ($item['description']!=null) {
                $description =$item['description'];
                // dd($description);

            }
            else
            {
                $description='';
            }
            $country=0;
            if ($item['Country id'] != null) {

                if (preg_match('/^[0-9]+$/', $item['Country id'])) {

                    $country = $item['Country id'];
                    //dd($country);
                }
                else
                {
                    die('???? ?????????? ?????????????? ???????????????? country_id ?? ???????????????? ?? ??????????????????????????????'.$item['id']);

                }
            }

            else
            {
                $country=0;
            }
            $width=0;
            if ($item['Width'] != null) {
                if (preg_match('/^[0-9]+$/', $item['Width'])) {
                    $width = $item['Width'];
                }
                else
                {
                    die('???? ?????????? ?????????????? ???????????????? productWidth ?? ???????????????? ?? ?????????????????????????????? '.$item['id']);
                }
            }
            $height=0;
            if ($item['Height'] != null) {
                if (preg_match('/^[0-9]+$/', $item['Height'])) {
                    $height = $item['Height'];
                }
                else
                {
                    die('???? ?????????? ?????????????? ???????????????? productHeight ?? ???????????????? ?? ?????????????????????????????? '.$item['id']);
                }
            }
            $depth=0;
            if ($item['Depth'] != null) {
                if (preg_match('/^[0-9]+$/', $item['Depth'])) {
                    $depth = $item['Depth'];
                }
                else
                {
                    die('???? ?????????? ?????????????? ???????????????? productDepth ?? ???????????????? ?? ?????????????????????????????? '.$item['id']);
                }
            }
            if ($item['is delivery']!=null) {
                if ($item['is delivery'] != '0' && $item['is delivery'] != '1') {
                    // dd($data['product'][$i]['isDelivery']);
                    die('???? ?????????? ?????????????? ???????????????? isDelivery ?? ???????????????? ?? ??????????????????????????????' . $item['id']);
                }
            }
            // $seoTitle='';
            if ($item['Seo title']!=null) {

                $seoTitle = $item['Seo title'];
            }

            if ($item['Meta description']!=null) {

                $metaDescription = $item['Meta description'];
            }
            if ($item['meta tags']!=null) {

                $metaTags = $item['meta tags'];
            }

            $value=array();
            $regex = '/[-+]?(' .  'image' . ')/';
            $keys=array_keys($item);
            $images = preg_grep($regex, $keys);
            $finalImages=array();
            foreach ($images as $image)
            {
                $finalImages[]=$item[$image];
            }
            $regexColors = '/[-+]?(' .  'color' . ')/';

            $colors = preg_grep($regexColors, $keys);

            $finalColors=array();
            foreach ($colors as $color)
            {
                $finalColors[]=$item[$color];
            }

            // dd($finalColors);
            $product = Product::firstOrNew(['id' =>  $item['id']]);

            $product->title = $item['title'];
            $product->IsActive=$item['is Active'];
            $product->status=$item['product Status'];
            $product->user_id=$userId;
            $product->item_id=$itemId;
            $product->articul=$item['articul'];
            $product->store_id=$item['Store id'];
            $product->price=$item['Price'];
            $product->price_2=$price2;
            $product->stock=$stock;
            $product->description=$description;
            $product->country_id=$item['Country id'];
            $product->manufacture=$item['Manufacturer'];
            $product->width=$width;
            $product->height=$height;
            $product->depth=$depth;
            $product->is_delivery=$item['is delivery'];
            $product->seo_title=$seoTitle;
            $product->meta_description=$metaDescription;
            $product->meta_tags=$metaTags;
            $product->images=$finalImages;
            $product->colors=$finalColors;
            $product->save();


            // dd($item['product Status']);
        }
    }
}
