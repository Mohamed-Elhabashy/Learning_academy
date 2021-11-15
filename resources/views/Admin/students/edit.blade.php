@extends('admin.Layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h6>Students / Edit</h6>
        <a class="btn btn-sm btn-primary" href="{{route('admin.students.index')}}">Back</a>
    </div>
    @include('admin.inc.errors')
    <form  method="post" action="{{route('admin.students.update')}}">
        @csrf
        <div class="form-group mb-3">    
            <input type="hidden" name="id" value="{{$student->id}}">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{$student->name}}">
        </div>
        <div class="form-group mb-3">    
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{$student->email}}">
        </div>
        <div class="form-group mb-3">    
            <label>Spec</label>
            <input type="text" name="spec" class="form-control" value="{{$student->spec}}">
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
@endsection