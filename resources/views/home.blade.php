@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="col-md-6">
      <form action="/posts">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
          <button class="btn btn-danger" type="submit">Search </button>
        </div>
        @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif

        @if (request('author'))
        <input type="hidden" name="author" value="{{ request('author') }}">
        @endif


      </form>
    </div>
  </div>
<span>Popular Search</span>
<div class="d-flex gap-3 mt-2 bg-muted">
    @foreach ($searches as $search)
        <a href="/posts?search={{ $search->keyword }}" class="btn btn-secondary border-0">{{ $search->keyword }}</a>
    @endforeach
</div>


<!-- Top News Start-->
<div class="top-news">
    
    <h1>Head Line</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-6 tn-left">
                <div class="row tn-slider">
                    @foreach ($posts->take(4) as $post)   
                    <div class="col-md-6">
                        <div class="tn-img">
                            @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->category_name }}" class="img-fluid">
                            @else
                            <img src="https://source.unsplash.com/500x400?{{ $post->category->category_name }}" class="card-img-top" alt="{{ $post->category->category_name }}">
                            @endif
                            <div class="tn-title title">
                                <a href="/posts/{{ $post->slug }}"><h3>{{ $post->title }}</h3></a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="col-md-6 tn-right">
                <div class="row">
                    @foreach ($posts->skip(4)->take(4) as $post)
                    <div class="col-md-6">
                        <div class="tn-img">
                            @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->category_name }}" class="img-fluid">
                            @else
                            <img src="https://source.unsplash.com/500x400?{{ $post->category->category_name }}" class="card-img-top" alt="{{ $post->category->category_name }}">
                            @endif
                            <div class="tn-title">
                                <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top News End-->
  

<div class="container mt-5">
    <div class="row">
            @foreach ($posts->skip(8)->take(6) as $post)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute  px-3 py-2 " style="background-color: rgba(0, 0, 0, 0.7)"><a href="/posts?category={{ $post->category->category_name }}" class="text-white text-decoration-none">{{ $post->category->category_name }}</a></div>
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->category_name }}" class="img-fluid">
                    @else
                      <img src="https://source.unsplash.com/500x400?{{ $post->category->category_name }}" class="card-img-top" alt="{{ $post->category->name }}">
                    @endif
                    <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p>
                        <small class="text-muted">
                        By. <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> {{ $post->created_at->diffForHumans() }}
                        </small>
                </p>
                    <p class="card-text">{{ $post->excerpt }}</p>
                    <a href="/posts/{{ $post->slug }}@if(request('author'))?author={{ request('author') }} @elseif(request('category'))?category={{ request('category') }} @endif" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    <div class="col-lg-12 mb-5">
        <div class="mn-list">
            <h2>Read More</h2>
            <div class="d-flex flex-column">
                @foreach ($posts->skip(14)->take(6) as $post)
            <a href="/posts/{{ $post->slug }}"><i class='bx bx-arrow-to-right'></i>  {{ $post->title }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection