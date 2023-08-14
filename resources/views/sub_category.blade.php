@extends('layouts.main')

@section('container')
<div class="row">

    <div class="col-md-8 col-sm-12">
        <h3 style="border-bottom: 2px solid black; height: 37px;"><span style="border-bottom: 2px solid #FF6F61">Popular</span></h3>
        @foreach ($posts_sub as $item)
                <div class="row">
                        <div class="col-md-4 my-3">
                            <a href="/posts/{{ $item->slug }}" class="hover:bg-red">
                                <div class="card bg-dark text-white">
                                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img" alt="{{ $item->category->category_name }}">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-8 my-3">
                            <a href="/posts/{{ $item->slug }}" class="text-black">
                                <h3>{{ $item->title }}</h3>
                            </a>
                                <div class="d-inline-block">
                                    <a href="/sub_category/{{ $link }}">
                                        {{ $link }}
                                    </a>
                                    <span> 
                                        {{ $item->created_at->diffForHumans() }}
                                    </span>
                                </div>
                        </div>
                </div>
        @endforeach
        <div class="d-flex justify-content-end">
            {{ $posts_sub->links() }}
          </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <h3 style="border-bottom: 2px solid black; height: 37px;"><span style="border-bottom: 2px solid #FF6F61">Popular</span></h3>
        @foreach ($popular->take(4) as $item)
                <div class="my-3">
                    <a href="/posts/{{ $item->slug }}">
                        <div class="card bg-dark text-white">
                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img" alt="{{ $item->category->category_name }}">
                            <div class="row mx-2 my-3">
                                <a href="/posts/{{ $item->slug }}" class="text-light">
                                    <h4>{{ $item->title }}</h4>
                                </a>
                                <div class="block mt-1">
                                    <i class='bx bx-time' style="font-size: 13px;"></i><span style="font-size: 13px;"> {{ $item->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
        @endforeach
    </div>

</div>

@endsection