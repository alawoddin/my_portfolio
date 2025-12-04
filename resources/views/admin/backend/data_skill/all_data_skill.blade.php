@extends('admin.admin_master')
@section('admin')

<h2>All About</h2>

@include('components.datatable', [
  'title'       => 'Skill List',
  'button'      => 'Add Data Skill',
  'buttonRoute' => 'add.data.skill', 
  'tableId'     => 'skillTable',
  'data'        => $dataskill,
  'columns'     => ['icon','title','value'],
  'routeName'   => 'data',
  'showActions' => true,
])
@endsection
