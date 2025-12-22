@extends('admin.admin_master')
@section('admin')

<h2>All Contact</h2>

@include('components.datatable', [
  'title'       => 'Contact List',
  'button'      => 'Add contact',
  'buttonRoute' => 'add.contact', 
  'tableId'     => 'aboutTable',
  'data'        => $contacts,
  'columns'     => ['name','email','message'],
  'routeName'   => 'about',
  'showActions' => true,
])
@endsection
