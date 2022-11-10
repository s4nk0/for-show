<?php

namespace App\Traits;

use App\Models\Banner;
use App\Models\BannerType;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait UploadImage
{
//    public function __construct()
//    {
//        ini_set('max_execution_time', 120);
//        ini_set('memory_limit', '512M');
//    }

    public function removeImage($oldImage)
    {
        if($oldImage != null)
        {
            Storage::delete("public/" . $oldImage);
        }
    }

    public function uploadImage($image, $name = 'image', $oldImage = null)
    {

        if($image == null) { return; }
        $names = $name . 's';
        $this->removeImage($oldImage);
        //$filename = Str::random(10) . '.' . $image->getClientOriginalExtension();
        $filename = Str::random(10) . '.' . 'webp';
        $image->storeAs("public/$names", $filename);
        $this->$name = "$names" . '/' . $filename;
    }

    public function uploadDataImageInJSON($image, $name = 'image',$type = 'webp',$folder = null,$isCard = false)
    {

        if($image == null) { return; }
//        $names = $name . 's';
        $initial_folder = $folder;
        $oldImage = $this->getOriginal($name) ?? null;
        if($oldImage != $image)
        {
            $this->removeImage($this->getOriginal($name));
            $date = now()->format('MY');
            $folder = $folder != null ? $folder . '/' . $name . '/' : $name . '/';
            $folder = $folder . $date . '/';
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $filename = Str::random(10) . '.' . $type;
            $pathway = $folder . $filename;
            Storage::put("public/$pathway", base64_decode($image));

            if (strpos($initial_folder, Banner::BANNER_FOLDER.'-') !== false) {
                $bannerTypes = explode("-", $initial_folder);
                $img = Image::make(storage_path("app/public/$pathway"));
                if(isset($bannerTypes[1])){
                    switch ($bannerTypes[1]){
                        case BannerType::HOME_SLIDER:
                            $img->resize(1800, 900, function ($constraint) {
                                $constraint->aspectRatio();
                            })->encode();
                            break;
//                        case BannerType::HOME_TOP:
//                            $img->resize(1000, 800, function ($constraint) {
//                                $constraint->aspectRatio();
//                            })->encode();
//                            break;
//                        case BannerType::HOME_BOTTOM:
//                            $img->resize(2500, 800, function ($constraint) {
//                                $constraint->aspectRatio();
//                            })->encode();
//                            break;
                        case BannerType::WIDE_TOP:
                            $img->resize(3200, 250, function ($constraint) {
                                $constraint->aspectRatio();
                            })->encode();
                            break;
                        case BannerType::POPUP:
                            $img->resize(1500, 900, function ($constraint) {
                                $constraint->aspectRatio();
                            })->encode();
                            break;
                        default:
                            $img->encode();
                    }
                }

                $img->save(storage_path("app/public/$pathway"),100);
            }

            $this->$name = json_encode([$pathway]);
        }
    }

    public function uploadDataImage($image, $name = 'image',$type = 'webp',$folder = null,$isCard = false)
    {
        if($image == null) { return; }
//        $names = $name . 's';
        $initial_folder = $folder;
        $oldImage = $this->getOriginal($name) ?? null;
        if($oldImage != $image)
        {
            $this->removeImage($this->getOriginal($name));
            $date = now()->format('MY');
            $folder = $folder != null ? $folder . '/' . $name . '/' : $name . '/';
            $folder = $folder . $date . '/';
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $filename = Str::random(10) . '.' . $type;
            $pathway = $folder . $filename;
            Storage::put("public/$pathway", base64_decode($image));

            if (strpos($initial_folder, Banner::BANNER_FOLDER.'-') !== false) {
                $bannerTypes = explode("-", $initial_folder);
                $img = Image::make(storage_path("app/public/$pathway"));
                if(isset($bannerTypes[1])){
                    switch ($bannerTypes[1]){
                        case BannerType::HOME_SLIDER:
                            $img->resize(1800, 900, function ($constraint) {
                                $constraint->aspectRatio();
                            })->encode();
                            break;
//                        case BannerType::HOME_TOP:
//                            $img->resize(1000, 800, function ($constraint) {
//                                $constraint->aspectRatio();
//                            })->encode();
//                            break;
//                        case BannerType::HOME_BOTTOM:
//                            $img->resize(2500, 800, function ($constraint) {
//                                $constraint->aspectRatio();
//                            })->encode();
//                            break;
                        case BannerType::WIDE_TOP:
                            $img->resize(3200, 250, function ($constraint) {
                                $constraint->aspectRatio();
                            })->encode();
                            break;
                        case BannerType::POPUP:
                            $img->resize(1500, 900, function ($constraint) {
                                $constraint->aspectRatio();
                            })->encode();
                            break;
                        default:
                            $img->encode();
                    }
                }

                $img->save(storage_path("app/public/$pathway"),100);
            }

            $this->$name = $pathway;
        }
    }

    public function uploadDataImages($images, $name = 'images',$type = 'webp',$folder = null,$isCard = false)
    {
        if(!is_array($images)) // если приходит не массив
        {
            $image[] = $images;
            $images = $image;
        }
        if($images == null) { return; } // or $images == '/storage/'.$this->getOriginal($name)
        $oldImages = is_array($this->getOriginal($name)) ? $this->getOriginal($name) : [];

        if(count(array_diff($oldImages,$images)) > 0)
        {
            foreach (array_diff($oldImages,$images) as $imageDel)
            {
                $this->removeImage($imageDel);
            }
        }

        $date = now()->format('MY');
        $folder = $folder != null ? $folder . '/' : null;
        $folder = $name . '/' . $folder . $date . '/';
        $imagesArray = null;

        for($i = 0; $i < count($images); $i++)
        {
            if(in_array($images[$i], $oldImages))
            {
                $imagesArray[] = $images[$i];
            }
            else
            {
                if($images[$i] != null)
                {
                    $filename = Str::random(10) . '.' . $type;
                    $pathway = $folder . $filename;
                    if(is_string($images[$i]) and Str::contains($images[$i],'data:image/png;base64,')){
                        $image = str_replace('data:image/png;base64,', '', $images[$i]);
                        $image = str_replace(' ', '+', $image);

                        Storage::put("public/$pathway", base64_decode($image));
                    }else{
                        $interventionImage = Image::make($images[$i])->stream("webp", 100);
                        Storage::put("public/$pathway", $interventionImage);
                    }

                    $imagesArray[] = "$pathway";
                }
            }
        }

        if($isCard){
            if(is_array($imagesArray) and count($imagesArray) > 0){
                $pathway =  $imagesArray[0] ;
                $img = Image::make(storage_path("app/public/$pathway"));
                $img->resize(1000, 1000, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode();
                Storage::put("public/cards/$pathway", $img);
                $img->save(storage_path("app/public/cards/$pathway"),70);
            }
        }

        $this->$name = $imagesArray;
    }

    public function uploadImages($images, $name = 'image', $oldImage = null)
    {
        $names = $name . 's';
        if($images == null) { return; }
        foreach ($images as $image)
        {
            $this->removeImage($oldImage);
            $filename = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs("public/$names", $filename);
            $imageArray[] = "$names" . '/' . $filename;
        }
        $this->$names = json_encode($imageArray);
    }

    public function getImage($name = 'image',$imageDefault = '/img/logo-gray.png',$isCard=false) : string // вывод картинки
    {
//        dd($name,$imageDefault);
        if($this->$name == null)
        {
            return $imageDefault;
        }
        if(is_array($this->$name))
        {
            $first[] = $this->$name[0];
            if($isCard){
                $imageUrl = $this->storage('cards/'.$first[0],$imageDefault);
            }else{
                $imageUrl = $this->storage($first[0],$imageDefault);
            }

        }
        else
        {
            $imageUrl = $this->storage($this->$name,$imageDefault);
        }

        return $imageUrl;
    }

    public function getImages($number = 0, $name = 'images',$imageDefault = '/img/logo-gray.png',$isCard=false) : string // вывод картинки
    {
        if($this->$name == null)
        {//0,'image', '/img/logo-gray.png',true
            return $imageDefault;
        }

        if(is_array($this->$name))
        {
            $first[] = $this->$name[$number];
            if($isCard){
                if(Storage::exists('/public/'.'cards/'.$first[0])){
                    $imageUrl = $this->storage('cards/'.$first[0],$imageDefault);
                }else{
                    $imageUrl = $this->storage($first[0],$imageDefault);
                }
            }else{
                $imageUrl = $this->storage($first[0],$imageDefault);
            }

        }
        else
        {
            $imageUrl = $this->storage($this->$name,$imageDefault);
        }

        return $imageUrl;
    }

    public function storage($image,$imageDefault)
    {
        $imageUrl = Storage::exists('/public/'.$image) ? Storage::url($image) : $imageDefault;
        return  $imageUrl;
    }
}
