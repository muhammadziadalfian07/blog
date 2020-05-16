@extends('blog')

@section('content')
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-8">
                <!-- post -->
                @foreach ($data as $post)
                <div class="post post-row">
                <a class="post-img" href="{{ route('isi.post',$post->slug) }}"><img src="{{ asset('uploads/post/'.$post->photo) }}" alt=""></a>
                    <div class="post-body">
                        <div class="post-category">
                           {{$post->category->name}}
                        </div>
                        <h3 class="post-title">{{$post->title}}</a></h3>
                        <ul class="post-meta">
                            <li><a href="author.html">{{$post->user->name}}</a></li>
                            <li>{{$post->created_at}}</li>
                            <p>
                                {!! \Illuminate\Support\Str::words($post->content, 10)  !!}
                            </p>
                        </ul>
                    </div>
                </div>
                @endforeach
                <!-- /post -->
                <div class="section-row loadmore text-center">
                    {{$data->links()}}
                </div>
            </div>
            @include('frontend.widgat')
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
    @endsection
