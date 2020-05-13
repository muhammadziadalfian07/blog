@extends('template_backend.master')

@section('title')
<title>Tambah Post</title>
@endsection

@section('subjudul')
Tambah Post
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
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid':'' }}" required>
                            <p class="text-danger">{{$errors->first('title')}}</p>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="category_id" >
                                <option value="" >Pilih</option>
                                @foreach ($category as $row)
                                    <option value="{{ $row->id }}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{$errors->first('category_id')}}</p>
                        </div>

                        <div class="form-group">
                            <label>Tag</label>
                            <select class="form-control select2" multiple="" name="tags[]">
                                @foreach ($tag as $row)
                                <option value="{{$row->id}}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                          </div>

                        <div class="form-group">
                            <label>kontent</label>
                            <textarea class="form-control" name="content" id="" cols="50" rows="50"></textarea>
                            <p class="text-danger">{{$errors->first('content')}}</p>
                        </div>

                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="photo" class="form-control" >
                            <p class="text-danger">{{$errors->first('photo')}}</p>
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
</div>

    @endsection
