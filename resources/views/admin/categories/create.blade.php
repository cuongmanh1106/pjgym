@extends('admin.include.layout')
@section('title','List of Categories')
@section('content')

@include('admin.categories.modal-insert')

<Button data-toggle="modal" data-target="#myModal">Insert</Button>


              
<script> CKEDITOR.replace( 'editor1', {
        filebrowserBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    } ); </script>
@endsection