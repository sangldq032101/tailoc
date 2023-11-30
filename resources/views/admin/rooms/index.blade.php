@extends('layouts.main')
@section('content')
@section('title', 'Manage room')
<h3 class="text-center mb-3 fw-bold">Manage rooms</h3>
<div class="d-flex justify-content-center mb-3">
    <a href="/rooms/modify/add" class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>Add</a>
</div>
<div class="table-responsive">
    <table class="table table-hover w-100" id="roomTable">
        <thead class="table-dark">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Floor</th>
                <th scope="col">Room number</th>
                <th scope="col">Price</th>
                <th scope="col">Room image</th>
                <th scope="col">State</th>
                <th scope="col">Addition note</th>
                <th scope="col">View</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $room->roomFloor }}</td>
                    <td>{{ $room->roomNo }}</td>
                    <td>
                        {{ $room->roomPrice }} VND
                    </td>
                    <td class="text-center">
                        <div id="image-container">
                            <img class="lazyload" data-src="/assets/img/rooms/{{ $room->roomImg }}"
                                alt="Room {{ $room->roomNo }} image" fetchpriority="high">
                        </div>
                    </td>
                    <td>
                        @if ($room->state == 'rented')
                            <span class="text-danger">Rented</span>
                        @elseif ($room->state == 'available')
                            <span class="text-success">Available</span>
                        @else
                            <span class="text-primary">Pending</span>
                        @endif
                    </td>
                    <td>
                        @if ($room->state == 'rented')
                            <span>Rented at <b>{{ $room->updated_at }}</b></span>
                        @else
                        @endif
                    </td>
                    <td>
                        <a href="/rooms/view/{{ $room->roomID }}" class="btn btn-success"><i
                                class="fa-solid fa-eye me-2"></i>View</a>
                    </td>
                    <td><a href="/rooms/modify/edit/{{ $room->roomID }}" class="btn btn-warning"><i
                                class="fa-solid fa-pen-to-square me-2"></i>Edit</a></td>
                    <td>
                        <form method="POST" action="/rooms/modify/delete/{{ $room->roomID }}">
                            @csrf
                            @method('delete')
                            @if ($room->state == 'available')
                                <button type="button" class="btn btn-danger disabled"><i
                                        class="fa-solid fa-trash me-2"></i>Delete</button>
                            @else
                                <button type="submit" class="btn btn-danger show_delete" data-toggle="tooltip"><i
                                        class="fa-solid fa-trash me-2"></i>Delete</button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@section('js')
    <script script type="text/javascript">
        $('.show_delete').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure ?',
                text: 'Are you sure to delete this room ?',
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
    <script>
        $(function() {
            $('#roomTable').DataTable({
                dom: "<'row my-2'<'col-sm-12 col-md-6 mb-2'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row my-2'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
                "responsive": true,
                "lengthChange": true,
            });
        });
    </script>
@endsection
@endsection
