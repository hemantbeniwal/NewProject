<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login.index');
    }
    public function login(Request $request)
    {
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            return redirect()->route('dashboard')->withSuccess('Login Successfully...');
        } else {
            return redirect()->route('login')->withError('email and passward not valid...');
            // dd($data);

        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
