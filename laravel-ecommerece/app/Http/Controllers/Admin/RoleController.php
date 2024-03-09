<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('role'), 403);

        $role = Role::all();

        return view('admin.role.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('role'), 403);

        $permission = Permission::all();
        return view('admin.role.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->permission);
        $role = $request->validate([
            'name' => 'required'
        ]);
        $roles =  Role::create($role);
        $roles->syncPermissions($request->input('permission'));
        return redirect()->route('role.index')->withsuccess('Data Add seccessfully');
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
        abort_unless(Gate::allows('role'), 403);

        $role = Role::find($id);
        $permission = Permission::all();
        $permiData = $role->permissions->pluck('name')->toArray();

        return view('admin.role.edit', compact('role','permission','permiData'));
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
        // $role = $request->all();
        // $role = $request->except('_token', '_method');
        // Role::where('id', $id)->update($role);
        $role = Role::findOrfail($id);
        $role->update([
            'name'=>$request->name,
        ]);
        // if($request->has('permission')){
            $role->syncPermissions($request->permission);
        // }
        return redirect()->route('role.index')->withsuccess('Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::where('id', $id)->delete();
        return redirect()->route('role.index')->withsuccess('Data Deleted Successfully');
    }
}
