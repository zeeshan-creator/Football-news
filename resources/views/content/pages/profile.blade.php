@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Profile /</span> Profile
</h4>
<div id="user-profile">
    <!-- profile header -->
    <div class="row">
        <div class="col-12">
            <div class="card profile-header mb-2">
                <!-- profile cover photo -->
                <img class="card-img-top" src="{{asset('assets/img/elements/profileback.jpg')}}" alt="User Profile Image">
                <!--/ profile cover photo -->

                <div class="position-relative">
                    <!-- profile picture -->
                    <div class="profile-img-container d-flex align-items-center">
                        <div class="profile-img">
                            <img src="{{asset('assets/img/elements/profile.jpg')}}" class="rounded img-fluid" alt="Card image">
                        </div>
                        <!-- profile title -->
                        <div class="profile-title ms-3">
                            <h2 class="text-white">Kitty Allanson</h2>
                            <p class="text-white">UI/UX Designer</p>
                        </div>
                    </div>
                </div>

                <!-- tabs pill -->
                <div class="profile-header-nav">
                    <!-- navbar -->
                    <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                        <button class="btn btn-icon navbar-toggler waves-effect waves-float waves-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-justify font-medium-5"><line x1="21" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="21" y1="18" x2="3" y2="18"></line></svg>
                        </button>

                        <!-- collapse  -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
                                <ul class="nav nav-pills mb-0">
                                </ul>
                                <!-- edit button -->
                                <a href="/pages/account-settings-account" class="btn btn-primary waves-effect waves-float waves-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit d-block d-md-none"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    <span class="fw-bold d-none d-md-block">Edit</span>
                                </a>
                            </div>
                        </div>
                        <!--/ collapse  -->
                    </nav>
                    <!--/ navbar -->
                </div>
            </div>
        </div>
    </div>
    <!--/ profile header -->

    <!-- profile info section -->
    <section id="profile-info">
        <div class="row">
            <!-- left profile info section -->
            <div class="col-lg-12 col-12 order-2 order-lg-1">
                <!-- about -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-75">About</h5>
                        <p class="card-text">
                           Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita voluptates, iste dignissimos cumque itaque amet, sapiente ea dolores doloremque ipsa, consequuntur placeat tenetur aut officiis est. Eveniet inventore voluptate laboriosam.
                        </p>
                        <div class="mt-2">
                            <h5 class="mb-75">Joined:</h5>
                            <p class="card-text">November 15, 2015</p>
                        </div>
                        <div class="mt-2">
                            <h5 class="mb-75">Lives:</h5>
                            <p class="card-text">New York, USA</p>
                        </div>
                        <div class="mt-2">
                            <h5 class="mb-75">Email:</h5>
                            <p class="card-text">bucketful@fiendhead.org</p>
                        </div>
                        <div class="mt-2">
                            <h5 class="mb-50">Website:</h5>
                            <p class="card-text mb-0">www.demo.com</p>
                        </div>
                    </div>
                </div>
                <!--/ about -->

                <!-- twitter feed card -->
            </div>
            <!--/ left profile info section -->

            <!-- center profile info section -->

            <!-- right profile info section -->

                </div>
    </section>
    <!--/ profile info section -->
</div>
@endsection