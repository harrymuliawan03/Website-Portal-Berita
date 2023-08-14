@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Post</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/posts" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug (automatic fill)</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
            @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select id="category" name="category_id" class="form-select">

            </select>
        </div>
        <div class="mb-3">
            <label for="category-detail" class="form-label">Sub Category</label>
            <select id="category_detail" class="form-select" name="sub_category[]" multiple="multiple">

            </select>
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Post Image (max 1MB)</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
            <trix-editor input="body"></trix-editor>
            @error('body')
               <p class="text-danger">{{ $message }}</p> 
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Create Post</button>
        <a href="/dashboard/posts" class="btn btn-danger mb-3">Cancel</a>
    </form>
</div>



    @section('script')
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', () => {
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', (e) => {
            e.preventDefault();
        });

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        $(document).ready(function(){

            $('#category').select2({
                placeholder: 'Pilih Category',
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
                console.log(id);

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
@endsection