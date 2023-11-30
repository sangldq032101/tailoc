@extends('layouts.main')
@section('title', __('Log in'))
@section('content')
    <form method="POST" action="/login">
        @csrf
        <h3 class="fw-bold text-center mb-2">Log in</h3>
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
            <input type="text" class="form-control" id="floatingUsername" placeholder="Username" name="username">
            <label for="floatingUsername">Username</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Password</label>
        </div>
        <button class="d-block mx-auto btn btn-success" type="submit">Log in</button>
    </form>
@section('js')
    @if (Session::has('message'))
        <script>
            Swal.fire({
                title: 'You not an administrator',
                text: 'Please log in to continue !',
                icon: 'error',
                scrollbarPadding: false,
                allowOutsideClick: false,
            })
        </script>
    @endif
    @if (session('notify') == 'Login failed')
        <script>
            Swal.fire({
                title: 'Login failed',
                icon: 'error',
                scrollbarPadding: false,
                allowOutsideClick: false,
            })
        </script>
    @endif
@endsection
@endsection
