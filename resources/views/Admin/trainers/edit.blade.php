@extends('Admin.Layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h6>Trainer / Edit</h6>
        <a class="btn btn-sm btn-primary" href="{{route('admin.trainer.index')}}">Back</a>
    </div>
    @include('admin.inc.errors')
    <form  method="post" action="{{route('admin.trainer.update')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">    
            <input type="hidden" name="id" value="{{$trainer->id}}">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{$trainer->name}}">
        </div>
        <div class="form-group mb-3">    
            <label>phone</label>
            <input type="text" name="phone" class="form-control" value="{{$trainer->phone}}">
        </div>
        <div class="form-group mb-3">    
            <label>specialty</label>
            <input type="text" name="spec" class="form-control" value="{{$trainer->spec}}">
        </div>
        <img src="{{asset('Uploads/trainers/'.$trainer->img)}}" height="100px" class="my-5">
        <div class="form-group mb-3">    
            <label>image</label>
            <input type="file" name="img" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
@endsection