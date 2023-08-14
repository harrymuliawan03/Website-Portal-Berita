@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-3">
    <h1>Edit Profile</h1>
  	<hr>
      <div class="row">
        <form method="post" action="/user/{{ $user->id }}" enctype="multipart/form-data" class="d-flex gap-4">
          @method('put')
          @csrf
          <!-- left column -->
          <div class="col-md-3">
            <div class="mb-3">
              @if($user->image)
              <img src="{{ asset('storage/' . $user->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
              @else
              <img class="img-preview img-fluid mb-3 col-sm-5">
              @endif
              <label for="image" class="form-label">Image (max 1MB)</label>
              <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
              @error('image')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          
          <!-- edit form column -->
          <div class="col-md-9 personal-info">
            <h3>Personal info</h3>
            
              <div class="form-group mb-2">
                <label for="name" class="col-lg-3 control-label">Name:</label>
                <div class="col-lg-8">
                  <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" autofocus value="{{ old('name', $user->name) }}">
                  @error('name')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group mb-2">
                <label for="username" class="col-lg-3 control-label">Username:</label>
                <div class="col-lg-8">
                  <input class="form-control @error('username') is-invalid @enderror" type="text" id="username" name="username" value="{{ old('username', $user->username) }}">
                  @error('username')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group mb-2">
                <label for="email" class="col-lg-3 control-label">Email:</label>
                <div class="col-lg-8">
                  <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
                  @error('email')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group mb-2">
                <label for="phone" class="col-md-3 control-label">Phone:</label>
                <div class="col-md-8">
                  <input class="form-control @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                  @error('phone')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group mb-2">
                <label for="address" class="col-md-3 control-label">Address:</label>
                <div class="col-md-8">
                  <input class="form-control @error('address') is-invalid @enderror" type="textarea" id="address" name="address" value="{{ old('address', $user->address) }}">
                  @error('address')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="form-group mb-2">
                <label for="job" class="col-md-3 control-label">Job:</label>
                <div class="col-md-8">
                  <input class="form-control @error('job') is-invalid @enderror" type="text" id="job" name="job" value="{{ old('job', $user->job) }}">
                  @error('job')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
                <div class="col-md-8 mt-4">
                  <button type="submit" class="btn btn-primary mb-3">Update Profile</button>
                  <span></span>
                  <a href="/user" class="btn btn-danger mb-3">Cancel</a>
                </div>
            </div>
          </form>
      </div>
</div>
@endsection