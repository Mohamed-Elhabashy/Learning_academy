@extends('admin.Layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h6>Course / Add New</h6>
        <a class="btn btn-sm btn-primary" href="{{route('admin.courses.index')}}">Back</a>
    </div>
    @include('admin.inc.errors')
    <form  method="post" action="{{route('admin.courses.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">    
            <label>Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group mb-3">      
            <label>Category</label>
            <select class="form-control mt-2" name="cat_id">
                <option value=""></option>  
                @foreach($categories as $cat)
                    <option value={{$cat->id}}>{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">     
            <label>Trainer</label>
            <select class="form-control mt-2" name="trainer_id">
                <option value=""></option>  
                @foreach($trainers as $t)
                    <option value={{$t->id}}>{{$t->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">    
            <label>small desc</label>
            <input type="text" name="small_desc" class="form-control">
        </div>
        <div class="form-group mb-3">    
            <label>Desc</label>
            <textarea name="desc" class="form-control" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group mb-3">    
            <label>price</label>
            <input type="number" name="price" class="form-control">
        </div>
        <div class="form-group mb-3">    
            <label>image</label>
            <input type="file" name="img" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
@endsection