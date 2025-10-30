{{-- resources/views/admin/homes/index.blade.php --}}
@extends('admin.admin_master')
@section('admin')

<h2>All Homes</h2>

@include('components.datatable', [
  'title'       => 'Home List',
  'button'      => 'Add Home',
  'buttonRoute' => 'add.home', 
  'tableId'     => 'homeTable',
  'data'        => $homes,
  'columns'     => ['title','button','photo_url'],
  'routeName'   => 'home',
  'showActions' => true,
])
@endsection
