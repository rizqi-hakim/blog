@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit post</h1>
</div>

<div class="col-lg-8">
    <form action="{{ route('DPosts.update', $post->slug) }}" method="POST" class="mb-5" enctype="multipart/form-data">
      @method('put')
        @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
            value="{{ old('title', $post->title) }}">
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
            value="{{ old('slug', $post->slug) }}" readonly>
        @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select" name="category_id">
            @forelse ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected':'' }}>{{ $category->name }}</option>
            @empty
                <option value="null">No Category Added</option>
            @endforelse
          </select>
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Post Image</label>
        @if ($post->image)
          <img src="{{ $post->image }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
        @else
          <img class="img-preview img-fluid mb-3 col-sm-5">
        @endif
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Content</label>
        @error('body')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
        <trix-editor input="body"></trix-editor>
      </div>
      <button type="submit" class="btn btn-sm btn-primary">Update Post</button>
    </form>
</div>

@section('script')
<script>
    $('#title').change(function(e) {
      $.get('{{ route('DPosts.checkSlug') }}', 
        { 'title': $(this).val() }, 
        function( data ) {
          $('#slug').val(data.slug);
        }
      );
    });

    document.addEventListener('trix-file-accept', function (e) {
        e.preventDefault();
    })

    function previewImage() {
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('.img-preview');
      imgPreview.style.display = 'block';

      const blob = URL.createObjectURL(image.files[0]);
      imgPreview.src = blob;
    }
</script>
@endsection

@endsection