<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Couriers;

class CouriersController extends Controller
{
    public function index(){
        $couriers = Couriers::all();
        
        return view('admin.couriers.index',['couriers' => $couriers]);
    }

    public function create(){
        return view('admin.couriers.create');
    }

    public function store(Request $request){
        Couriers::create($request->all());
        return redirect()->route('admin.couriers.index');
    }

    public  function edit($id){
        $couriers = Couriers::find($id);
        
        return view('admin.couriers.edit', compact('couriers'));
    }

    public function update(Request $request, $id){
        Couriers::find($id)->update(['courier' => $request->courier]);     
        return redirect()->route('admin.couriers.index');   
    }

    public function delete($id){
        Couriers::find($id)->delete();
        return redirect()->route('admin.couriers.index'); 
    }

}
