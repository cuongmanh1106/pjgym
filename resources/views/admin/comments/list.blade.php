@extends('admin.include.layout')
@section('title','List of Permission')
@section('content')
@include('admin.include.report')


<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Comments</h1>
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
                            <strong class="card-title">Comment</strong>
                            <Button class="btn btn-success" data-toggle="modal" data-target="#insert_per"><i class="fa fa-plus-circle"></i> add</Button>
                        </div>
                       <div class="search" style="margin-top: 20px">
                           <div class="col-md-3 col-md-offset-3">
                               <input type="text" class="form-control" name="name_search" placeholder=" Name...">
                           </div>
                           <div class="col-md-3 col-md-offset-3">
                               <select name="parent_search" required="required" id="select" class="form-control">
                                <option value="all">All</option>
                                <option value="0">None</option>
                               
                              </select>
                           </div>
                       </div>
                        <div class="card-body">
                       
                  <table id="bootstrap-data-table" class="table table-striped table-bordered search_cate">
                    <thead>

                      <tr>
                      	<th><input type="checkbox" name=""></th>
                        <th>STT</th>
                        <th>customer </th>
                        <th>comment</th>
                        <th>product</th>
                        <th>like</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($cmts as $key=>$p)
                      <tr id="">
                      	<td><input type="checkbox" name=""></td>
                        <td>{{ $key }}</td>
                        <td>{{ $p->user_id }}</td>
                        <td>{{ $p->comment }}</td>
                        <td>{{ $p->pro_id }}</td>
                        <td>{{ $p->like }}</td>
                        
                        <td>
                        	<div class="dropdown">
							    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
							      Action
							    </button>
							    <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
							      <a class="dropdown-item badge badge-danger"  id="delete" onclick  href="javascript::void(0)"><i class="fa fa-trash-o"></i> Xóa</a>
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

    
   
</script>

   
              

@endsection
