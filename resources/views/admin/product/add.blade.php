@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Products</h1>
</div>

@if(session('success')) 
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

<form action="/admin/list-product" method="POST"  enctype="multipart/form-data" >
    @csrf
    <div class="form-group">
        <label for="product_name">Product</label>
        <input type="text" class="form-control" name="product_name" id="product_name" value="{{ old('product_name') }}" placeholder="Name of Product">
        @error('product_name')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" class="form-control" name="price" id="price" value="{{ old('price') }}" placeholder="Price of Product">
        @error('price')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
        @error('description')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group col-md-1">
        <label for="stock">Stock</label>
        <input type="number" class="form-control" name="stock" id="stock" value="{{ old('stock') }}">
        @error('stock')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group col-md-1">
        <label for="weight">Weight (gram)</label>
        <input type="number" class="form-control" name="weight" id="weight" value="{{ old('weight') }}">
        @error('weight')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="product_image">Upload Image</label><br>
        <input type="file" name="files[]">
    </div><br>
    <button type="submit" class="btn btn-primary">Add Product</button>
    <a href="/admin/list-product" class="btn btn-outline-primary">Back</a>
</form>
@endsection