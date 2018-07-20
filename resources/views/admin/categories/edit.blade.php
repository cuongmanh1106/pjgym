@extends('admin.include.layout')
@section('title','List of Categories')
@section('content')
@include('admin.include.report')

<div class="card">
  <div class="card-header">
  	<h5 class="card-title">Edit a Category</h5>
  
  </div>

  <div class="card-body">
    @include('admin.include.validation')
    <form id="form" method="POST" action="{{ route('admin.categories.update',$cate->id) }}">
             <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label></div>
                <div class="col-12 col-md-9"><input type="text" id="text-input" name="name" value="{{ $cate->name }}" class="form-control"></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="select" class=" form-control-label">Parent</label></div>
                <div class="col-12 col-md-9">
                  <select class="form-control" name="parent">
                      <option value="0">--Choose parent categories--</option>
                      <?php cate_parent_edit($cates,0,"--",$cate->parent_id); ?>
                	</select>
                </div>
              </div>
              
             

              <div class="row form-group">
                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Description</label></div>
                <div class="col-12 col-md-9"><textarea  name="description" id="editor1" required="required" rows="9" placeholder="Content..." class="form-control">{{ $cate->description }}</textarea>
              </div>
            </div>
            <div class="form-group " style="text-align: center;">
              <button  type="submit" class="btn btn-success btn-sm" name=""><i class="fa fa-dot-circle-o"></i> Edit</button>
              <button type="button" class="btn btn-danger btn-sm" onclick="window.location='{{ route('admin.categories.list') }}'" name="reset"><i class="fa fa-ban"></i> Cancel</button>
            </div>
             
        </form>
  </div>
</div>
 
        <script> CKEDITOR.replace( 'editor1', {
        filebrowserBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    } ); </script>
@endsection