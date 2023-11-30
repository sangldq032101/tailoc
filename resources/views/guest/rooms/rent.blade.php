@extends('layouts.main')
@section('content')
@section('title', 'Rent rooms')
<a href="/rooms/all" type="button" class="btn btn-dark mb-3"><i class="fa-solid fa-chevron-left me-2"></i>Back</a>
<div class="row row-cols-1 row-cols-lg-2 g-3">
    <div class="col text-center" id="lightGallery">
        <img src="/assets/img/rooms/{{ $room->roomImg }}" class="img-fluid mb-2" id="img-gallery" alt="Room image"
            title="Click to view image" fetchpriority="high">
        <h5 class="mb-0">Room number: <b>{{ $room->roomNo }}</b></h5>
        <div>Floor: <b>{{ $room->roomFloor }}</b></div>
        <div class="mb-2">Price: <b>
                {{ $room->roomPrice }}
            </b> VND</div>
    </div>
    <div class="col text-center text-lg-start">
        <h3 class="mb-2 text-center">Rent information form</h3>
        <form method="POST" action="/rooms/modify/rent/{{ $room->roomID }}">
            @csrf
            @if (count($errors) > 0)
                <div class="d-flex justify-content-center">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $err)
                            <div><i class="fa-solid fa-triangle-exclamation me-2"></i>{{ $err }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="rentalName"
                    placeholder="Rental name">
                <label for="floatingInput">Fullname</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control phone-input" id="floatingInput" name="phoneNumber"
                    placeholder="Phone number">
                <label for="floatingInput">Phone number</label>
            </div>
            <a type="submit" class="btn btn-success show_confirm" data-toggle="tooltip">Rent</a>
        </form>
    </div>
</div>
@section('js')
    <script type="text/javascript">
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
