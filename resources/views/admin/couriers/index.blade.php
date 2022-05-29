@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Couriers</h1>
</div>
<a href="{{route('admin.couriers.create')}}" class="btn btn-primary mb-3">Add a Courier</a>
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Couriers</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($couriers as $key => $couriers)
                <tr>
                    <td>{{$key + 1}}</th>
                    <td>{{$couriers->courier}}</td>
                  
                    <td>
                        <a href="{{route('admin.couriers.edit',$couriers->id)}}" class="btn btn-info">Edit</a>
                        <form action="/admin/couriers/{{$couriers->id}}/delete" method="POST">
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