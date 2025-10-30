@extends('admin.admin_master')
@section('admin')

@include('components.form', [
  'title'  => 'Add New home',
  'action' => route('store.about'),
  'fields' => [
      ['label' => 'title',  'name' => 'title',  'type' => 'text',  'required' => true, 'half' => true],
      ['label' => 'information', 'name' => 'information', 'type' => 'textarea',
       'required' => true, 'half' => true, 'rows' => 4, 'maxlength' => 500, 'show_counter' => true],


      // Image field (with preview)
      [
        'label' => 'Image',
        'name'  => 'image',
        'type'  => 'file',
        'accept'=> 'image/*',
        'preview' => true,         
        'preview_width' => 96,      
        'preview_height'=> 96,      
        'preview_circle'=> true,    
        'half' => true
      ],
  ],
  'button' => 'Save Customer',
])

@endsection
