<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserNoteRequest;
use App\Http\Requests\UserProfileEditRequest;
use App\Models\AffirmationCategory;
use App\Models\AudioContent;
use App\Models\CourseContent;
use App\Models\Subcategory;
use App\Models\UserNote;
use App\Rules\AffirmationCategoryExist;
use App\Rules\AudioContentExsist;
use App\Rules\CourseContentExist;
use App\Rules\SubcategoryExist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function update(UserProfileEditRequest $request){
        $user = $request->user();
        $user->update($request->validated());
        $user->deleteProfilePhoto();
        if (isset($request->photo)) {
            $user->updateProfilePhoto($request->photo);
        }
        return $user;
    }

    public function audio_activity(Request $request,$category_id){
        $user = $request->user();
        $request->validate([
            'content_id' => [new AudioContentExsist($category_id)],
        ]);
        $user->audio_content()->save(AudioContent::find($request->content_id));
        return response('success',200);
    }

    public function like_audio(Request $request,$id){
        $user = $request->user();
        $request->validate([
            'content_id' => [new AudioContentExsist($id)],
        ]);

        $user->like_audio_content()->toggle($id);
        return response('success',200);
    }

    public function video_activity(Request $request,$course_id){
        $user = $request->user();
        $request->validate([
            'content_id' => [new CourseContentExist($course_id)],
        ]);

        $user->course_contents()->save(CourseContent::find($request->content_id));
        return response('success',200);
    }

    public function affirmation_activity(Request $request){
        $user = $request->user();
        $request->validate([
            'content_id' => [new AffirmationCategoryExist()],
        ]);

        $user->affirmations()->save(AffirmationCategory::find($request->content_id));
        return response('success',200);
    }

    public function user_note_create(UserNoteRequest $request){
        $user = $request->user();
        $user_note = $user->notes()->create($request->validated());

        if (isset($request->photo)) {
            $user_note->updateProfilePhoto($request->photo);
        }

        return response('success',200);
    }

    public function user_note(Request $request){
        if ($request->paginate){
            return $request->user()->notes()->paginate($request->paginate);
        }
        return $request->user()->notes()->get();
    }

    public function user_note_show(Request $request,$id){
        return $request->user()->notes()->find($id);
    }

    public function destrtoy(Request $request){
        $request->user()->tokens()->delete();
        $request->user()->delete();
        return response('success',200);
    }

}
