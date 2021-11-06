@extends('Admin.Layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h6>Course / Edit</h6>
        <a class="btn btn-sm btn-primary" href="{{route('admin.courses.index')}}">Back</a>
    </div>
    
    @include('admin.inc.errors')
    <form  method="post" action="{{route('admin.courses.update')}}" enctype="multipart/form-data">
        @csrf
        <input hidden name="id" value="{{$course->id}}">
        <div class="form-group mb-3">    
            <label>Name</label>
            <input type="text" name="name" value="{{$course->name}}" class="form-control">
        </div>
        <div class="form-group mb-3">      
            <label>Category</label>
            <select class="form-control mt-2" name="cat_id">
                <option value=""></option>  
                @foreach($cats as $cat)
                    <option value={{$cat->id}} @if($course->cat_id==$cat->id) selected @endif>{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">     
            <label>Trainer</label>
            <select class="form-control mt-2" name="trainer_id">
                <option value=""></option>  
                @foreach($trainers as $t)
                    <option value={{$t->id}} @if($course->trainer_id==$t->id) selected @endif>{{$t->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">    
            <label>small desc</label>
            <input type="text" name="small_desc" value="{{$course->small_desc}}" class="form-control">
        </div>
        <div class="form-group mb-3">    
            <label>Desc</label>
            <textarea name="desc" class="form-control" cols="30" rows="10">{{$course->desc}}</textarea>
        </div>
        <div class="form-group mb-3">    
            <label>price</label>
            <input type="number" name="price" value="{{$course->price}}" class="form-control">
        </div>
        <img src="{{asset('Uploads/Courses/'.$course->img)}}" height="100px" class="my-5">
        <div class="form-group mb-3">    
            <label>image</label>
            <input type="file" name="img" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
@endsection