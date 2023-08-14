<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\PostDetail;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $categoryOld = request('category');
        if($categoryOld != null) {
            $idCategory = $categories->where('category_name', $categoryOld)->pluck('id')->toArray();
            $post = Post::where('user_id', auth()->user()->id)->where('category_id', $idCategory)->orderBy('created_at', 'DESC')->paginate(15)->withQueryString();
        }else{
            $post = Post::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(15)->withQueryString();
        }

        
        $data['posts']          = $post;
        $data['categoryOld']    = $categoryOld;
        $data['categories']     = $categories->pluck('category_name')->toArray();
        $data['breadCrumb']     = 'My Posts';
        
        return view('dashboard.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadCrumb'] = 'My Posts / create';
        
        return view('dashboard.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);
        
        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        $post = Post::create($validatedData);

        
        $postDetail = [];
        foreach($request->sub_category as $key => $items)
            {
                $postDetail []= [
                    'post_id'           => $post->id,
                    'user_id'           => auth()->user()->id,
                    'category_id'  => $request->category_id,
                    'category_detail_id'  => $request->sub_category[$key],
                ];
            }
            PostDetail::insert($postDetail);
        return redirect('/dashboard/posts')->with('success', 'New post has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $data['post']       = $post;
        $data['breadCrumb'] = ' My Post / Detail Post ' . $post->id;
        
        return view('dashboard.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data['post'] = $post;
        $data['categories'] = Category::all();
        $data['breadCrumb'] = ' My Posts / Edit';
        
        return view('dashboard.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($request->category_id) {
            $post->update(['category_id' => $request->category_id]);
        }

        if($request->title != $post->title) {
            $post->update(['title'=> $request->title]);
        }
        if($request->slug != $post->slug) {
            $post->update(['slug'=> $request->slug]);
        }
        if($request->file('image')) {
            if($post->image != null){
                Storage::delete($post->image);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
            $post->update(['image'=> $request->file('image')->store('post-images')]);
        }

        // Update post details
        $validateDetail = $post->post_details;
        $indexRow = count($request->sub_category);
        $index = count($validateDetail);
        if($indexRow == 0) {
            $post->post_details->delete();
        }else{
            // Delete some row post_details
            if($indexRow < $index){

                for($i = $indexRow ; $i < $index ; $i++) {
                    $post->post_details[$i]->delete();
                }
                // Update if there is changes in sub_category
                for($i = 0; $i < $indexRow ; $i++) {
                    $categoryId = $request->sub_category[$i];
                    if( $categoryId != $validateDetail[$i]['category_detail_id']) {
                        $post->post_details[$i]->Update([ 'category_detail_id' => $categoryId ]);
                    }
                }
            }elseif($indexRow >= $index){ // Add new row post_details

                // Update row category_detail_id and slug
                for($i = 0; $i < $index ; $i++) {
                    $categoryId = $request->sub_category[$i];
                    if( $categoryId != $validateDetail[$i]['category_detail_id']) {
                        $post->post_details[$i]->Update([ 'category_detail_id' => $categoryId ]);
                    }
                }
                
                $postDetail = [];
                for($i = $index ; $i < $indexRow ; $i++) {
                    $postDetail []= [
                        'post_id'               => $post->id,
                        'user_id'               => auth()->user()->id,
                        'category_id'           => $request->category_id,
                        'category_detail_id'    => $request->sub_category[$i],
                    ];
                }
                
                PostDetail::insert($postDetail);
            }

        return redirect('/dashboard/posts')->with('success', 'Post has been updated');
    }
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image != null) {
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect('/dashboard/posts')->with('success', 'Post has been deleted');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}