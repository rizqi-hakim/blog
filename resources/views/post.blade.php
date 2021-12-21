@extends('layouts.main')

@section('title')
    Blog | {{ $title }}
@endsection

@section('content')
    <div class="cointainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-3">{{ $post->title }}</h2>
              
                <p>By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>
                <div style="max-height: 350px; overflow:hidden">
                    <img src="{{ $post->image ? $post->image : 'https://source.unsplash.com/1200x400?'.$post->category->name }}" alt="" class="img-fluid mt-3">
                </div>
              
                <article class="my-3">
                    {!! $post->body !!}
                </article>
              
                <a href="{{ route('posts.index') }}" class="d-block mt-3">Back to all posts</a>
            </div>
        </div>
    </div>
@endsection