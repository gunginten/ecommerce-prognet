<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminManagementController extends Controller
{
    //
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admin-management.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admin-management.add');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admin.admin-management.edit')->with(compact('admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:admins,email',
            'password'=>'required',
            'role' => 'required'
        ]);

      
        $data = new Admin();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->role = $request->role;
        $data->save();

        if($data){
            return redirect()->route('admin.management.index')->with('success','Register Success');

        }else{
            return redirect()->back()->with('error','Register Failed');
        }

    }

    public function update($id,Request $request)
    {
        $request->validate([
            'name'=>'required',
            'role' => 'required'
        ]);

      
        $data = Admin::find($id);
        $data->update([
            'name' => $request->name,
            'role' => $request->role
        ]);

        return redirect()->route('admin.management.index')->with('success','Update success');

    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect()->route('admin.management.index')->with('status', 'Data successfully deleted!');
    }
}
