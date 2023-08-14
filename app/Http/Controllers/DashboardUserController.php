<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyTrafficViews;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user']       = User::firstWhere('id', auth()->user()->id);
        $data['categories'] = Category::paginate(6);
        $data['posts']      = Post::where('user_id', auth()->user()->id)->get();
        $data['breadCrumb'] = 'User Profile';
        
        return view('dashboard.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data['user']       = $user;
        $data['breadCrumb'] = ' User Profile / Edit';
        
        return view('dashboard.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules =[
            'name' => 'required|max:50',
            'phone' => 'required|max:15',
            'address' => 'required|max:255',
            'job' => 'required|max:255'
        ];


        if($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }
        if($request->username != $user->username) {
            $rules['username'] = 'required|max:30|unique:users';
        }

        $validatedData = $request->validate($rules);
        
        if($request->file('image')) {
            if($user->image != null) {
                Storage::delete($user->image);
            }
            $validatedData['image'] = $request->file('image')->store('user-images');
        }

        $user->update($validatedData);

        return redirect('/user')->with('success', 'User Profile has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}