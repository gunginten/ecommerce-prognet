@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Products</h1>
</div>

<a href="/admin/add-product" class="btn btn-primary mb-3">Add a Product</a>
<a href="/admin/product/trash" class="btn btn-danger mb-3">Trash</a>
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">#</th>
            <th scope="col"width="150px">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Rate</th>
            <th scope="col">Stock</th>
            <th scope="col">Weight</th>
            <th scope="col"width="250px">Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($products as $key=>$product)
                <tr>
                    <td>{{$key + 1}}</th>
                    <td><img src="{{ asset('images/'. $product->image_name) }}" class="rounded d-block" width="150px"></td>
                    <td>{{$product->product_name}}</td>
                    <td>
                        @php
                            $product->price = 'Rp' . number_format($product->price, 2, '.', ',');
                            echo $product->price;
                        @endphp
                    </td>
                    <td>{{$product->rate}}</td>
                    <td>{{$product->stock}}</td>
                    <td>
                        @php
                            $product->weight = ($product->weight) .' gram';
                            echo $product->weight;
                        @endphp
                    </td>
                    <td>
                        <form action="/admin/product/{{$product->id}}" method="POST">
                            <a href="{{route('admin.product-detail',$product->id)}}" class="btn btn-success">Detail</a>
                            <a href="{{route('admin.product-edit',$product->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('admin.product-delete',$product->id)}}" class="btn btn-danger"  onclick="return confirm('Are you sure?')">Delete</a>
                        </form>
                    </td>
                </tr>
            @empty
                <tr colspan="3">
                    <td class="text-center">No data</td>
                </tr>  
            @endforelse              
        </tbody>
    </table>


@endsection