@extends('admin.admin_master')
@section('admin')

@include('components.form', [
  'title'  => 'Add New skill',
  'action' => route('store.skill'),
  'fields' => [
      ['label' => 'title',  'name' => 'title',  'type' => 'text',  'required' => true, 'half' => true],
      ['label' => 'description', 'name' => 'description', 'type' => 'textarea',
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
  'button' => 'Save skill',
])

@endsection
