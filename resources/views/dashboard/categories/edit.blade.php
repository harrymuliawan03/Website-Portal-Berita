@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Category</h1>
</div>

<div class="col-lg-12">
    <form method="post" action="/dashboard/categories/{{ $category->id }}">
        @method('put')
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
                        <input type="text" class="form-control category_name @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ $category->category_name }}" >
                        @error('category')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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
                        <th class="col-md-6">Slug</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($category->category_details as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <input type="hidden" name="item[]" value="1">
                            <input type="text" class="form-control category_name" id="category_detail_name" name="category_detail_name[]" required value="{{ $item->category_detail_name }}" >
                        </td>
                        <td>
                            <input type="text" class="form-control auto_slug" id="slug" name="slug[]" value="{{ $item->slug }}" >
                        </td>
                        <td>
                            <a class="btn text-danger font-18 border-0 remove" title="Delete"><i class='bx bxs-trash' ></i></a>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        <a href="javascript:void(0)" class="text-success font-18" title="Add" id="addBtn">Add sub-categories <i class='bx bx-plus-medical' ></i></a>
            <div class="mt-5">
                <button type="submit" class="btn btn-primary mb-3">Update Category</button>
                <a href="/dashboard/categories" class="btn btn-danger mb-3">Cancel</a>
            </div>
        </div>
    </form>

</div>

    @section('script')
    <script>

                function delay(callback, ms) {
                var timer = 0;
                return function() {
                    var context = this, args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                    callback.apply(context, args);
                    }, ms || 0);
                };
                }
                // const category = document.querySelector('#category');
                // const slug = document.querySelector('#slug');

                // $('#category').keyup(delay(function (e) {
                //                     fetch('/dashboard/categories/checkSlug?category=' + category.value)
                //                     .then(response => response.json())
                //                     .then(data => slug.value = data.slug)
                //                 }, 500));
                                
                var rowIdx = 1;
                $("#addBtn").on("click", function ()
                {
                    // Adding a row inside the tbody.
                    $("#tableEstimate tbody").append(`
                    <tr id="R${++rowIdx}">
                        <td class="row-index text-center"><p></p></td>
                        <td>
                        <input type="hidden" name="item[]" value="${rowIdx}">
                        <input type="text" class="form-control category_name @error('category_detail_name') is-invalid @enderror" id="category_detail_name" name="category_detail_name[]" required autofocus value="" onkeyup="FetchSlug(this);">
                        @error('category_detail_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        </td>
                        <td>
                        <input type="text" class="form-control auto_slug @error('slug') is-invalid @enderror" id="slug" name="slug[]" value="" readonly>
                        @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        </td>
                        <td><a href="javascript:void(0)" class="text-danger font-18 remove" title="Remove"><i class='bx bxs-trash' ></i></a></td>
                    </tr>`);
                });
                $("#tableEstimate tbody").on("click", ".remove", function ()
                {
                    // Getting all the rows next to the row
                    // containing the clicked button
                    var child = $(this).closest("tr").nextAll();
                    // Iterating across all the rows
                    // obtained to change the index
                    child.each(function () {
                    // Getting <tr> id.
                    var id = $(this).attr("id");

                    // Getting the <p> inside the .row-index class.
                    var idx = $(this).children(".row-index").children("p");

                    // Gets the row number from <tr> id.
                    var dig = parseInt(id.substring(1));

                    // Modifying row index.
                    idx.html(`${dig - 1}`);

                    // Modifying row id.
                    $(this).attr("id", `R${dig - 1}`);
                });
        
                    // Removing the current row.
                    $(this).closest("tr").remove();
        
                    // Decreasing total number of rows by 1.
                    rowIdx--;
                });
                
                function FetchSlug(v) {
                    var index = $(v).parent().parent().index();

                    var category = document.getElementsByName('category_detail_name[]')[index].value;
                    setTimeout(()=> {
                        fetch('/dashboard/categories/checkSlug?category=' + category)
                        .then(response => response.json())
                        .then(data => document.getElementsByName('slug[]')[index].value = data.slug);
                    }, 300);
                }
                document.addEventListener('trix-file-accept', (e) => {
                    e.preventDefault();
                });


                // $("#tableEstimate tbody").on("keyup", ".category_name", function () {
                // var category = $(this).val();
                // console.log(category);
                // const slug = document.querySelector('#slug');
                
                // });

        

        // $('#category2').keyup(delay2(function (e) {
        //                     fetch('/dashboard/categories/checkSlug?category=' + category2.value)
        //                     .then(response => response.json())
        //                     .then(data => slug2.value = data.slug)
        //                 }, 500));


    </script>
    @endsection
@endsection