@extends('template_backend.master')

@section('title')
<title>Tag</title>
@endsection

@section('subjudul')
Tag
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
                        <a href="{{ route('tag.create') }}" class="btn btn-primary btn-sm mb-3"><i
                                class="fa fa-plus"></i> Tambah Tag</a>
                    </p>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tag as $e=>$row)
                            <tr>
                                <td>{{$e+1}}</td>
                                <td>{{$row->name}}</td>
                                <td>
                                    <form action="{{ route('tag.destroy',$row->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{ route('tag.edit',$row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{$tag->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
