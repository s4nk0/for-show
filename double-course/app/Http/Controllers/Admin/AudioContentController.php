<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AudioContent;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AudioContentController extends Controller
{
    public function categories(){
        return view('admin.content.audio.category.index');
    }

    public function show(Category $category)
    {
        return view('admin.content.audio.category.show', compact('category'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.contents.audio.category');
    }

    public function destroySubcategory(Subcategory $subcategory)
    {
        $category_id = $subcategory->category_id;
        $subcategory->delete();
        return redirect()->route('admin.contents.audio.show',['category'=>$category_id]);
    }

    public function destroyContent(AudioContent $content)
    {
        $category_id = $content->subcategory()->first()->category()->first()->id;;
        File::delete($content->path);
        $content->delete();
        return redirect()->route('admin.contents.audio.show',['category'=>$category_id]);
    }

}
