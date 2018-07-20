@extends('admin.include.layout')
@section('title','List of Products')
@section('content')
@include('admin.include.report')
@include('admin.products.edit_sub_image')
@include('admin.products.size')

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
                            <strong class="card-title">Products</strong>
                            <Button class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Insert</Button>
                        </div>
                       <div class="search" style="margin-top: 20px">
                           <div class="col-md-3">
                               <input type="text" class="form-control" name="name_search" placeholder=" Name...">
                           </div>
                           <div class="col-md-3 col-md-offset-3">
                               <select name="cate_search" required="required" id="select" class="form-control">
                                <option value="all">All</option>
                                <option value="0">None</option>
                               <?php cate_parent($cates); ?>
                              </select>
                           </div>
                           <div class="col-md-6">
                                <div class="col-md-6">
                                    <input type="text"  onkeyup="formatNumBerKeyUp(this)" class="form-control" name="price_from" placeholder=" Price from...">
                                </div>
                                 <div class="col-md-6">
                                    <input type="text" onkeyup="formatNumBerKeyUp(this)" class="form-control" name="price_to" placeholder=" Price to...">
                                </div>
                           </div>
                       </div>

                       <hr style="boder:0.5px solid #fff">
                        <div class="card-body">
                       
                  <table id="bootstrap-data-table" class="table table-striped table-bordered search_pro">
                    <thead>

                      <tr>
                      	<th><input type="checkbox" name=""></th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Discount Price</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Introduce</th>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($products as $p)
                    	<?php
                    	$cate = DB::table('categories')->where('id',$p->cate_id)->first();
                    	$cate_name = 'None';
                    	if($cate) {
                    		$cate_name = $cate->name;
                    	}
                    	$reduce = number_format($p->reduce,2);
                    	if($p->reduce == $p->price) {
                    		$reduce = 'None';
                    	}

                    	$size = json_decode($p->size);
                    	$size_name = '[';

                    	foreach ($size as $key => $value) {
                    		$size_name .= $key .' - ';
                    	}
                    	$size_name .= ']';
                    		
                    	
                    	?>
                      <tr id="row_pro_{{$p->id}}">
                      	<td><input type="checkbox" name=""></td>
                      	<td><img src="{{ asset('/public/admin/images')}}/{{$p->image}}"></td>
                        <td>{{ $p->name }}</td>
                        <td>{{ number_format($p->price, 2)}}</td>
                        <td>{{ $reduce }}</td>
                        <td>{{ $cate_name }}</td>
                        <td>{{ $p->quantity }}</td>
                        <td>{{ substr($p->intro,0,20) }}.....</td>
                        <td>{{ substr($p->description,0,50) }}.....</td>
                        <td>{{ $size_name }}</td>
                        <td>
                        	<div class="dropdown">
							    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
							      Action
							    </button>
							    <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
							      <a class="dropdown-item  badge badge-primary" href="{{ route('admin.products.edit',$p->id) }}"><i class="fa fa-edit"></i> Edit</a>
							      <a class="dropdown-item badge badge-success edit_sub_img" data-proid="{{ $p->id }}"  data-toggle="modal" href="#edit_sub_image"><i class="fa fa-retweet"></i> Edit Sub Image</a>
                                   <a class="dropdown-item badge badge-success " data-proid="{{ $p->id }}"  data-toggle="modal" href="#edit_size"><i class="fa fa-retweet"></i> Edit Size</a>
							      <a class="dropdown-item badge badge-danger" data-index="{{ $p->id }}" id="delete_pro" onclick="delete_pro({{$p->id}})" href="javascript::void(0)"><i class="fa fa-trash-o"></i> Xóa</a>
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
        function delete_pro(id){
            if(confirm('Are you are? Data wont backup again')) {
                $.ajax({
                    type:'GET',
                    url : "{{ route('admin.products.delete') }}",
                    cache: false,
                    data: {'id':id},
                    success: function(data,status) {
                        if(data == "success") {
                            $('#row_pro_'+id).remove();
                        }
                    }
                })
            }
        }

        $('input[name=name_search], input[name=price_from], input[name=price_to]').on('keyup',function(){
            var name = $('input[name=name_search').val();
            var price_from = $('input[name=price_from]').val();
            var price_to = $('input[name=price_to]').val();
            var cate = $('select[name=cate_search]').val();

            $.ajax({
                type:'GET',
                url: '{{ route('admin.products.search') }}',
                cache: false,
                data: {'name':name, 'price_from':price_from, 'price_to':price_to, 'cate':cate},
                success: function(data,status) {
                    document.getElementsByClassName('search_pro')[0].innerHTML = data;
                }
            })
        })

        $('#edit_sub_image').on('show.bs.modal', function(e) {
             var userid = $(e.relatedTarget).data('proid');
             $(e.currentTarget).find('input[name="id_pro"]').val(userid);
             $(e.currentTarget).find('#old_image').html('');
            console.log(userid);
             $.ajax({
                type:'GET',
                url : '{{ route('admin.products.edit_sub_image') }}',
                cache:false,
                data:{'id':userid},
                dataType:'JSON',
                success:function(data,status){
                     var html = '';
                     $.each(data,function(index,v){
                        html += ' <div class="col-md-6">'
                        html += '   <div class="col-md-11" style="margin-top: 15px; margin-bottom: 15px"><img src="{{asset('/public/admin/images')}}/'+v+'" class="" width="130px"><a style="width: 30px; height: 30px; padding:6px 0; border-radius: 15px; text-align: center;font-size: 12px; line-height: 1.42857; position: absolute; left: 131px; top: 0" class="btn btn-danger btn-circle icon_del del_sub_image"><i class="fa fa-times"></i></a></div>';
                        html += '<input type="hidden" value="'+v+'" name="old_sub_image[]">'
                        html += '</div>';
                     });
                     $(e.currentTarget).find('#old_image').html(html);
                      
                }
            });
        });

        $('#edit_size').on('show.bs.modal', function(e) {
             var id = $(e.relatedTarget).data('proid');
             $.ajax({
                type:'GET',
                url : '{{ route('admin.products.edit_size') }}',
                cache:false,
                data:{'id':id},
                dataType:'JSON',
                success:function(data,status){
                     var html = '';
                   

                     $.each(data,function(index,v){
                        var xs='';
                        var s='';
                        var m='';
                        var l='';
                        var xl='';
                        var xxl='';
                        var xxxl='';
                        if(index == "XS") xs = 'selected';
                        if(index == "S") s = 'selected';
                        if(index == "M") m = 'selected';
                        if(index == "L") l = 'selected';
                        if(index == "XL") xl = 'selected';
                        if(index == "2XL") xxl = 'selected';
                        if(index == "3XL") xxxl = 'selected';
                        html += '  <div class="row form-group">'
                        html += '  <div class="col-md-1"><label for="text-input" class=" form-control-label">Size:</label></div>'
                        html += '  <div class="col-md-4">'
                        html += ' <select name="size[]" class="form-control" id="select">';
                            html += '<option '+xs+' value="XS">XS</option>';
                            html += '<option '+s+'  value="S">S</option>';
                            html += '<option '+m+'  value="M">M</option>';
                            html += '<option '+l+'  value="L">L</option>';
                            html += '<option '+xl+'  value="XL">XL</option>';
                            html += '<option '+xxl+'  value="2XL">2XL</option>';
                            html += '<option '+xxxl+'  value="3XL">3XL</option>';
                        html += '</select>';
                        html += ' </div>';
                    html += '<div><label for="text-input" class=" form-control-label">Quantity:</label></div>';
                    html += '<div class="col-md-4"><input type="text" value = "'+v+'" required="required" id="text-input" onkeyup="formatNumBerKeyUp(this)" name="quantity[]" class="form-control"></div>';
                    html += ' <button type="button" class="close close-add-size" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                    html += ' </div>';
                     });
                     $('#add-size').html(html);
                      $(e.currentTarget).find('input[name="id_pro"]').val(id);
                }
            });
        });
    </script>

@endsection