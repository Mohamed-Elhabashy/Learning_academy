@extends('admin.Layout')

@section('content')
        <div class="d-flex justify-content-between mb-3">
            <h6>Students</h6>
            <a class="btn btn-sm btn-primary" href="{{route('admin.students.create')}}">Add new</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Spec</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $s)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$s->name}}</td>
                    @if($s->email==null)
                        <td>not exist</td>
                    @else
                        <td>{{$s->email}}</td>
                    @endif
                    @if($s->spec==null)
                        <td>not exist</td>
                    @else
                        <td>{{$s->spec}}</td>
                    @endif
                    <td>
                        <a class="btn btn-sm btn-info" href="{{route('admin.students.edit',['id'=>$s->id])}}">Edit</a>
                        <a class="btn btn-sm btn-danger" href="{{route('admin.students.delete',$s->id)}}">Delete</a>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.students.ShowCourses',$s->id)}}">Show Courses</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
@endsection