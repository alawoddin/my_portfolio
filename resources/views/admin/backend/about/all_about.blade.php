@extends('admin.admin_master')
@section('admin')

<h2>All About</h2>

@include('components.datatable', [
  'title'       => 'Home List',
  'button'      => 'Add About',
  'buttonRoute' => 'add.about', 
  'tableId'     => 'aboutTable',
  'data'        => $abouts,
  'columns'     => ['title','information_short','photo_url'],
  'routeName'   => 'about',
  'showActions' => true,
])
@endsection
