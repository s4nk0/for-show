<?php

namespace App\Imports;

use App\Http\Services\ProductService;
use App\Http\Services\Service;
use App\Models\Product;
use App\Traits\UploadImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Cell;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Row;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

HeadingRowFormatter::default('none');

class ProductImport implements ToModel, WithHeadingRow
{

    //use UploadImage;

    protected int $store;


    public function __construct($store)
    {
        $this->store = $store;

    }


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $productService = new ProductService();

        $delivery = explode(',', $row['Доставка']);
        $payment = explode(',', $row['Оплата']);
        $imagesArray=[];

        $delivery_id_json = $productService->importDeliveryNameToId($delivery);
        $payment_id_json = $productService->importPaymentNameToId($payment);
        $is_hot = $productService->convertToBoolean($row['Горячий']);
        $isActive = $productService->convertToBoolean($row['Активный']);
        $country_id = $productService->importCountryToId($row['Страна']);
        $presence_id = $productService->importPresenceToId($row['Наличие']);
        $item_subCatalog_catalog = $productService->importItemAndCatalog($row['Раздел']);


        $spreadsheet = IOFactory::load(request()->file('file'));
        $extension = 'webp';



        foreach ($spreadsheet->getActiveSheet()->getDrawingCollection() as $drawing) {

            if ( $row['#'] == $this->extractImageCellCoordsOnlyRow($drawing->getCoordinates())) {
                if ($drawing instanceof MemoryDrawing) {
                    ob_start();
                    call_user_func(
                        $drawing->getRenderingFunction(),
                        $drawing->getImageResource()
                    );
                    $imageContents = ob_get_contents();
                    ob_end_clean();

                } else {
                    $zipReader = fopen($drawing->getPath(), 'r');
                    $imageContents = '';
                    while (!feof($zipReader)) {
                        $imageContents .= fread($zipReader, 1024);
                    }
                    fclose($zipReader);
                }
                $filename = Str::random(10) . '.' . $extension;

                $date = now()->format('MY');
                $folder = 'images' . '/' . $date . '/';

                $pathway = $folder . $filename;
                Storage::put("public/$pathway", $imageContents);
                $img = Image::make(storage_path("app/public/$pathway"));
                $img->resize(1000, 1000, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode();
                Storage::put("public/cards/$pathway", $img);
                $img->save(storage_path("app/public/cards/$pathway"), 70);
               $imagesArray[] = "$pathway";
            }


        }


        return new Product([
            'articul' => $row['Артикул'],
            'title' => $row['Название'],
            'delivery_ids' => $delivery_id_json,
            'pay_ids' => $payment_id_json,
            'is_hot' => $is_hot,
            'isActive' => $isActive,
            'country_id' => $country_id,
            'presence_id' => $presence_id,
            'price' => $row['Цена'],
            'store_id' => $this->store,
            'item_id' => $item_subCatalog_catalog['item_id'],
            'subcatalog_id' => $item_subCatalog_catalog['sub_catalog_id'],
            'catalog_id' => $item_subCatalog_catalog['catalog_id'],
            'description' => $row['Описание'],
            'manufacture' => $row['Материал'] ?? null,
            'colors' => $row['Цвета'] ?? null,
            'width' => $row['Длина'] ?? null,
            'height' => $row['Высота'] ?? null,
            'depth' => $row['Глубина'] ?? null,
            'seo_title' => $row['SEO Заголовок'] ?? null,
            'meta_description' => $row['SEO Описание'] ?? null,
            'meta_tags' => $row['Ключевые слова'] ?? null,
            'images' => $imagesArray
        ]);
    }

    private function extractImageCellCoordsOnlyRow($cell){
        $num =  (int)substr($cell, 1);
        return $num - 1;
    }
}
//*
//function that extracts number of cell index e.g U6 -> 6
// and return -1 in order to match $row['#']
//
//*/


//Артикул
//Название
//Доставка
//Оплата
//Горячий
//Активный
//Наличие
//Страна
//Цена
//Раздел

//$fillable = [
//        'isActive','status',
//        'store_id','catalog_id','subcatalog_id','country_id','item_id',
//        'is_delivery',
//        'presence_id',
//        'is_discount', 'discount',
//        'title','price',
//        'is_delivery',
//        'description','articul','images','colors',
//        'material',
//        'manufacture',
//        'width','height','depth','origin','status',
//        'hits',
//        'is_hot','fiver','used','is_slug','slug',
//        'detail',
//        'seo_title','meta_description','meta_tags'
//    ];
