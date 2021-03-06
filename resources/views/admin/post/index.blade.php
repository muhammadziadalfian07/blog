@extends('template_backend.master')

@section('title')
<title>Post</title>
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
                    <p class="float-left">
                        <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm mb-3"><i
                                class="fa fa-plus"></i> Tambah Post</a>
                    </p>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Name</th>
                                <th>Penulis</th>
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
                                <td>{{$row->user->name}}</td>
                                <td>{{$row->category->name}}</td>
                                <td>
                                    @foreach ($row->tag as $tags)
                                        <ul>
                                            <h6><span class="badge badge-info">{{$tags->name}}</span></h6>
                                        </ul>
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('post.destroy',$row->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{ route('post.edit',$row->id) }}" class="btn btn-warning btn-sm"><i
                                                class="fa fa-pencil-alt"></i></a>
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
