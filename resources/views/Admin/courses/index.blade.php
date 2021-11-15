@extends('admin.Layout')

@section('content')
        <div class="d-flex justify-content-between mb-3">
            <h6>Trainers</h6>
            <a class="btn btn-sm btn-primary" href="{{route('admin.courses.create')}}">Add new</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">img</th>
                <th scope="col">Name</th>
                <th scope="col">price</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $c)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                        <img src="{{asset('Uploads/Courses/'.$c->img)}}" height="50px">
                    </td>
                    <td>{{$c->name}}</td>
                    <td>{{$c->price}}</td>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{route('admin.courses.edit',['id'=>$c->id])}}">Edit</a>
                        <a class="btn btn-sm btn-danger" href="{{route('admin.courses.delete',$c->id)}}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
@endsection