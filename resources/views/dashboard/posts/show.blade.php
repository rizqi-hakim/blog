@extends('dashboard.layouts.main')

@section('content')
<div class="cointainer">
    <div class="row my-3">
        <div class="col-lg-8">
            <h2 class="mb-3">{{ $post->title }}</h2>

            <a href="{{ route('DPosts.index') }}" class="btn btn-sm btn-success"><span data-feather="arrow-left"></span> Back to all my posts</a>
            <a href="{{ route('DPosts.edit', $post->slug) }}" class="btn btn-sm btn-warning"><span data-feather="edit"></span> Edit</a>
            <form action="{{ route('DPosts.destroy', $post->slug) }}" method="POST" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
            </form>
          
            <div style="max-height: 350px; overflow:hidden">
                <img src="{{ $post->image ? $post->image : 'https://source.unsplash.com/1200x400?'.$post->category->name }}" alt="" class="img-fluid mt-3">
            </div>
          
            <article class="my-3">
                {!! $post->body !!}
            </article>
          
        </div>
    </div>
</div>
@endsection