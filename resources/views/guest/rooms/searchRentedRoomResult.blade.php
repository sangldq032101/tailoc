@extends('layouts.main')
@section('content')
@section('title', 'Search room')
<h3 class="mb-2 fw-bold">Search room</h3>
<form action="/rooms/search/result" method="post">
    @csrf
    <label class="form-label" for="phoneNumberInput">Phone number:</label>
    <div class="input-group mb-3">
        <input type="text" id="phoneNumberInput" class="form-control phone-input"
            placeholder="Enter phone number to check" name="phone_number" value="{{ $phone_number }}">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>
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
            </div>
        @endforeach
    </div>
@else
    <div class="h4 text-center">No result, please try again !</div>
@endif
@endsection
