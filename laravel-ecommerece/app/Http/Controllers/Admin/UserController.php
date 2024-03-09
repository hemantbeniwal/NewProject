<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('user_index'), 403);
      
        // dd($userId);
        $user = User::where('is_admin',1)->get();
        // dd($user);
        return view('admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('user_create'), 403);

        $role = Role::all();
        return view('admin.user.create', compact('role'));
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
        $user = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
            // 'confrm password'=>'required',
        ]);
        $user['password'] = Hash::make($user['password']);
        $data = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> $user['password'],
            'is_admin'=>1,
        ]);
        $data->syncRoles($request->input('role'));
        return redirect()->route('user.index')->withSuccess('Data Add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('user_edit'), 403);

        $user = User::find($id);
        $role = Role::all();
        $roleData = $user->roles->pluck('name')->toArray();
        return view('admin.user.edit', compact('user', 'role', 'roleData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $data = $request->all();
        // dd($data);
        $password = $request->password;
        if (!($request->password)) {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
            ]);
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        } else {
            $data = $request->validate([
                "name" => "required",
                "email" => "required|email",
                "password" => "required|min:3",
                "confirm_password" => "required|min:3|same:password"
            ]);
            $user['password'] = Hash::make($password);
            User::where('id',$id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$user['password'] 
            ]);
        }
        $user = User::find($id);
        // dd($user);
        $user->syncRoles($request->input('roles'));
        
        return redirect()->route('user.index')->withSuccess('Data Updateed successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        $user->syncRoles([]);
        $user->delete();

        return redirect()->route('user.index')->withSuccess('Data Deleted successfully');
        // dd($user);

    }
}
