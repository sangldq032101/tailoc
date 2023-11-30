@extends('layouts.main')
@section('content')
@section('title', $heading)
<h3 class="mb-2 fw-bold">{{ $heading }} ({{ $count }})</h3>
<div class="container">
    @auth
        <div class="d-flex justify-content-center">
            <div class="btn-group mb-3" role="group" aria-label="Room state" id="roomState">
                <a type="button" class="btn btn-warning" href="/rooms/all">All rooms ({{ $countAll }})</a>
                <a type="button" class="btn btn-danger" href="/rooms/rented">Rented rooms
                    ({{ $countRented }})
                </a>
                <a type="button" class="btn btn-success" href="/rooms/available">Available rooms
                    ({{ $countAvailable }})</a>
            </div>
        </div>
    @endauth
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
                <div class="mb-3">
                    @if ($room->state == 'rented')
                        Rented at:
                        <b>{{ $room->updated_at }}</b>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <div class="btn-group" role="group" aria-label="Modify button">
                        @if ($room->state == 'available')
                            <a type="button" href="/rooms/modify/rent/{{ $room->roomID }}"
                                class="btn btn-success">Rent</a>
                        @elseif ($room->state == 'rented')
                            <button class="btn btn-danger disabled">Rented</button>
                        @else
                            <button class="btn btn-warning disabled">Pending</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="h4 text-center">No result, please try again !</div>
@endif
<div class="mt-3 d-flex justify-content-center" id="pagination">
    {{ $rooms->links() }}
</div>
@section('js')
    <script script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure ?',
                text: 'Are you sure to rent this room ?',
                icon: 'question',
                showCancelButton: true,
                scrollbarPadding: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
@endsection
