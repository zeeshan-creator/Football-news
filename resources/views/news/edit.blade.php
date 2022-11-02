@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ __('News') }} /</span> {{ __('Edit') }}
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

                <!-- news Edit -->

                <hr class="my-0">
                <div class="card-body">
                    <form method="POST" action="{{ route('news.update', $news->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="title" class="form-label">{{ __('Title') }}</label>
                                <input class="form-control @error('title')  is-invalid @enderror" type="text"
                                    id="title" name="title" placeholder="Title" value="{{ $news->title }}"
                                    autofocus />
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3
                                col-md-6">
                                <label for="date" class="form-label">{{ __('Date') }}</label>
                                <input class="form-control @error('date')  is-invalid @enderror" type="date"
                                    name="date" id="date" placeholder="date" value="{{ $news->date }}" />
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3
                                col-md-6">
                                <label for="views" class="form-label">{{ __('Views') }}</label>
                                <input class="form-control @error('views')  is-invalid @enderror" type="number"
                                    name="views" id="views" placeholder="views" value="{{ $news->views }}" />
                                @error('views')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3
                                col-md-6">
                                <label for="likes" class="form-label">{{ __('Likes') }}</label>
                                <input class="form-control @error('likes')  is-invalid @enderror" type="number"
                                    name="likes" id="likes" placeholder="likes" value="{{ $news->likes }}" />
                                @error('likes')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea id="summernote" name="description">{{ $news->description }}</textarea>
                                @error('description')
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
                <!-- /news Edit -->
            </div>
        </div>
    </div>
@endsection
