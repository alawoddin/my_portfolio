@extends('admin.admin_master')
@section('admin')

@include('components.form', [
  'title'  => 'Add New Work',
  'action' => route('store.work'),
  'fields' => [
      ['label' => 'link',  'name' => 'link',  'type' => 'text',  'required' => true, 'half' => true],

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
