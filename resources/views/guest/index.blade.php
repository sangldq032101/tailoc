@extends('layouts.main')
@section('content')
@section('title', __('Home'))
<div class="d-flex align-items-center mb-3">
    <div class="me-auto">
        <h3 class="mb-0 fw-bold">Available rooms ({{ $countAvailable }})</span></h3>
    </div>
    <div>
        <a type="button" class="btn btn-success" href="/rooms/available">View more <i
                class="fa-solid fa-chevron-right"></i></a>
    </div>
</div>

@if ($rooms->isNotEmpty())
    <div class="room-grid text-center">
        @foreach ($rooms as $room)
            <div class="position-relative">
                <a href="/rooms/view/{{ $room->roomID }}">
                    <div id="image-gallery" class="mb-2">
                        <img data-src="/assets/img/rooms/{{ $room->roomImg }}" class="lazyload img-fluid"
                            alt="Room image" fetchpriority="high">
                    </div>
                    <h5 class="card-title">Room number: <b>{{ $room->roomNo }}</b></h5>
                </a>
                <div>Floor: <b>{{ $room->roomFloor }}</b></div>
                <div>Price: <b>
                        {{ $room->roomPrice }}
                    </b> VND</div>
                <div class="d-flex justify-content-center mt-2">
                    <div class="btn-group" role="group" aria-label="Modify button">
                        <a type="button" href="/rooms/modify/rent/{{ $room->roomID }}" class="btn btn-success">Rent</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="h4 text-center">No result, please try again !</div>
@endif
@section('js')
    @if (session('notify') == 'Logout success')
        <script>
            Swal.fire({
                title: 'Logout success',
                icon: 'success',
                timer: 2000,
                scrollbarPadding: false,
                showConfirmButton: false,
                allowOutsideClick: false,
            })
        </script>
    @endif
@endsection
@endsection
