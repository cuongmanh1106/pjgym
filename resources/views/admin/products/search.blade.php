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
                        <td>{{ $p->intro }}</td>
                        <td>{{ $p->description }}</td>
                        <td>{{ $size_name }}</td>
                        <td>
                        	<div class="dropdown">
							    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
							      Action
							    </button>
							    <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
							      <a class="dropdown-item  badge badge-primary" href="{{ route('admin.products.edit',$p->id) }}"><i class="fa fa-edit"></i> Edit</a>
							      <a class="dropdown-item badge badge-success" data-toggle="modal" data-target="#edit_sub_image" href="javascript::void(0)"><i class="fa fa-retweet"></i> Edit Sub Image</a>
							      <a class="dropdown-item badge badge-danger" data-index="{{ $p->id }}" id="delete_pro" onclick="delete_pro({{$p->id}})" href="javascript::void(0)"><i class="fa fa-trash-o"></i> Xóa</a>
							    </div>
					  		</div>
						</div>
					</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>