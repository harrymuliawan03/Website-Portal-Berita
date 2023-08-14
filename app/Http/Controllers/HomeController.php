<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\SearchTraffic;

class HomeController extends Controller
{
    public function index()
    {
        $data["title"]      = "Home";
        $data["active"]     = "home";
        $data["categories"] = Category::all();
        $data["searches"]   = SearchTraffic::orderBy('traffic', 'DESC')->limit(5)->get();
        $data["posts"]      = Post::orderBy('traffic', 'DESC')->orderBy('created_at', 'DESC')->get();
        // whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])

        
        return view('home', $data);
    }
}