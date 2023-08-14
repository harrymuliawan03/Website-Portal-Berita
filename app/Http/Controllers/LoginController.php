<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        $data['title']      = 'Login';
        $data['active']     = 'login';
        $data['categories'] = Category::all();
        return view('login.index', $data); 
    }

    public function authenticate(Request $request)
    {
        $credentials =  $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/user');
        }

        return back()->with('loginError', 'Login failed!');

        
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        
        request()->session()->regenerateToken();

        return redirect('/');
    }
}