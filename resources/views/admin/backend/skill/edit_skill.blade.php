{{-- resources/views/admin/homes/edit.blade.php --}}
@extends('admin.admin_master')
@section('admin')

<div class="card my-3">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Edit Home</h5>
    <a href="{{ route('all.skill') }}" class="btn btn-sm btn-secondary">Back</a>
  </div>

  <div class="card-body">
    <form action="{{ route('update.skill') }}" method="POST" enctype="multipart/form-data" class="row g-3">
      @csrf

      <input type="hidden" name="id" value="{{$editskill->id}}">

      <div class="col-md-6">
        <label for="home_title" class="form-label">Title</label>
        <input type="text" id="home_title" name="title" class="form-control"
               value="{{ old('title', $editskill->title) }}" required>
      </div>

    <div class="col-md-6">
    <label for="home_button" class="form-label">Button</label>
    <textarea id="home_button" name="description" class="form-control" rows="4" required>{{ old('description', $editskill->description) }}</textarea>
</div>

      <div class="col-md-6">
        <label for="home_photo" class="form-label">Photo (upload to replace)</label>
        <input type="file" id="home_photo" name="photo" class="form-control" accept="image/*">
      </div>

      <div class="col-md-6">
        <label class="form-label d-block">Current / Preview</label>
        <img id="home_photo_preview"
             src="{{ $editskill->photo_url ?? (isset($editskill->photo) ? $editskill->photo : url('upload/no_image.jpg')) }}"
             alt="current image"
             class="rounded border"
             style="max-height:180px; width:auto;">
        <button type="button" id="home_photo_clear" class="btn btn-sm btn-outline-secondary ms-2 d-none">Remove</button>
      </div>

      <div class="col-md-6">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>



@endsection
