<?php

namespace App\Http\Controllers;

use App\Models\CategoryDetail;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryDetailController extends Controller
{
    public function category() {
        $data = Category::where('category_name', 'LIKE', '%'.request('q').'%')->paginate(10);
        
        return response()->json($data);
    }
    
    public function category_detail($id) {
        
        $data = CategoryDetail::where('category_id', $id)->where('category_detail_name', 'LIKE', '%'.request('q').'%')->paginate(10);
        
        return response()->json($data);
    }

    public function show(CategoryDetail $categoryDetail) 
    {
        $postData = Post::whereHas('post_details', fn ($query) => $query->where('category_detail_id', $categoryDetail->id))->latest()->paginate(10);
        $data['title']      = $categoryDetail->category_detail_name;
        $data['link']       = $categoryDetail->category_detail_name;
        $data['active']     = $categoryDetail->category->category_name;
        $data['categories'] = category::all();
        $data['posts_sub']  = $postData;
        $data['popular']    = $postData->sortByDesc('traffic');
        
        return view('sub_category', $data);
    }
}