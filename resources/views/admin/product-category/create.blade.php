@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Add a Product Category</h1>
</div>

@if(session('success')) 
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

<form action="/admin/product-category-store" method="POST"  enctype="multipart/form-data" >
    @csrf
  
    <div class="form-group">
        <label for="CategoryName">Category Name</label>
        <input type="text" class="form-control" name="category_name" id="CategoryName" value="{{ old('category_name') }}" placeholder="Input category name">
        @error('category_name')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Add Product Category</button>
    <a href="/admin/product-category" class="btn btn-outline-primary">Back</a>
</form>
@endsection