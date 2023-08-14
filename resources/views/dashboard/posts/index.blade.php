@extends('dashboard.layouts.main')

@section('container')


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Post, {{ auth()->user()->name }}</h1>
</div>

<div class="col-lg-8 d-flex justify-content-between my-4">
    <div class="col-lg-3">
        <a href="/dashboard/posts/create" class="btn btn-primary mb-3"><i class='bx bx-plus-circle'></i> Create new post</a>
    </div>
    <div class="col-lg-6 d-flex justify-content-end">
        <div class="col-lg-4">
            <form action="/dashboard/posts">
                <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                    @if(!$categoryOld)
                    <option>Pilih Category</option>
                    @endif
                    <option value="">All Post</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category }}" {{  $categoryOld == $category ? "selected":"" }}>{{ $category }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="col-lg-3 d-flex justify-content-end">
            <a href="" class="btn btn-secondary mb-3 py-2">All Posts <span class="bg-info rounded-pill px-1">{{ $posts->total() }}</span></a>
        </div>
    </div>
</div>
@if(session()->has('success'))
<div class="alert alert-success col-lg-3 d-flex justify-content-between align-items-center" id="success">{{ session('success') }} <span class="btn border-0" id="btnClose">X</span></div>
@endif

<div class="table-responsive col-lg-8">
@if($posts->count())
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Action</th>
        </tr>
        </thead>


        <tbody>
        @foreach ($posts as $post)     
        <tr>
            <td>{{ $loop->iteration + ($posts->currentPage() - 1) * $posts->perPage() }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->name }}</td>
            <td>
            <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info" title="Show"><i class='bx bx-show'></i></a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning" title="Update"><i class='bx bx-edit'></i></a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="badge bg-danger border-0" title="Delete" onclick="return confirm('Are you sure?')"><i class='bx bx-x-circle'></i></button>
            </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{ $posts->links() }}
    </div>
    @else
    <div class="alert alert-warning col-lg-3" role="alert">
        <i class='bx bx-info-circle'></i> No Post Found
    </div>
    @endif
</div>
    @if(session()->has('success'))
        @section('script')
        <script>
            const success = document.querySelector('#success');
            const close = document.querySelector('#btnClose');
        
            close.addEventListener('click', () => {
                success.classList.add('d-none');
            });
        </script>
        @endsection
    @endif
@endsection