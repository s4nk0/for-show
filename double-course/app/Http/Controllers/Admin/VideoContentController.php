<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VideoContentController extends Controller
{
    public function courses(){
        return view('admin.content.video.courses.index');
    }

    public function showCourses(Course $course){
        return view('admin.content.video.courses.show',compact('course'));
    }

    public function destroyCourses(Course $course){
        $course->delete();
        return redirect()->route('admin.video.courses');
    }

    public function destroyCourseContent(CourseContent $content){

        $course = $content->course()->first();
        if ($content->material_path){
            File::delete($content->material_path);
        }
        $content->delete();
        return redirect()->route('admin.contents.video.course.show',['course'=>$course]);
    }
}
