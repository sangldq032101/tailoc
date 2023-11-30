@extends('layouts.main')
@section('content')
@section('title', 'View rooms')
<a href="/rooms/all" type="button" class="btn btn-dark mb-3"><i class="fa-solid fa-chevron-left me-2"></i>Back</a>
<div class="row row-cols-1 row-cols-lg-2 g-3">
    <div class="col text-center" id="lightGallery">
        <img src="/assets/img/rooms/{{ $room->roomImg }}" class="img-fluid" id="img-gallery" alt="Room image"
            title="Click to view image" fetchpriority="high">
    </div>
    <div class="col text-center text-lg-start">
        <h5>Room number: <b>{{ $room->roomNo }}</b></h5>
        <div>Floor: <b>{{ $room->roomFloor }}</b></div>
        <div class="mb-3">Price: <b>
                {{ $room->roomPrice }}
            </b> VND</div>
        @if (!empty($room->roomDescription))
            <div class="h5 fw-bold">Description:</div>
            <div class="mb-3">{!! $room->roomDescription !!}</div>
        @endif
        @if ($room->state == 'available')
            <a type="button" href="/rooms/modify/rent/{{ $room->roomID }}" class="btn btn-success">Rent</a>
        @elseif ($room->state == 'rented')
            <button class="btn btn-danger disabled">Rented</button>
            <div class="mt-3">
                @if ($room->state == 'rented')
                    Rented at:
                    <b>{{ $room->updated_at }}</b>
                @endif
            </div>
        @endif
    </div>
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
        lightGallery(document.getElementById('lightGallery'), {
            plugins: [lgZoom, lgRotate, lgFullscreen],
            selector: '#img-gallery',
            hideScrollbar: true,
            getCaptionFromTitleOrAlt: false,
            licenseKey: "1234-1234-123-1234"
        });
    </script>
@endsection
@endsection
