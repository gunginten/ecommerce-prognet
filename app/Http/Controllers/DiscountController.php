<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Discount;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::orderBy('id','desc')->get();
        $product = Product::all();
        return view('admin.discount.list', compact('discounts', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $discount = Discount::all();

        return view('admin.discount.add', compact('discount', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'percentage' => 'required',
            'start' => 'required',
            'end' => 'required|after:start',
        ]);

        $discount = new discount();
        $discount->product_id = $request->product_id;
        $discount->percentage = $request->percentage;
        $discount->start = $request->start;
        $discount->end = $request->end;
        $discount->save();

        return redirect('admin/list-discount')->with('success', 'Data submission successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discount = Discount::find($id);
        $products = Product::query()->orderby('product_name', 'asc')->get();
        return view('admin.discount.edit', compact (['discount','products']));
            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount, $id)
    {
        $request->validate([
            'product_id' => 'required',
            'percentage' => 'required',
            'start' => 'required',
            'end' => 'required|after:start',
        ]);

        $discount = Discount::find($id);
        $discount->product_id = $request->product_id;
        $discount->percentage = $request->percentage;
        $discount->start = $request->start;
        $discount->end = $request->end;
        $discount->save();

        return redirect('admin/list-discount')->with('success', 'Data change successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::find($id);
        $discount->delete();
        return redirect('admin/list-discount')->with('status', 'Data successfully deleted!');
    }
}

