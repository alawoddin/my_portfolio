@extends('admin.admin_master')
@section('admin')

@include('components.form', [
  'title'  => 'Add data skill',
  'action' => route('store.data.skill'),
  'fields' => [
      ['label' => 'icon',  'name' => 'icon',  'type' => 'text',  'required' => true, 'half' => true],
      ['label' => 'title',  'name' => 'title',  'type' => 'text',  'required' => true, 'half' => true],
      ['label' => 'value',  'name' => 'value',  'type' => 'text',  'required' => true, 'half' => true],
      

  ],
  'button' => 'Save Data Skill',
])

@endsection
