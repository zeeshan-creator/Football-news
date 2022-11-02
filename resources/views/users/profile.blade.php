@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ __('Account Settings') }} /</span> {{ __('User Account') }}
    </h4>

    @if ($message = Session::get('success'))
        <div class="alert alert-primary alert-dismissible dismiss-3" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    @if ($message = Session::get('status'))
        <div class="alert alert-primary alert-dismissible dismiss-3" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif


    @if ($message = Session::get('token'))
        <div class="alert alert-info alert-dismissible" role="alert">
            Copy this token : <span id="apiToken"> {{ $message }}</span>
            <input type="button" class="btn border float-end p-0 px-3 m-0 mr-4" id="copyBtn" onclick="copyToClipboard()"
                value="Copy">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif




    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i>
                        {{ __('Account') }}</a></li>

            </ul>
            <div class="card mb-4">
                <div class="">
                    <h5 class="card-header float-start">{{ __('Profile Details') }}</h5>
                    <div class="float-end m-3">
                        <div class="button-wrapper">
                            {{-- <a href="/getNewApiToken" for="upload" class="btn btn-primary me-2" tabindex="0">
                                <span class="d-none d-sm-block">{{ __('Generate New') }} API Token</span>
                            </a> --}}
                        </div>
                    </div>
                </div>
                <!-- Account -->
                <hr class="my-0">
                <div class="card-body">
                    <div class="row">

                        <div class="mb-3 col-md-12">
                            <p class="d-inline">
                                {{ __('Email') }} : <span class="">{{ $user->email }}</span>
                                &nbsp;
                                &nbsp;
                                @if ($user->email_verified_at)
                                    ( Verified <i class="fa-solid fa-check m-2"
                                        style="font-size: 18px;color:lawngreen"></i>)
                                @else
                                    <form method="POST" class="d-inline" action="{{ route('verification.send') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary btn-sm">
                                            {{ __('Verify Email') }}
                                        </button>
                                    </form>
                                @endif

                            </p>
                        </div>
                    </div>

                    <div class="row">


                        <form action="/profile/{{ $user->id }}" id="formAccountSettings" method="POST"
                            enctype="multipart/form-data">
                            <div class="row">

                                @csrf
                                @method('PUT')
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">{{ __('First Name') }}</label>
                                    <input class="form-control" type="text" id="firstName" name="first_name"
                                        value="{{ $user->first_name }}" placeholder="{{ __('First Name') }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">{{ __('Last Name') }}</label>
                                    <input class="form-control" type="text" name="last_name" id="lastName"
                                        value="{{ $user->last_name }}" placeholder="{{ __('Last Name') }}" />
                                </div>
                            </div>
                            <div class="mt-2 float-end">
                                <button type="submit" class="btn btn-primary me-2">{{ __('Save changes') }}</button>
                            </div>
                        </form>
                    </div>

                    <br>

                    <div class="row">

                        <form action="/change-password/{{ $user->id }}" id="formAccountSettings" method="POST"
                            enctype="multipart/form-data">
                            <div class="row">

                                @csrf
                                @method('PUT')
                                <input type="hidden" name="email" value="{{ $user->email }}">

                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">{{ __('Current Password') }}</label>
                                    <input class="form-control" type="text" id="password" name="password"
                                        placeholder="{{ __('Current Password') }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="newPassword" class="form-label">{{ __('New Password') }}</label>
                                    <input class="form-control" type="text" name="newPassword" id="newPassword"
                                        placeholder="{{ __('New Password') }}" />
                                </div>
                            </div>
                            <div class="mt-2 float-end">
                                <button type="submit" class="btn btn-primary me-2">{{ __('Change Password') }}</button>
                                {{-- <span style="color: red">Currently can not update </span> --}}

                            </div>
                        </form>
                    </div>

                </div>
                <!-- /Account -->
            </div>

        </div>
    </div>

@endsection
