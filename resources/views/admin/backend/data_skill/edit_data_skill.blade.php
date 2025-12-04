{{-- resources/views/admin/homes/edit.blade.php --}}
@extends('admin.admin_master')

@section('admin')
<div class="card my-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Data Skill</h5>
        <a href="{{ route('all.data.skill') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <form action="{{ route('update.data') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf

            <input type="hidden" name="id" value="{{ $dataskill->id }}">

            {{-- Icon --}}
            <div class="col-md-6">
                <label for="skill_icon" class="form-label">Icon</label>
                <input type="text" id="skill_icon" name="icon" class="form-control"
                       value="{{ old('icon', $dataskill->icon) }}" required>
            </div>

            {{-- Title --}}
            <div class="col-md-6">
                <label for="skill_title" class="form-label">Title</label>
                <input type="text" id="skill_title" name="title" class="form-control"
                       value="{{ old('title', $dataskill->title) }}" required>
            </div>

            {{-- Value --}}
            <div class="col-md-6">
                <label for="skill_value" class="form-label">Value</label>
                <input type="number" id="skill_value" name="value" class="form-control"
                       value="{{ old('value', $dataskill->value) }}" required>
            </div>

            {{-- Submit --}}
            <div class="col-md-6 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Update</button>
            </div>

        </form>
    </div>
</div>
@endsection
