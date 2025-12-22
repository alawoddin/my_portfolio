{{-- resources/views/admin/homes/edit.blade.php --}}
@extends('admin.admin_master')
@section('admin')

<div class="card my-3">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Edit work</h5>
    <a href="{{ route('all.work') }}" class="btn btn-sm btn-secondary">Back</a>
  </div>

  <div class="card-body">
    <form action="{{ route('update.work') }}" method="POST" enctype="multipart/form-data" class="row g-3">
      @csrf

      <input type="hidden" name="id" value="{{$work->id}}">

      <div class="col-md-6">
        <label for="home_title" class="form-label">Link</label>
        <input type="text" id="link" name="link" class="form-control"
               value="{{$work->link}}" required>
      </div>



      <div class="col-md-6">
        <label for="home_photo" class="form-label">Photo (upload to replace)</label>
        <input type="file" id="image" name="image" value="{{$work->image}}" class="form-control" accept="image/*">
      </div>

    <img id="home_photo_preview"
     src="{{ $work->image ? asset($work->image) : asset('upload/no_image.jpg') }}"
     alt="current image"
     class="rounded border"
     style="max-height:180px; width:auto;">

      <div class="col-md-6">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>



@endsection
