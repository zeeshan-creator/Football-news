@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ __('Promotions') }} /</span> {{ __('Create') }}
    </h4>

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

            <div class="card mb-4">
                <!-- Create User -->


                <hr class="my-0">
                <div class="card-body">
                    <form method="POST" action="/promotions" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input class="form-control @error('name')  is-invalid @enderror" type="text"
                                    id="name" name="name" placeholder="{{ __('Name') }}"
                                    value="{{ old('name') }}" autofocus />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="url" class="form-label">{{ __('url') }}</label>
                                <input class="form-control  @error('url')  is-invalid @enderror" type="text"
                                    id="url" name="url" placeholder="url" value="{{ old('url') }}" />
                                @error('url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                                <input
                                    class="form-control disable-previousDates  @error('start_date')  is-invalid @enderror"
                                    type="date" id="start_date" name="start_date" placeholder="start_date"
                                    value="{{ old('start_date') }}" />
                                @error('start_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="exp_date" class="form-label">{{ __('Expiry Date') }}</label>
                                <input class="form-control disable-previousDates  @error('exp_date')  is-invalid @enderror"
                                    type="date" id="exp_date" name="exp_date" placeholder="exp_date"
                                    value="{{ old('exp_date') }}" />
                                @error('exp_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>



                            <div class="mb-3 col-md-12">
                                <label for="image" class="form-label">{{ __('Image') }}</label>
                                <input class="form-control dropify @error('image')  is-invalid @enderror" type="file"
                                    name="image" id="image" placeholder="Image" value="{{ old('image') }}" />
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>



                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">{{ __('Add') }}</button>
                        </div>
                    </form>
                </div>
                <!-- /create user -->
            </div>
        </div>
    </div>
@endsection
