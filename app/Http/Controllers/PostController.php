<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\PostDetail;
use App\Models\User;
use App\Models\SearchTraffic;

class PostController extends Controller
{
    public function index()
    {
        $title = '';

        if (request('search')) {
            $searchTraffic = SearchTraffic::firstWhere('keyword', request('search'));
            $title = ' contain ' . "'" .  request('search') . "'";
            if($searchTraffic == null) {
                SearchTraffic::create([
                    'keyword' => request('search'),
                    'traffic' => 0 
                ]);
            }else {
                $traffic = $searchTraffic->traffic + 1;
                $searchTraffic->update(['traffic' => $traffic]);
            }
        }

        if (request('category')) {
            $category = Category::firstWhere('category_name', request('category'));
            $title = ' in ' . $category->category_name;
        }
        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }
        
        $data["title"]  = "All Posts" . $title;
        $data["active"] = "blog";
        $data["categories"] = Category::all();
        $data["posts"]  = Post::search(request('search'))->category(request('category'))->author(request('author'))->latest()->paginate(7)->withQueryString();
        return view('posts', $data);
    }

    public function show(Post $post)
    {
        $postTraffic = Post::firstWhere('slug', $post->slug);
        $traffic = $postTraffic->traffic + 1;
        $postTraffic->update(['traffic' => $traffic]);
    
        $data['title'] = "Single Post";
        $data["categories"] = Category::all();
        $data['active'] = "blog";
        $data['post'] = $post;
        
        return view('post', $data);
    }
}