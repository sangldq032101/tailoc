@extends('layouts.main')
@section('content')
@section('title', 'Add room')
<a href="/admin/manage/rooms" type="button" class="btn btn-dark mb-3"><i class="fa-solid fa-chevron-left me-2"></i>Back</a>
<h3 class="text-center fw-bold">Add room</h3>
<form method="POST" action="/rooms/modify/add" enctype="multipart/form-data">
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
            pattern="[0-9]+" required>
        <label for="floatingInput">Room number</label>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Room image</label>
        <input class="form-control" type="file" id="formFile" name="roomImg" accept=".png, .jpg, .jpeg, .webp"
            required>
    </div>
    <div class="mb-3">
        <div class="mb-2">Room floor</div>
        <select class="form-select" aria-label="Floor" name="roomFloor">
            <option value="1" selected>1</option>
            <option value="2">2</option>
        </select>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control number-input" id="floatingPrice" placeholder="Price" name="roomPrice"
            required>
        <label for="floatingPrice">Price</label>
    </div>
    <div class="mb-3">
        <label for="roomDescriptionFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control ckeditor" id="roomDescriptionFormControlTextarea1" rows="3" name="roomDescription"></textarea>
    </div>
    <button type="submit" class="btn btn-success d-block mx-auto">Add</button>
</form>
@section('js')
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
@endsection
