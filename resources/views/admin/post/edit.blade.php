@extends('template_backend.master')

@section('title')
<title>Edit Post</title>
@endsection

@section('subjudul')
Edit Post
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
                    <form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid':'' }}" value="{{$post->title}}" required>
                            <p class="text-danger">{{$errors->first('title')}}</p>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="category_id" >
                                <option value="" >Pilih</option>
                                @foreach ($category as $row)
                                <option value="{{ $row->id }}"
                                    @if ($post->category_id == $row->id)
                                        selected
                                    @endif
                                    
                                    >{{$row->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{$errors->first('category_id')}}</p>
                        </div>

                        <div class="form-group">
                            <label>Tag</label>
                            <select class="form-control select2" multiple="" name="tags[]">
                                {{-- foreach tags yang suda di parsing di PostController --}}
                                @foreach ($tags as $row)
                                <option value="{{$row->id}}"
                                    {{-- memnaggil method tag() yang ada di Model Post --}}
                                    @foreach ($post->tag as $value)
                                      {{-- cek, apabila row->id == isi dari $value --}}
                                        @if ($row->id == $value->id)
                                            selected
                                        @endif
                                    @endforeach
                                    >{{ $row->name }}</option>
                                @endforeach
                            </select>
                          </div>

                        <div class="form-group">
                            <label>kontent</label>
                            <textarea class="form-control" name="content" id="" cols="50" rows="50">{{$post->content}}</textarea>
                            <p class="text-danger">{{$errors->first('content')}}</p>
                        </div>

                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="photo" class="form-control" >
                            <p class="text-danger">{{$errors->first('photo')}}</p>
                            <hr>
                            @if (!empty($post->photo))
                                <img src="{{asset('uploads/post/'.$post->photo)}}" alt="{{$post->name}}" width="150px" height="150px">
                            @endif
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
