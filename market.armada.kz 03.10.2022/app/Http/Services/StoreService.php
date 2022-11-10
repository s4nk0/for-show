<?php

namespace App\Http\Services;

class StoreService
{
    public function adminFilter($storesQuery)
    {
        if(isset($_GET['store']) and is_numeric($_GET['store']))
        {
            $storesQuery = $storesQuery->where('store_id',$_GET['store']);
        }
        return $storesQuery;
    }

    public function workTimes($request)
    {

        foreach ($request['day_start'] as $day_start)
        {
            $dayStart[] = $day_start != null ? $day_start : null;
        }
        foreach ($request['day_end'] as $day_end)
        {
            $dayEnd[] = $day_end != null ? $day_end : null;
        }
        foreach ($request['time_start'] as $time_start)
        {
            $timeStart[] = $time_start != null ? $time_start : null;
        }
        foreach ($request['time_end'] as $time_end)
        {
            $timeEnd[] = $time_end != null ? $time_end : null;
        }
        $workTimes = null;
        for($i = 0;$i < 3 ;$i++)
        {
            if(isset($dayStart[$i]) and $dayStart[$i] != null and isset($dayEnd[$i]) and $dayEnd[$i] != null and isset($timeStart[$i]) and $timeStart[$i] != null and isset($timeEnd[$i]) and $timeEnd[$i] != null)
            {
                $workTimes[] = $dayStart[$i] . '-' . $dayEnd[$i] . ' ' . $timeStart[$i] . '-' . $timeEnd[$i];
            }
        }

        if($workTimes == null)
        {
            return back()->with('error','Не введено время работы')->send();
        }

        return $workTimes;
    }

    public function correctWebUrl($web_url){
        if(substr( $web_url, 0, 4 ) !== "http"){
            $web_url = '//'.$web_url;
        }
        return $web_url;
    }

    public function correctInstagram($insta){
        if(substr( $insta, 0, 4 ) !== "http"){
            $insta = '//www.instagram.com/'.$insta;
        }
        return $insta;
    }
    public function storeSearchQuery($shopsQuery){
        return $shopsQuery->where(function ($query){
            $query->where('title','LIKE',$_GET['q'].'%')
//                ->orWhere('seo_title','LIKE','%'.$_GET['q'].'%')
//                ->orWhere('original_title','LIKE','%'.$_GET['q'].'%')
//                ->orWhere('description','LIKE','%'.$_GET['q'].'%')
//                ->orWhere('mini_description','LIKE','%'.$_GET['q'].'%')
//                ->orWhere('meta_description','LIKE','%'.$_GET['q'].'%')
//                ->orWhere('mini_desc','LIKE','%'.$_GET['q'].'%')
                ->orWhere('search_tags','LIKE','%'.$_GET['q'].'%')
                ->orWhere('search_map_tags','LIKE','%'.$_GET['q'].'%')
                ->select('id','slug','title');
        });
    }
}
