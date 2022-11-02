@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">News /</span> News
</h4>
<div class="row mb-5">
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100">
        <img class="card-img-top" src="{{asset('assets/img/elements/2.jpg')}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">News</h5>
          <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the card's content.
          </p>
          <a href="javascript:void(0)" class="btn btn-outline-primary">Read More</a>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100">
        <img class="card-img-top" src="{{asset('assets/img/elements/2.jpg')}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">News</h5>
          <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the card's content.
          </p>
          <a href="javascript:void(0)" class="btn btn-outline-primary">Read More</a>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
      <div class="card h-100">
        <img class="card-img-top" src="{{asset('assets/img/elements/2.jpg')}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">News</h5>
          <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the card's content.
          </p>
          <a href="javascript:void(0)" class="btn btn-outline-primary">Read More</a>
        </div>
      </div>
    </div>
  </div>
@endsection