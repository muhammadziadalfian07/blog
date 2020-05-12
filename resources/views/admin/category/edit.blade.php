@extends('template_backend.master')

@section('title')
<title>Edit Kategori</title>
@endsection

@section('subjudul')
Edit Kategori
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">@extends('template_backend.master')

@section('title')
<title>Kategori</title>
@endsection

@section('subjudul')
Tambah Kategori
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
                    <form action="{{ route('category.update',$category->id) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" 
                            value="{{$category->name}}" required>
                            <p class="text-danger">{{$errors->first('name')}}</p>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">
                                <i class="fa fa-send"></i>
                                 Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {!!session('error')!!}
                        </div>
                    @endif
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required>
                            <p class="text-danger">{{$errors->first('name')}}</p>
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
