@extends('template_backend.master')

@section('title')
<title>Tambah User</title>
@endsection

@section('subjudul')
Tambah User
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {!!session('error')!!}
                        </div>
                    @endif
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required>
                            <p class="text-danger">{{$errors->first('name')}}</p>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}" required>
                            <p class="text-danger">{{$errors->first('email')}}</p>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}" >
                            <p class="text-danger">{{$errors->first('password')}}</p>
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control {{ $errors->has('role') ? 'is-invalid':'' }}" required>
                                <option value="">Pilih</option>
                                <option value="1">Admin</option>
                                <option value="0">Penulis</option>
                            </select>
                            <p class="text-danger">{{$errors->first('role')}}</p>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">
                                <i class="fa fa-send"></i>
                                 Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
