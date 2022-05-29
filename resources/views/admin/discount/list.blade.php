@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Discounts</h1>
</div>

<a href="/admin/add-discount" class="btn btn-primary mb-3">Add a Discount</a>
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Percentage</th>
            <th scope="col">Start</th>
            <th scope="col">End</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($discounts as $key=>$discount)
                <tr>
                    <td>{{$key + 1}}</th>
                    <td>{{$discount->product->product_name}}</td>
                    <td>{{$discount->percentage}}</td>
                    <td>{{$discount->start}}</td>
                    <td>{{$discount->end}}</td>
                    <td>
                        <form action="/admin/discount/{{$discount->id}}" method="POST">
                            <a href="{{route('admin.discount-edit',$discount->id)}}" class="btn btn-info">Edit</a>
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