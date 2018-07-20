<table id="bootstrap-data-table" class="table table-striped table-bordered">
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