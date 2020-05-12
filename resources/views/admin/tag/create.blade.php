@extends('template_backend.master')

@section('title')
<title>Tambah Tag</title>
@endsection

@section('subjudul')
Tambah Tag
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
                    <form action="{{ route('tag.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tag</label>
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
