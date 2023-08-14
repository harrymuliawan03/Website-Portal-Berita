
@extends('layouts.main')

@section('container')

<div class="container">
        <div class="row justify-content-center mb-5">
                <div class="col-md-8">
                        {{-- @if(request('author'))?author={{ request('author') }} @endif --}}
                        @if (request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        @if (request('author'))
                                <input type="hidden" name="author" value="{{ request('author') }}">
                        @endif
                        <h1 class="mb-3">{{ $post->title }}</h1>

                        <p>By. <a href="/authors/{{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->category_name }}" class="text-decoration-none">{{ $post->category->category_name }} 
                                       ( @foreach ($post->category_details as $item)
                                                - {{ $item->category_detail_name  }}
                                        @endforeach
                                       )
                        </a></p>
                        
                        
                        @if ($post->image)
                                <div style="max-height: 350px; overflow:hidden;">
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->category_name}}" class="img-fluid">
                                </div>
                        @else
                                <img src="https://source.unsplash.com/1200x400?{{ $post->category->category_name }}" alt="{{ $post->category->category_name }}" class="img-fluid">
                        @endif
                        

                        <article class="my-3">
                                {!! $post->body !!}
                        </article>
                        @if(request('author'))
                        <a href="/posts?author={{ request('author') }}" class="d-block mt-3">Back to Posts</a>
                        @elseif(request('category'))
                        <a href="/posts?category={{ request('category') }}" class="d-block mt-3">Back to Posts</a>
                        @else
                        <a href="/posts" class="d-block mt-3">Back to Posts</a>
                        @endif
                </div>
        </div>    
</div>

@endsection