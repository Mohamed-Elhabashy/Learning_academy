@extends('admin.Layout')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h6>Categories / Edit</h6>
    <a class="btn btn-sm btn-primary" href="{{route('admin.categories.index')}}">Back</a>
</div>
@include('admin.inc.errors')
<form method="post" action="{{route('admin.categories.update')}}">
    @csrf
    <div class="form-group mb-3">
        <input type="hidden" name="id" value="{{$cat->id}}">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{$cat->name}}">
    </div>
    <button type="submit" class="btn btn-primary">Edit</button>
</form>
@endsection
