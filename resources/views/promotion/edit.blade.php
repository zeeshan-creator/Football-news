@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ __('Promotions') }} /</span> {{ __('Edit') }}
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

                <!-- promotion Edit -->

                <hr class="my-0">
                <div class="card-body">
                    <form method="POST" action="{{ route('promotions.update', $promotion->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input class="form-control @error('name')  is-invalid @enderror" type="text"
                                    id="name" name="name" placeholder="name" value="{{ $promotion->name }}"
                                    autofocus />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="url" class="form-label">{{ __('URL') }}</label>
                                <input class="form-control @error('url')  is-invalid @enderror" type="text"
                                    id="url" name="url" placeholder="url" value="{{ $promotion->url }}"
                                    autofocus />
                                @error('url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="clicks" class="form-label">{{ __('Clicks') }}</label>
                                <input class="form-control @error('clicks')  is-invalid @enderror" type="number"
                                    id="clicks" name="clicks" placeholder="clicks" value="{{ $promotion->clicks }}"
                                    autofocus />
                                @error('clicks')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="views" class="form-label">{{ __('Views') }}</label>
                                <input class="form-control @error('views')  is-invalid @enderror" type="number"
                                    id="views" name="views" placeholder="views" value="{{ $promotion->views }}"
                                    autofocus />
                                @error('views')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                                <input class="form-control @error('start_date')  is-invalid @enderror" type="date"
                                    id="start_date" name="start_date" placeholder="start_date"
                                    value="{{ $promotion->start_date }}" autofocus />
                                @error('start_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="exp_date" class="form-label">{{ __('Expiry Date') }}</label>
                                <input class="form-control @error('exp_date')  is-invalid @enderror" type="date"
                                    id="exp_date" name="exp_date" placeholder="exp_date"
                                    value="{{ $promotion->exp_date }}" autofocus />
                                @error('exp_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3
                                col-md-12">
                                <label for="image" class="form-label">{{ __('Image') }}</label>
                                <div class="custom-dropify">
                                    <input type="hidden" id="oldImage" name="oldImage" value="{{ $promotion->image }}">
                                    <input class="form-control dropify  @error('image')  is-invalid @enderror"
                                        type="file"name="image" id="image" placeholder="Image" />
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">{{ __('Save changes') }}</button>
                        </div>
                    </form>
                </div>
                <!-- /promotion Edit -->
            </div>
        </div>
    </div>
@endsection
