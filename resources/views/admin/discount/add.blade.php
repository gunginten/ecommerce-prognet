@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Add a Discount</h1>
</div>

@if(session('success')) 
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

<form action="/admin/list-discount" method="POST"  enctype="multipart/form-data" >
    @csrf
    <select class="form-select @error('product_id') is-invalid @enderror" aria-label="Default select example" id="product_id" name="product_id">
            <option selected disabled value="">Choose a Product</option>
                @foreach($products as $product)  
                    <option value="{{$product->id}}">{{$product->product_name}}</option>     
                @endforeach 
        </select>
            @error('product_id')
            <div class="invalid-feedback">
               Choose a product.
            </div>
            @enderror
    <br><div class="form-group">
        <label for="percentage">Percentage</label>
        <input type="text" class="form-control" name="percentage" id="percentage" value="{{ old('percentage') }}" placeholder="Amount of Percentage">
        @error('percentage')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="start">Start</label>
        <input type="date" class="form-control" name="start" id="start" value="{{ old('start') }}" placeholder="Date start">
        @error('start')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="end">End</label>
        <input type="date" class="form-control" name="end" id="end" value="{{ old('end') }}" placeholder="Date end">
        @error('end')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div><br>
    <button type="submit" class="btn btn-primary">Add Product</button>
    <a href="/admin/list-product" class="btn btn-outline-primary">Back</a>
</form>
@endsection