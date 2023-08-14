@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Post Categories</h1>
</div>
<div class="col-lg-6 d-flex justify-content-between my-2">
    <a href="/dashboard/categories/create" class="btn btn-primary mb-3">Create new category</a>
    <div class="col-lg-3 d-flex justify-content-end">
        <a href="" class="btn btn-secondary mb-3 py-2">All Categories <span class="bg-info rounded-pill px-1">{{ $categories->total() }}</span></a>
    </div>
</div>
<div class="table-responsive col-lg-6">
    @if(session()->has('success'))
    <div class="alert alert-success col-lg-6 d-flex justify-content-between align-items-center" id="success">{{ session('success') }} <span class="btn border-0" id="btnClose">X</span></div>
    @endif
@if($categories->count())
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Category Name</th>
            <th scope="col">Action</th>
        </tr>
        </thead>


        <tbody>
        @foreach ($categories as $category)
            @if($category->category_name == '')
            @else     
            <tr>
                <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                <td>{{ $category->category_name }}</td>
                <td>
                <a href="/dashboard/categories/{{ $category->id }}" class="badge bg-info" title="Show"><i class='bx bx-show'></i></a>
                <a href="/dashboard/categories/{{ $category->id }}/edit" class="badge bg-warning" title="Update"><i class='bx bx-edit'></i></a>
                <form action="/dashboard/categories/{{ $category->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" title="Delete" onclick="return confirm('Are you sure?')"><i class='bx bx-x-circle'></i></button>
                </form>
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{ $categories->links() }}
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