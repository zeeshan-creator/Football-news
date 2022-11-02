@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')





    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ __('News') }} /</span> {{ __('Show') }}
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

                <textarea id="summernote" name="description">{{ $news->description }}</textarea>

                <hr class="my-0">

                <!-- /create news -->
            </div>
        </div>
    </div>
@endsection
