@extends('admin.Layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h6>Student / Add To Course</h6>
        <a class="btn btn-sm btn-primary" href="{{route('admin.students.ShowCourses',$student_id)}}">Back</a>
    </div>
    @include('admin.inc.errors')
    <form  method="post" action="{{route('admin.students.StoreStudentCourse')}}">
        @csrf
        <input type="hidden" name="student_id" value="{{$student_id}}">
        <div class="form-group mb-3">    
            <label>Course</label>
            <select class="form-control mt-2" name="course_id">
                <option value=""></option>  
                @foreach($courses as $c)
                    <option value={{$c->id}}>{{$c->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>
@endsection