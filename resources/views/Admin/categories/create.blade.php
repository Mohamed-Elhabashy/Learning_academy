@extends('admin.Layout')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h6>Categories / Add New</h6>
    <a class="btn btn-sm btn-primary" href="{{route('admin.categories.index')}}">Back</a>
</div>
@include('admin.inc.errors')
<form method="post" action="{{route('admin.categories.store')}}">
    @csrf
    <div class="form-group mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
</form>
@endsection
