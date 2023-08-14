@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Category</h1>
</div>

<div class="col-lg-12">
    <form method="post" action="/dashboard/categories">
        @csrf
        <div class="table-responsive">
            <table class="table table-hover table-white">
                <thead>
                    <tr>
                        <th style="width: 20px">No</th>
                        <th class="col-md-6">Category</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <input type="text" class="form-control category_name @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ $category }}" readonly>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="table-responsive col-lg-8 mx-5 my-5">
            <h3>Detail Category</h3>
            <table class="table table-hover table-white" id="tableEstimate">
                <thead>
                    <tr>
                        <th style="width: 20px">No</th>
                        <th class="col-md-6">Category Name</th>
                        <th class="col-md-6">Slug (Automatic Fill)</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($category_details as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <input type="hidden" name="item[]" value="1">
                            <input type="text" class="form-control category_name" id="category" name="name[]" required autofocus value="{{ $item->category_detail_name }}" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control auto_slug" id="slug" name="slug[]" value="{{ $item->slug }}" readonly>
                        </td>
                        {{-- <td><a href="javascript:void(0)" class="text-success font-18" title="Add" id="addBtn"><i class='bx bx-plus-medical' ></i></a></td> --}}
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="/dashboard/categories" class="btn btn-danger mb-3">Cancel</a>
        </div>
        {{-- {{-- <button type="submit" class="btn btn-primary mb-3">Create Category</button> --}}
    </form>

</div>
@endsection