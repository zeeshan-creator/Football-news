@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')





    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ __('News') }} /</span> {{ __('Create') }}
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
                <!-- Create news -->


                <hr class="my-0">
                <div class="card-body">
                    <form method="POST" action="/news" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="title" class="form-label">{{ __('Title') }}</label>
                                <input class="form-control @error('title')  is-invalid @enderror" type="text"
                                    id="title" name="title" placeholder="{{ __('Title') }}"
                                    value="{{ old('title') }}" />
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="date" class="form-label">{{ __('Date') }}</label>
                                <input class="form-control disable-previousDates @error('date')  is-invalid @enderror"
                                    type="date" id="date" name="date" placeholder="date"
                                    value="{{ old('date') }}" />
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="mb-6 col-md-12">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <input type="hidden" name="description">
                                <textarea id="summernote" class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">{{ __('Add') }}</button>
                        </div>
                    </form>
                </div>
                <!-- /create news -->
            </div>
        </div>
    </div>
@endsection
