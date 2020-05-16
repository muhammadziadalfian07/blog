@extends('blog')

@section('content')
@foreach ($data as $post)
<div id="nav-bottom">
    <!-- PAGE HEADER -->
    <div id="post-header" class="page-header">
        <div class="page-header-bg" style="background-image: url( {{ asset('uploads/post/' . $post->photo) }} );"
            data-stellar-background-ratio="0.5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="post-category">
                        <a href="category.html">{{$post->category->name}}</a>
                    </div>
                    <h1>{{$post->title}}</h1>
                    <ul class="post-meta">
                        <li><a href="author.html">{{$post->user->name}}</a></li>
                        <li>{{$post->created_at}}</li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /PAGE HEADER -->
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-8">
                    {!!$post->content!!}
                </div>
                {{-- widgat --}}
                @include('frontend.widgat')
            </div>
        </div>
    </div>
    <link href="{{ asset('ckeditor/plugins/codesnippet/lib/highlight/styles/monokai_sublime.css') }}" rel="stylesheet">
    
    <script src="{{ asset('ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') }}"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    @endforeach
    @endsection
