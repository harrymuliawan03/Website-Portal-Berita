@extends('dashboard.layouts.main')

@section('container')
<div class="container py-5">
  <div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
  </div>
    <h1>
        Traffic Views Post By {{ auth()->user()->name }}
    </h1>
    <div class="row">
      <div class="col">
          <form action="/dashboard/traffic">
            <div class="d-flex my-3 gap-2">
              <div class="col-lg-3">
                <select name="category" id="category" class="form-select">
                    @if(!$categoryOld)
                    <option>Pilih Category</option>
                    @endif
                    @foreach ($categories as $category)
                    <option value="{{ $category }}" {{  $categoryOld == $category ? "selected":"" }}>{{ $category }}</option>
                    @endforeach
                </select>
              </div>
  
              <div class="col-lg-3">
                <select name="year" id="year" class="form-select">
                    @if(!$yearOld)
                    <option>Pilih Tahun</option>
                    @endif
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary border-0">Submit</button>
            </div>
          </form>
        <div class="card">
          <div class="card-body">
            {!! $dataTraffic->container() !!}
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="{{ $dataTraffic->cdn() }}"></script>
{{ $dataTraffic->script() }}
@endsection