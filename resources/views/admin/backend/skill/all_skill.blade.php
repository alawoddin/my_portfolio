{{-- resources/views/admin/homes/index.blade.php --}}
@extends('admin.admin_master')
@section('admin')

<h2>All Homes</h2>

@include('components.datatable', [
  'title'       => 'skill List',
  'button'      => 'Add skill',
  'buttonRoute' => 'add.skill', 
  'tableId'     => 'homeTable',
  'data'        => $skills,
  'columns'     => ['title','description','photo_url'],
  'routeName'   => 'skill',
  'showActions' => true,
])
@endsection
