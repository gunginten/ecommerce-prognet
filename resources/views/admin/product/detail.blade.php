@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Products Detail</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-centered">
            <div class="card-body">  
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($product->images as $index=> $image)
                        @if($index == 0)
                            <div class="carousel-item active">
                            <img class="img-thumbnail" src="{{ asset('images/'. $image->image_name) }}"  height="200px" alt="">
                            </div>
                            @else
                            <div class="carousel-item">
                            <img class="img-thumbnail" src="{{ asset('images/'. $image->image_name) }}" height="200px" alt="">
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

        <div class="col-md-6 contentRight">
            <br>
            <div class="card">
                <div class="card-body"> 
                    <table class="table">
                    <tbody>
                        <tr>
                        <th>Nama</th>
                        <td>{{$product->product_name}}</td>
                        </tr>
                        <tr>
                        <th>Description</th>
                        <td>{{$product->description}}</td>
                        </tr>
                        <tr>
                        <th>Price</th>
                        <td>{{$product->price}}</td>
                        </tr>
                        <tr>
                        <th>Stock</th>
                        <td>{{$product->stock}}</td>
                        </tr>
                        <tr>
                        <th>Weight</th>
                        <td>{{$product->weight}}</td>
                        </tr>
                        <th>Discount</th>
                        <td>
                        @foreach ($product->discounts as $discount) 
                        {{$discount->percentage}} %
                        @endforeach
                        </td>
                        </tr>
                    </tbody>
                    </table>
                    </div>
            </div>
            <a type="button" class="btn btn-dark my-2" href="javascript:window.history.back()">Back</a>
        </div>
    </div>
</div>
@endsection