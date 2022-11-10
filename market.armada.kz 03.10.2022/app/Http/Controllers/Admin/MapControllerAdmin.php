<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Service;
use App\Models\Map;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapControllerAdmin extends Controller
{

    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $maps = Map::with('store')->get();
        $stores = Store::select('id', 'title')->get();
        return view('admin.maps.index', compact('maps', 'stores'));
    }


    public function mapviewIndex()
    {
        $maps = Map::select('map_polygon_id')->get();
        $stores = Store::select('id', 'title')->get();
        return view('admin.maps.mapview', compact('stores'));
    }

    public function get_occupied_map(): \Illuminate\Http\JsonResponse
    {
        $maps = Map::select('map_polygon_id')->get();
        return response()->json($maps);
    }

    // rest api controller for ajax request
    public function getStoreByPolygonId(): \Illuminate\Http\JsonResponse
    {
        $polygonId = '';
        if (request()->has('polygonId')) {
            $polygonId = request()->polygonId;
        }
        $map = Map::with(['store' => function ($query) {
            $query->select('id', 'title', 'slug', 'logo', 'mini_img', 'work_times', 'phones');
        }])->where('map_polygon_id', '=', $polygonId)->first();

        return response()->json($map);

    }

    // update or create map polygonId

    public function updateOrCreateMap(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated_data = $request->validate([
            'store_id' => 'required',
            'map_polygon_id' => 'required',
        ]);

        Map::updateOrCreate(
            ['map_polygon_id' => $validated_data['map_polygon_id']],
            ['store_id' => $validated_data['store_id']]
        );

        $map = Map::with(['store' => function ($query) {
            $query->select('id', 'title', 'slug', 'logo', 'mini_img', 'work_times', 'phones');
        }])->where('map_polygon_id', '=', $validated_data['map_polygon_id'])->first();

        return response()->json($map);

    }

    public function create()
    {
        $maps = Map::with('store')->get();
        $stores = Store::select('id', 'title')->get();
        return view('admin.maps.credit', compact('maps', 'stores'));
    }

    public function store(Request $request)
    {
        $data = Map::add($request->all());
        $data->map_id = $request->input('map-code');
        $data->save();

        return redirect()->route('admin.maps.index')->with('success', 'Информация сохранена');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Map::find($id);
        $maps = Map::with('store')->get();
        $stores = Store::select('id', 'title')->get();
        return view('admin.maps.credit', compact('data', 'maps', 'stores'));
    }

    public function update(Request $request, $id)
    {
        $data = Map::find($id);
        $data->edit($request->all());
        $data->map_id = $request->input('map-code');
        $data->save();

        return redirect()->route('admin.maps.index')->with('success', 'Информация сохранена');
    }

    public function destroy($polygonId)
    {

        $data = Map::where('map_polygon_id', '=', $polygonId);
        $data->delete();

        return back()->with('success', 'Карта удалёна');

    }
}
