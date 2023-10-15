@extends('admin.layouts.base')

@section('content')
    <div class="h-100 mt-3">
        @if (session('already_sponsored'))
            <div class="alert alert-warning fw-bold">
                {{ session('already_sponsored') }}
            </div>
        @endif
        @if (session('success'))
            @php $apartment = session('apartment') @endphp
            <div class="alert alert-success fw-bold">
                {{ session('success') }}
                {{ 'Apartment - ' . $apartment->name . ' is sponsored until - ' . $apartment->sponsorships->first()->pivot->end_date }}
            </div>
        @endif
        {{-- confirm delete --}}
        @if (session('delete_success'))
            @php $apartment = session('delete_success') @endphp
            <div class="alert alert-danger fw-bold">
                {{ session('delete_success') }}
            </div>
        @endif
        @if (session('create_success'))
            @php $apartment = session('create_success') @endphp
            <div class="alert alert-success fw-bold">
                {{ session('create_success') }}
            </div>
        @endif

        <h1 class="pb-4">MY APARTMENTS</h1>
        @if(count($apartments) == 0)
            <h2>No apartments yet...</h2>
        @endif

        @if(count($apartments) > 0)
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col" class="col text-center align-middle">Name</th>
                    <th scope="col" class="col text-center align-middle">Address</th>
                    <th scope="col" class="col text-center align-middle">Sponsor</th>
                    <th scope="col" class="col-2 text-center align-middle d-none d-xl-table-cell">Sponsored Until</th>
                    <th scope="col" class=" col-md-5 col-lg-4 text-center align-middle">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        <td class="col text-center align-middle">
                            <p class="mt-1 m-0">{{ $apartment->name }}</p>
                        </td>
                        <td class="col text-center align-middle">
                            <p class="mt-1 m-0">{{ $apartment->address->street }}
                                - {{ $apartment->address->zip }} {{ $apartment->address->city }}</p>
                        </td>
                        <td class="col text-center align-middle">
                            {!! $apartment->is_sponsored
                                ? '<i style="color: green; font-size: 25px;" class="fa-solid fa-check"></i>'
                                : '<i style="color: red; font-size: 25px;"  class="fa-solid fa-xmark"></i>' !!}
                        </td>
                        <td class="col text-center align-middle d-none d-xl-table-cell">
                            @if ($apartment->is_sponsored)
                                <div class="d-flex justify-content-center text-nowrap">
                                    <div class="ms-badge green">
                                        {{ \Carbon\Carbon::parse($apartment->sponsorships->first()->pivot->end_date)->setTimezone('Europe/Rome')->format('d-m-Y - H:i:s') }}
                                    </div>
                                </div>
                            @endif
                        </td>
                        <!--    ACTIONS    -->
                        <td class="col text-center align-middle">
                            <div class="row g-2 row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-7
                        justify-content-end justify-content-md-between justify-content-xl-around align-items-center"
                            >
                                <!--    SHOW    -->
                                <div class="col d-flex justify-content-center align-items-center">
                                    <a class="ms-action-button blue"
                                       href="{{ route('admin.apartments.show', ['apartment' => $apartment]) }}">
                                        <i class="fa-regular fa-eye"></i>
                                        <span class="d-none d-md-inline">Show</span>
                                    </a>
                                </div>
                                <!--    EDIT    -->
                                <div class="col d-flex justify-content-center align-items-center">
                                    <a class="ms-action-button blue"
                                       href="{{ route('admin.apartments.edit', ['apartment' => $apartment]) }}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        <span class="d-none d-md-inline">Edit</span>
                                    </a>
                                </div>
                                <!--    MESSAGES    -->
                                <div class="col d-flex justify-content-center align-items-center">
                                    <a class="ms-action-button blue"
                                       href="{{ route('admin.apartments.chat', ['id' => $apartment->id]) }}">
                                        <i class="fa-solid fa-envelope"></i>
                                        <span class="d-none d-md-inline">Messages</span>
                                    </a>
                                </div>
                                <!--    STATISTICS    -->
                                <div class="col d-flex justify-content-center align-items-center">
                                    <a class="ms-action-button blue"
                                       href="{{ route('admin.apartments.statistics', ['id' => $apartment->id]) }}">
                                        <i class="fa-solid fa-chart-line"></i>
                                        <span class="d-none d-md-inline">Statistics</span>
                                    </a>
                                </div>
                                <!--    SPONSOR    -->
                                <div class="col d-flex justify-content-center align-items-center">
                                    <a class="ms-action-button purple"
                                       href="{{ route('admin.apartments.sponsorship.index', ['id' => $apartment->id]) }}">
                                        <i class="fa-solid fa-medal"></i>
                                        <span class="d-none d-md-inline">Sponsor</span>
                                    </a>
                                </div>
                                <!--    DELETE    -->
                                <div class="col d-flex justify-content-center align-items-center">
                                    <div type="button" class="ms-action-button danger"
                                         data-bs-toggle="modal"
                                         data-bs-target="#deleteModal-{{ $apartment->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                        <span class="d-none d-md-inline">Remove</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal-{{ $apartment->id }}" tabindex="-1"
                         aria-labelledby="deleteModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure? It's going to be deleted permanently!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                    </button>
                                    <form action="{{ route('admin.apartments.destroy', ['apartment' => $apartment]) }}"
                                          method="post"
                                          class="d-inline-block">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">Yes, Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete Modal -->
                @endforeach
                </tbody>
            </table>
        @endif

        <div class="d-flex gap-2 pt-5 mb-4">
            <a class="btn btn-secondary" href="{{ route('admin.dashboard') }}">Back</a>
            <a class="btn myBtnPurple" style="background-color: #485ba1; color: white;"
               href="{{ route('admin.apartments.create') }}"><i class="fa-solid fa-plus"></i> Add</a>
        </div>
    </div>
@endsection
