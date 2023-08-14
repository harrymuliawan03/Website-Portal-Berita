@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Post</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/posts/{{ $post->slug }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title', $post->title) }}">
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug (automatic fill)</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
            @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select id="category" class="form-select" name="category_id">
                <option value="">{{ $post->category->category_name }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Sub Category</label>
            <select id="category_detail" class="form-select" name="sub_category[]" multiple="multiple">
                @foreach ($post->post_details as $item)
                    <option value="{{ $item->category_detail->id }}" selected="selected">{{ $item->category_detail->category_detail_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Post Image (max 1MB)</label>
            @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
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
            <label for="body" class="form-label">Body</label>
            <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
            <trix-editor input="body"></trix-editor>
            @error('body')
               <p class="text-danger">{{ $message }}</p> 
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Update Post</button>
        <a href="/dashboard/posts" class="btn btn-danger mb-3">Cancel</a>
    </form>
</div>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', () => {
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    })

    document.addEventListener('trix-file-accept', (e) => {
        e.preventDefault();
    });

        $(document).ready(function(){

            $('#category_detail').select2();

            $('#category').select2({
                ajax: {
                    url: "{{route('category.index')}}",
                    processResults: function({data}) {
                        return {
                            results: $.map(data, function(item) {
                                return{
                                    id: item.id,
                                    text: item.category_name
                                }
                            })
                        }
                    }
                }
            });

            $('#category').change(function() {
                let id = $('#category').val();

                $('#category_detail').select2({
                    placeholder: 'pilih Sub Category',
                    ajax: {
                    url: "{{url('subcategory')}}/"+ id,
                    processResults: function({data}) {
                        return {
                            results: $.map(data, function(item) {
                                return{
                                    id: item.id,
                                    text: item.category_detail_name
                                }
                            })
                        }
                    }
                }
                });
            });
            });
</script>
@endsection