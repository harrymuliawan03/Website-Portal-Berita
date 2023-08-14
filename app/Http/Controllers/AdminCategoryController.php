<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\Post;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->guest()) {
            abort(403);
        }
        
        $data['categories'] = Category::where('category_name', '!=', NULL)->orderBy('created_at', 'DESC')->paginate(15);
        $data['breadCrumb'] = 'Category';

        return view('dashboard.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadCrumb'] = ' Category / Create';
        
        return view('dashboard.categories.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create Category
        $category = Category::create([
            'category_name' => $request->category_name
        ]);

        // Validate
        $categoryDetail = $request->validate([
            'category_detail_name' => 'required|max:50|unique:category_details',
            'slug' => 'required|max:50|unique:category_details'
        ]);

        // Looping for add category detail
        $categoryDetail = [];
        foreach($request->item as $key => $items)
            {
                $categoryDetail []= [
                    'category_id'           => $category->id,
                    'category_detail_name'  => $request->category_detail_name[$key],
                    'slug'                  => $request->slug[$key],
                ];
            }
            CategoryDetail::insert($categoryDetail);
        return redirect('/dashboard/categories')->with('success', 'New Category has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        $data ['breadCrumb'] = ' Category / Detail';
        $data ['category'] = $category->category_name;
        $data ['category_details'] = CategoryDetail::where('category_id', $category->id)->get();
        
        return view('dashboard.categories.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        
        $data['breadCrumb'] =' Category / Edit';
        $data['category']   = $category;
        
        return view('dashboard.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(Request $request, category $category)
    {

        if($request->category_name != $category->name) {
            Category::where('id', $category->id)->update(['category_name' => $request->category_name]);
        }
        // Update category_detail_name
        $validateDetail = $category->category_details;
        $indexRow = count($request->category_detail_name);
        $index = count($validateDetail);
        if($indexRow == 0) {
            CategoryDetail::where('category_id', $category->id)->delete();
        }else{
            // Delete some row category_details
            if($indexRow < $index){
                
                $categoryDetail = [];
                for($i = $indexRow ; $i < $index ; $i++) {
                    // CategoryDetail::where('category_detail_name', $validateDetail[$i]['category_detail_name'])->delete();
                    $category->category_details[$i]->delete();
                }

                for($i = 0; $i < $index - $indexRow ; $i++) {
                    $name = $request->category_detail_name[$i];
                    $slug = $request->slug[$i];
                    if( $name != $validateDetail[$i]['category_detail_name'] || $slug != $validateDetail[$i]['slug']) {
                        $category->category_details[$i]->Update([
                            'category_detail_name' => $name,
                            'slug' => $slug,
                    ]);
                    }
                }
            }elseif($indexRow >= $index){ // Add new row category_details

                // Update row category_detail_name and slug
                for($i = 0; $i < $index ; $i++) {
                    $name = $request->category_detail_name[$i];
                    $slug = $request->slug[$i];
                    if( $name != $validateDetail[$i]['category_detail_name'] || $slug != $validateDetail[$i]['slug']) {
                        $category->category_details[$i]->Update([
                            'category_detail_name' => $name,
                            'slug' => $slug,
                    ]);
                    }
                }
                
                $categoryDetail = [];
                for($i = $index ; $i < $indexRow ; $i++) {
                    $categoryDetail []= [
                            'category_id'           => $category->id,
                            'category_detail_name'  => $request->category_detail_name[$i],
                            'slug'                  => $request->slug[$i],
                        ];
                }
                
                CategoryDetail::insert($categoryDetail);
            } 
            return redirect('/dashboard/categories')->with('success', 'Category has been updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        
        Category::where('id', $category->id)->update([
            'name' => null,
            'slug' => null
        ]);

        return redirect('/dashboard/categories')->with('success', 'Post has been deleted');
    }

    public function checkSlug(Request $request)
    {
        if($request->category == '') {
            return response()->json(['slug' => '']);
        }
        $slug = SlugService::createSlug(CategoryDetail::class, 'slug', $request->category);
        return response()->json(['slug' => $slug]);
    }
}