@extends('template_backend.master')

@section('title')
<title>Trash</title>
@endsection

@section('subjudul')
Post
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {!!session('success')!!}
                </div>
                @endif

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Name</th>
                                <th>Katgori</th>
                                <th>Tag</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $e=>$row)
                            <tr>
                                <td>{{$e+1}}</td>
                                <td>
                                    @if (!empty($row->photo))
                                    <img src="{{ asset('uploads/post/' . $row->photo) }}" alt="{{ $row->title }}"
                                        width="50px" height="50px">
                                    @else
                                    <img src="http://via.placeholder.com/50x50" alt="{{ $row->title }}">
                                    @endif
                                </td>
                                <td>{{$row->title}}</td>
                                <td>{{$row->category->name}}</td>
                                <td>
                                    @foreach ($row->tag as $tags)
                                        
                                            <span class="badge badge-secondary">{{$tags->name}}</span>
                                        
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{route('post.forceDelete',$row->id)}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{ route('post.restore',$row->id) }}" class="btn btn-warning btn-sm"><i
                                                class="fa fa-pencil-alt"></i> Restore</a>
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
