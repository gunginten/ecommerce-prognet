<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index(){
        $productCategories = ProductCategory::all();
        
        return view('admin.product-category.index',['productCategories' => $productCategories]);
    }

    public function create(){
        return view('admin.product-category.create');
    }

    public function store(Request $request){
        ProductCategory::create($request->all());
        return redirect()->route('admin.product-category.index');
    }

    public  function edit($id){
        $productCategory = ProductCategory::find($id);
        
        return view('admin.product-category.edit', compact('productCategory'));
    }

    public function update(Request $request, $id){
        ProductCategory::find($id)->update(['category_name' => $request->category_name]);     
        return redirect()->route('admin.product-category.index');   
    }

    public function delete($id){
        ProductCategory::find($id)->delete();
        return redirect()->route('admin.product-category.index'); 
    }
}
