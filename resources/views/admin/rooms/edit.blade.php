@extends('layouts.main')
@section('content')
@section('title', 'Edit room')
<a href="/admin/manage/rooms" type="button" class="btn btn-dark mb-3"><i class="fa-solid fa-chevron-left me-2"></i>Back</a>
<h3 class="text-center fw-bold">Edit room</h3>
<form method="POST" action="/rooms/modify/edit/{{ $room->roomID }}" enctype="multipart/form-data">
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
        <input type="text" class="form-control" id="floatingInput" placeholder="Room number" name="roomNo"
            value="{{ $room->roomNo }}" pattern="[0-9]+">
        <label for="floatingInput">Room number</label>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Room image</label>
        <input class="form-control" type="file" id="formFile" name="roomImg" accept=".png, .jpg, .jpeg, .webp">
    </div>
    <div class="mb-3">
        <div class="mb-2">Room floor</div>
        <select class="form-select" aria-label="Floor" name="roomFloor">
            <option value="1" @if ($room->roomFloor == 1) selected @endif>1</option>
            <option value="2" @if ($room->roomFloor == 2) selected @endif>2</option>
        </select>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control number-input" id="floatingPrice" placeholder="Price" name="roomPrice"
            value="{{ $room->roomPrice }}">
        <label for="floatingPrice">Price</label>
    </div>
    <div class="mb-3">
        <label for="roomDescriptionFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control ckeditor" id="roomDescriptionFormControlTextarea1" rows="3" name="roomDescription">{{ $room->roomDescription }}</textarea>
    </div>
    <button type="submit" class="btn btn-success d-block mx-auto edit_confirm" data-toggle="tooltip">Save
        change</button>
</form>
@section('js')
    <script script type="text/javascript">
        $('.edit_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure ?',
                text: 'Are you sure to update this room ?',
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
        ClassicEditor
            .create(document.querySelector('.ckeditor'), {
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        }
                    ]
                }
            })
    </script>
@endsection
<style>
    .ck-editor__editable_inline {
        min-height: 256px;
    }
</style>
@endsection
