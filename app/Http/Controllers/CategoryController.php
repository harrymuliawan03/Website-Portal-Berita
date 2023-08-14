<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function show(Category $category) 
    {
        $postData = Post::where('category_id', $category->id)->latest();

        $data['title']      = $category->category_name;
        $data['active']     = $category->category_name;
        $data['categories'] = category::all();
        $data['posts']      = $postData->paginate(10);
        $data['popular']    = $postData->orderBy('traffic', 'DESC')->latest()->get();
        
        return view('categories', $data);
    }
}