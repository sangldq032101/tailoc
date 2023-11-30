@extends('layouts.main')
@section('content')
@section('title', 'View profile')
<div class="d-flex justify-content-center">
    <div class="card shadow">
        <div class="card-header">
            <h3 class="fw-bold text-center mb-0">View profile</h3>
        </div>
        <div class="card-body">
            <div class="text-center">
                <div id="lightGallery">
                    <div id="image-container" class="mb-2">
                        <img data-src="/assets/img/avatar/{{ Auth::user()->avatar }}" class="lazyload rounded-circle"
                            alt="Avatar" id="img-gallery" fetchpriority="high">
                    </div>
                </div>
                <div class="card-text">Username: <b>{{ Auth::user()->username }}</b></div>
                <div class="card-text">Fullname: <b>{{ Auth::user()->fullname }}</b></div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="/user/edit/{{ Auth::user()->userID }}" class="btn btn-warning mt-3"><i
                        class="fa-solid fa-user-pen me-2"></i>Edit profile</a>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script>
        lightGallery(document.getElementById('lightGallery'), {
            plugins: [lgZoom, lgRotate, lgFullscreen],
            selector: '#img-gallery',
            speed: 500,
            hideScrollbar: true,
            licenseKey: "1234-1234-123-1234"
        });
    </script>
@endsection
@endsection
