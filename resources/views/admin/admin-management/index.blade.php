@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Admin</h1>
</div>

<a href="{{route('admin.management.add')}}" class="btn btn-primary mb-3">Add data admin</a>
<!-- <a href="/admin/product/trash" class="btn btn-danger mb-3">Trash</a> -->
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">#</th>
            <th scope="col"width="150px">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Created At</th>
            <th scope="col"width="250px">Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($admins as $key=>$admin)
                <tr>
                    <td>{{$key + 1}}</th>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{$admin->role}}</td>
                    <td>{{$admin->created_at}}</td>
                    <td>
                        <form action="{{route('admin.management.delete', $admin->id)}}" method="POST">
                            <a href="{{route('admin.management.edit',$admin->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('admin.management.delete',$admin->id)}}" class="btn btn-danger"  onclick="return confirm('Are you sure?')">Delete</a>
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