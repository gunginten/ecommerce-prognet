@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Add a Courier</h1>
</div>

@if(session('success')) 
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

<form action="/admin/couriers-store" method="POST"  enctype="multipart/form-data" >
    @csrf
  
    <div class="form-group">
        <label for="Courier">Courier</label>
        <input type="text" class="form-control" name="courier" id="Courier" value="{{ old('courier') }}" placeholder="Input courier name">
        @error('courier')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Add Courier</button>
    <a href="/admin/couriers" class="btn btn-outline-primary">Back</a>
</form>
@endsection