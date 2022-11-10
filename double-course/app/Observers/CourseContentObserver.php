<?php

namespace App\Observers;

use App\Models\CourseContent;
use App\Rules\VimeoVideoExist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Vimeo\Laravel\Facades\Vimeo;

class CourseContentObserver
{

    /**
     * Handle the CourseContent "created" event.
     *
     * @param  \App\Models\CourseContent  $courseContent
     * @return void
     */
    public function creating(CourseContent $courseContent)
    {
        $this->durationSaveVimeoId($courseContent);
    }

    /**
     * Handle the CourseContent "updated" event.
     *
     * @param  \App\Models\CourseContent  $courseContent
     * @return void
     */
    public function updating(CourseContent $courseContent)
    {
        $this->durationSaveVimeoId($courseContent);
    }

    /**
     * Handle the CourseContent "deleted" event.
     *
     * @param  \App\Models\CourseContent  $courseContent
     * @return void
     */
    public function deleted(CourseContent $courseContent)
    {
        //
    }

    /**
     * Handle the CourseContent "restored" event.
     *
     * @param  \App\Models\CourseContent  $courseContent
     * @return void
     */
    public function restored(CourseContent $courseContent)
    {
        //
    }

    /**
     * Handle the CourseContent "force deleted" event.
     *
     * @param  \App\Models\CourseContent  $courseContent
     * @return void
     */
    public function forceDeleted(CourseContent $courseContent)
    {
        //
    }

    private function durationSaveVimeoId(CourseContent $courseContent){
        $duration = 0;

        $vimeo = Vimeo::request('/me/videos/'.$courseContent->path);

        if ($vimeo['status'] == 404){
            $vimeoExist = ['id'=>$courseContent->path];
            $validator = Validator::make($vimeoExist, [
                'id' => [new VimeoVideoExist()],
            ]);
            if ($validator->fails()) {
                dd($validator->errors()->first('id'));
            }
            $req = $this->getVideoDetails('https://vimeo.com/'.$courseContent->path);
            $duration = $req['duration'];
            $picture = $req['thumbnail'];
        } else{
            $duration = $vimeo['body']['duration'];
            $picture = $vimeo['body']['pictures']['sizes'][4]['link'];

        }
        $courseContent->picture = $picture;
        $courseContent->length = intval(date("i", mktime(0, 0, intval($duration))));
//        $courseContent->saveQuietly();
    }

    private function getVideoDetails($url)
    {
        $host = explode('.', str_replace('www.', '', strtolower(parse_url($url, PHP_URL_HOST))));
        $host = isset($host[0]) ? $host[0] : $host;

                $video_id = substr(parse_url($url, PHP_URL_PATH), 1);
                $hash = json_decode(file_get_contents("http://vimeo.com/api/v2/video/{$video_id}.json"));

                // header("Content-Type: text/plain");
                // print_r($hash);
                // exit;
                return array(
                    'provider'          => 'Vimeo',
                    'title'             => $hash[0]->title,
                    'description'       => str_replace(array("<br>", "<br/>", "<br />"), NULL, $hash[0]->description),
                    'description_nl2br' => str_replace(array("\n", "\r", "\r\n", "\n\r"), NULL, $hash[0]->description),
                    'thumbnail'         => $hash[0]->thumbnail_large,
                    'video'             => "https://vimeo.com/" . $hash[0]->id,
                    'embed_video'       => "https://player.vimeo.com/video/" . $hash[0]->id,
                    'duration'       => $hash[0]->duration,
                );


    }
}
