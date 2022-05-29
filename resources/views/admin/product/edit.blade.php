@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Edit a Product</h1>
</div>

@if(session('success')) 
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-4 col-centered">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action cardaction-toggle" data-card-toggle></a>
                    <a href="#" class="card-action cardaction-dismiss" data-card-dismiss></a>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Image
                </button>
            </header>
            <div class="card-header">  
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($product->images as $index=> $image)
                        @if($index == 0)
                            <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('images/'. $image->image_name) }}"      height="200px" alt="">
                            
                            <form class="text-center" action="{{ route('admin.productImages-destroy',['id'=>$image->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf  
                                <button type="submit" class="btn btn-danger" onclick="confirm ('Are you sure?') "> Delete </button>
                            </form>
                            </div>
                            @else
                            <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('images/'. $image->image_name) }}"      height="200px" alt="">
                            
                            <form class="text-center" action="{{ route('admin.productImages-destroy',['id'=>$image->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf  
                                <button type="submit" class="btn btn-danger" onclick="confirm ('Are you sure?') "> Delete </button>
                            </form>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>     
        </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.productImages-store') }}" method="POST" class="form-group" enctype="multipart/form-data">
        @csrf
            <input type="file" name="files" multiple class="form-control p-1">
            <br>
            <input type="hidden"value="{{$product->id}}" name="product_id">
            <button type="submit" class="btn btn-primary">SUbmit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<form action="{{route('admin.product-update',$product->id)}}" method="POST"  enctype="multipart/form-data" >
    @csrf
    <br><div class="col-md">
        <div class="card-header py-3">
            <div class="form-group">
                <label for="product_name">Product</label>
                <input type="text" class="form-control" name="product_name" id="product_name" value="{{$product->product_name}}">
                @error('product_name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" id="price" value="{{$product->price}}">
                @error('price')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{$product->description}}</textarea>
                @error('description')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-1">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" name="stock" id="stock" value="{{$product->stock}}">
                @error('stock')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-1">
                <label for="weight">Weight (Kg)</label>
                <input type="number" class="form-control" name="weight" id="weight" value="{{$product->weight}}">
                @error('weight')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div><br>
            <button type="submit" class="btn btn-primary">Save Product</button>
            <a href="/admin/list-product" class="btn btn-outline-primary">Back</a>
        </div>
    </div>
</form>
</div>
</div>
@endsection