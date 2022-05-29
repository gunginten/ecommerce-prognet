@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Data Admin</h1>
</div>

@if(session('success')) 
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

<form action="{{route('admin.management.update', $admin->id)}}" method="POST"  enctype="multipart/form-data" >
    @csrf
    <div class="form-group">
        <label for="product_name mt-3">Admin Name</label>
        <input type="text" class="form-control mt-3" name="name" id="name" value="{{$admin->name}}" placeholder="Input nama admin">
        @error('name')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="product_name mt-3">Admin Email</label>
        <input type="email" class="form-control mt-3" name="email" id="email" value="{{$admin->email}}" placeholder="Input email admin" readonly>
        @error('email')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
        <label for="product_name mt-3">Role</label>
        <select class="form-select mt-3 @error('role') is-invalid @enderror" aria-label="Default select example" id="role" name="role">
            <option selected disabled value="">Choose a role admin</option>
                <option value="superadmin" @if($admin->role == "superadmin") selected @endif>superadmin</option>     
                <option value="admin" @if($admin->role == "admin") selected @endif>admin</option>     
        </select>
        @error('role')
        <div class="invalid-feedback">
            Choose a role admin.
        </div>
    </div>
    
    
    @enderror
    <button type="submit" class="btn btn-primary mt-3" >Update Data Admin</button>
    <a href="{{route('admin.management.index')}}" class="btn btn-outline-primary mt-3">Back</a>
</form>
@endsection