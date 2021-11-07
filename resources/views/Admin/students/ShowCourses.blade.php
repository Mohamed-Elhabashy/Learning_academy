@extends('Admin.Layout')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h6>Course / Show Courses</h6>
        <div>
            <a class="btn btn-sm btn-info" href="{{route('admin.students.AddToCourse',$student_id)}}">Add Student To Course</a>
            <a class="btn btn-sm btn-primary" href="{{route('admin.courses.index')}}">Back</a>
    
        </div>  
    </div>      
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($courses as $c)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$c->name}}</td>
                    <td>{{$c->pivot->status}}</td>
                    <td>
                        @if($c->pivot->status !== 'approve')
                            <a class="btn btn-sm btn-info" href="{{route('admin.students.approvecourse',[$student_id,$c->id])}}">Approve</a>
                        @endif
                        @if($c->pivot->status !== 'rejected')
                            <a class="btn btn-sm btn-danger" href="{{route('admin.students.rejectedcourse',[$student_id,$c->id])}}">Reject</a> 
                        @endif              
                    </td>
                </tr>
            @endforeach 
        </tbody>
    </table>

@endsection