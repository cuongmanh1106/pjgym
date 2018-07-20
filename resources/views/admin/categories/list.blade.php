@extends('admin.include.layout')
@section('title','List of Categories')
@section('content')
@include('admin.include.report')
@include('admin.categories.modal-insert')



<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Categories</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Table</a></li>
                            <li class="active">Data table</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Categories</strong>
                            <Button class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Insert</Button>
                        </div>
                       <div class="search" style="margin-top: 20px">
                           <div class="col-md-3 md-offset-3">
                               <input type="text" class="form-control" name="name_search" placeholder=" Name...">
                           </div>
                           <div class="col-md-3 md-offset-3">
                               <select name="parent_search" required="required" id="select" class="form-control">
                                <option value="all">All</option>
                                <option value="0">None</option>
                               <?php cate_parent($cates); ?>
                              </select>
                           </div>
                       </div>
                       <hr style="boder:0.5px solid #fff">
                        <div class="card-body">
                       
                  <table id="bootstrap-data-table" class="table table-striped table-bordered search_cate">
                    <thead>

                      <tr>
                      	<th><input type="checkbox" name=""></th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Description</th>
                        <th>Soft</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    	@foreach($cates as $c)
                    	<?php
                    	$parent = DB::table('categories')->where('id',$c->parent_id)->first();
                    	$parent_name = 'None';
                    	if($parent) {
                    		$parent_name = $parent->name;
                    	}
                    	?>
                      <tr id="row-{{$c->id}}">
                      	<td><input type="checkbox" name=""></td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $parent_name }}</td>
                        <td>{{ $c->description }}</td>
                        <td>{{ $c->soft }}</td>
                        <td>
                        	<div class="dropdown">
							    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
							      Action
							    </button>
							    <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
							      <a class="dropdown-item  badge badge-primary" href="{{ route('admin.categories.edit',$c->id) }}"><i class="fa fa-edit"></i> Edit</a>
							      <a class="dropdown-item badge badge-success" href="#"><i class="fa fa-retweet"></i> Change Position</a>
							      <a class="dropdown-item badge badge-danger" data-index="{{ $c->id }}" id="delete" onclick="delete_cate({{$c->id}})" href="javascript::void(0)"><i class="fa fa-trash-o"></i> Xóa</a>
							    </div>
					  		</div>
						</div>
					</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->
<script type="text/javascript">

    function delete_cate(id) {

        if(confirm('Are you are? Data wont backup again')) {
            $.ajax({
                url: "{{ route('admin.categories.delete')}}",
                type: 'GET',
                cache:false,
                data:{'id':id},
                success: function(data,status) {
                    if(data == "success") {
                        $('#row-'+id).remove();
                    } else if(data == "parent_error"){
                        alert('this cate has sub-cate!!! please delete sub-cate first');
                    } else {
                        alert('fail');
                    }
                }
            })
        }    
    }

    $('select[name=parent_search]').on('change',function(){
        var name = $('input[name=name_search]').val();
        var parent = $('select[name=parent_search]').val();
        $.ajax({
            url: "{{ route('admin.categories.search') }}",
            type: 'GET',
            cache: false,
            data: {'name':name, 'parent':parent},
            success: function(data,status) {
                // alert(data);
                document.getElementsByClassName('search_cate')[0].innerHTML = data;
            }
        })
    })
    $('input[name=name_search').on('keyup',function(){
        var name = $('input[name=name_search]').val();
        var parent = $('select[name=parent_search]').val();
        $.ajax({
            url: "{{ route('admin.categories.search') }}",
            type: 'GET',
            cache: false,
            data: {'name':name, 'parent':parent},
            success: function(data,status) {
                // alert(data);
                document.getElementsByClassName('search_cate')[0].innerHTML = data;
            }
        })
    });

    // $('#delete').on('click',function(){
    //     var id = $(this).attr('data-index');
    //     alert(id);
    // })
</script>

   
              
<script> CKEDITOR.replace( 'editor1', {
        filebrowserBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('/public/js/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    } ); </script>
@endsection
