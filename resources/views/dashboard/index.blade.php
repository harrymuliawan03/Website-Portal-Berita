@extends('dashboard.layouts.main')

@section('container')
<div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            @if($user->image)
            <img src="{{ asset('storage/' . $user->image) }}" class="rounded-circle img-fluid" style="width: 130px; height: 160px;">
            @else
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
            @endif
            <h5 class="my-3">{{ $user->username }}</h5>
            <p class="text-muted mb-1">{{ $user->job }}</p>
            <p class="text-muted mb-4">{{ $user->address }}</p>
            <div class="d-flex justify-content-center mb-2">
              <a href="/user/{{ $user->id }}/edit" class="btn btn-primary border-0" title="Update">Edit Profile</a>
            </div>
          </div>
        </div>

        {{-- Alert success edit profile --}}
        @if(session()->has('success'))
        <div class="alert alert-success col-lg-12 d-flex justify-content-between align-items-center" id="success">{{ session('success') }} <span class="btn border-0" id="btnClose">X</span></div>
        @endif
        {{-- End alert success edit profile --}}

      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->name }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->email }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->phone }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->address }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                    <p class="mb-4"><span class="text-primary font-italic me-1">Uploaded</span> Blog News
                    </p>
                    @foreach ($categories as $category)
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">{{ $category->category_name }}</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">
                              @php $count = 0; @endphp
                              @foreach ($posts as $post)
                                @php
                                        if($post->category->category_name == $category->category_name) {
                                          $count += 1;
                                        }
                                @endphp
                              @endforeach
                                <span class="btn btn-success mx-3">{{ $count }}</span> Post
                            </p>
                        </div>
                    </div>
                    <hr>
                    @endforeach
            </div>
            <div class="d-flex justify-content-end">
              {{ $categories->links() }}
          </div>
          </div>
      </div>
    </div>
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