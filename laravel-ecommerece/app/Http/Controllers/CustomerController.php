<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index()
    {
        return view('web.customer.register');
    }
    public function profile()
    {
        $userId = Auth::user()->id;
        // dd($userId);
        if($userId){
            $order = Order::where('user_id',$userId)->get();
            $orderAddress = OrderAddress::where('user_id', $userId)->where('address_type', 'shipping')->get();
            // dd($orderAddress);
            $wishlists = Wishlist::where('user_id', $userId)->with('product')->get();
            return view('web.customer.profile',compact('order','wishlists','orderAddress'));
        }
        return redirect()->route('customer.login')->with('error', 'You are login credentials fill.!');

    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 0,
        ]);
        // dd($user);
        if ($user) {
            return redirect()->route('customer.login');
        }
        return view('web.customer.login');
    }
    public function login()
    {
        $checkoutItems = session('cart_id');
        if ($checkoutItems !== null) {
            session(['cart_id' => $checkoutItems]);
        }
        return view('web.customer.login');
    }
    public function authenticate(Request $request)
    {
        //    $data = $request->all();
        //    dd($data);
        $data =  $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 0])){
                reActiveCart(Auth::user()->id);
                return redirect()->route('home')->withSuccess('You have successfully logged in');
            };

            return back()->with('error', 'your provided credentials do not match');

        

    }
    public function update(Request $request){
        $userData = Auth::user();
        // $data = $userData;
        // dd($data);
        if (!Hash::check($request->current_password, $userData->password)) {
            return back()->with('error', "Current Password is Invalid");
        }
        if (strcmp($request->current_password, $request->new_password) == 0) {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $user =  User::find($userData->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return back()->with('success', "Password Changed Successfully");
    }
    public function logout()
    {
        
        session::forget('cart_id');
        Auth::logout();
        return redirect()->route('home');
    }
}
