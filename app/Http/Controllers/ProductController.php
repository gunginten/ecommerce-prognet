<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::query()->join('product_images', 'product_id', 'products.id')
        // ->select('products.*', 'product_images.image_name')
        // ->orderby('product_name', 'desc')->get();
        $products = Product::orderBy('id','desc')->get();
        return view('admin.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.add');
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
            'product_name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'weight' => 'required'
            // 'photo' => 'required'

        ]);

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->product_rate = '0';
        $product->stock = $request->stock;
        $product->weight = $request->weight;
        $product->save();

        if($product){
            $files = [];
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $nama_image = md5(now() . "_" . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images'),$nama_image);
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_name' => $nama_image
                    ]);
                }
            }
        }
         
        return redirect('admin/list-product')->with('success', 'Data submission successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $product = Product::find($id);
        return view('admin.product.detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, $id)
    {
        $product = Product::find($id);
        return view('admin.product.edit', compact ('product'));
            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'weight' => 'required'
            // 'photo' => 'required'

        ]);

        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->product_rate = $request->product_rate;
        $product->stock = $request->stock;
        $product->weight = $request->weight;
        $product->save();

        return redirect('admin/list-product')->with('success', 'Data change successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('admin/list-product')->with('status', 'Data successfully deleted!');
    }

    public function trash()
    {
        $products = Product::onlyTrashed()->get();
        return view('admin.trash.list', compact('products'));
    }
    
    public function restore($id = null)
    {
        $products = Product::onlyTrashed()->where('id', $id) ->restore();
        
        return redirect('admin/product/trash')->with('status'.'Program berhasil di-restore');
    }

    public function restore_all()
    {
        $products = Product::onlyTrashed()->restore();
        
        return redirect('admin/product/trash')->with('status'.'Program berhasil di-restore');
    }

    public function delete($id = null)
    {
        $products = Product::onlyTrashed()->where('id', $id)->forceDelete();

        return redirect('admin/product/trash')->with('status'.'Program berhasil dihapus');
    }

    public function delete_all()
    {
        $products = Product::onlyTrashed()->forceDelete();

        return redirect('admin/product/trash')->with('status'.'Program berhasil dihapus');
    }

}
