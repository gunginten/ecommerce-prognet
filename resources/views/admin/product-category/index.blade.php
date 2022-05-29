@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Product's Category</h1>
</div>
<a href="{{route('admin.product-category.create')}}" class="btn btn-primary mb-3">Add a Product Category</a>
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productCategories as $key => $productCategory)
                <tr>
                    <td>{{$key + 1}}</th>
                    <td>{{$productCategory->category_name}}</td>
                  
                    <td>
                        <a href="{{route('admin.product-category.edit',$productCategory->id)}}" class="btn btn-info">Edit</a>
                        <form action="/admin/product-category/{{$productCategory->id}}/delete" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger my-1" onclick="return confirm('Are you sure?')" value="Delete">
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