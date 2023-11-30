@extends('layouts.main')
@section('content')
@section('title', 'Search room')
<h3 class="mb-2 fw-bold">Search room</h3>
<form action="/rooms/search/result" method="post">
    @csrf
    <label class="form-label" for="phoneNumberInput">Phone number:</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control phone-input" id="phoneNumberInput"
            placeholder="Enter phone number to check" name="phone_number">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>
@endsection
