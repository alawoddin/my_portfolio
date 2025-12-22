{{-- resources/views/admin/homes/index.blade.php --}}
@extends('admin.admin_master')
@section('admin')

<h2>All Homes</h2>

@include('components.datatable', [
  'title'       => 'Work List',
  'button'      => 'Add Work',
  'buttonRoute' => 'add.work', 
  'tableId'     => 'homeTable',
  'data'        => $allwork,
  'columns'     => ['image_url' , 'link'],
  'routeName'   => 'work',
  'showActions' => true,
])
@endsection
