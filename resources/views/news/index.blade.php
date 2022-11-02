@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection



@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-primary alert-dismissible dismiss-3" role="alert">
            {{ __($message) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif



    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ __('News') }} /</span> {{ __('All') }}
    </h4>

    <div class="card">
        <div class="">
            <h5 class="card-header float-start">{{ __('News') }}</h5>
            <a href="{{ route('news.create') }}" class="btn btn-primary m-3 text-white float-end">{{ __('Add') }}</a>
        </div>


        <div class="table-responsive text-nowrap">
            <table class="table tablenewdesign DataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Views') }}</th>
                        <th>{{ __('Likes') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php($i = 0)
                    @foreach ($news as $row)
                        @php($i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ Str::substr($row->title, 0, 50) }}...</td>
                            <td>{{ $row->views }}</td>
                            <td>{{ $row->likes }}</td>
                            <td>{{ $row->date }}</td>
                            <td>
                                <form action="{{ route('news.destroy', $row->id) }}" method="Post">
                                    <a href="{{ route('news.edit', $row->id) }}" class="text-light">
                                        <i class='bx bx-edit'></i>
                                    </a> &nbsp;|
                                    <a href="{{ route('news.show', $row->id) }}" class="text-light">
                                        <i class='bx bx-detail'></i>
                                    </a> &nbsp;|
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-0 bg-white text-light"><i
                                            class='bx bxs-trash'></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-4 pt-4 d-flex justify-content-end">

            </div>
        </div>
    </div>


@endsection
