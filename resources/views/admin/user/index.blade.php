@extends('template_backend.master')

@section('title')
<title>User</title>
@endsection

@section('subjudul')
User
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
                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm mb-3"><i
                                class="fa fa-plus"></i> Tambah User</a>
                    </p>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $e=>$row)
                            <tr>
                                <td>{{$e+1}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>
                                    @if ($row->role)
                                        <span class="badge badge-success">Admin</span>
                                    @else
                                        <span class="badge badge-danger">Penulis</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('user.destroy',$row->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{ route('user.edit',$row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{$user->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
