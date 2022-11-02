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
        <span class="text-muted fw-light">{{ __('Promotions') }} /</span> {{ __('All') }}
    </h4>

    <div class="card">
        <div class="">
            <h5 class="card-header float-start">{{ __('Promotions') }}</h5>
            <a href="{{ route('promotions.create') }}"
                class="btn btn-primary m-3 text-white float-end">{{ __('Add') }}</a>
        </div>


        <div class="table-responsive text-nowrap">
            <table class="table tablenewdesign DataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('URL') }}</th>
                        <th>{{ __('Clicks') }}</th>
                        <th>{{ __('Views') }}</th>
                        <th>{{ __('Start Date') }}</th>
                        <th>{{ __('Expiry Date') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php($i = 0)
                    @foreach ($promotions as $row)
                        @php($i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <img src="images/{{ $row->image }}" class="img-thumbnail img-responsive">
                            </td>
                            <td>{{ Str::substr($row->name, 0, 25) }}...</td>
                            <td>{{ Str::substr($row->url, 0, 25) }}...</td>
                            <td>{{ $row->clicks }}</td>
                            <td>{{ $row->views }}</td>
                            <td>{{ $row->start_date }}</td>
                            <td>{{ $row->exp_date }}</td>
                            <td>
                                <form action="{{ route('promotions.destroy', $row->id) }}" method="Post">
                                    <a href="{{ route('promotions.edit', $row->id) }}" class="text-light">
                                        <i class='bx bx-edit'></i>
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
