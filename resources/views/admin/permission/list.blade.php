@extends('admin.include.layout')
@section('title','List of Permission')
@section('content')
@include('admin.include.report')
@include('admin.permission.create')


<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Permission</h1>
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
                            <strong class="card-title">Permissions</strong>
                            <Button class="btn btn-success" data-toggle="modal" data-target="#insert_per"><i class="fa fa-plus-circle"></i> Insert</Button>
                        </div>
                       
                        <div class="card-body">
                       
                  <table id="bootstrap-data-table" class="table table-striped table-bordered search_cate">
                    <thead>

                      <tr>
                      	<th><input type="checkbox" name=""></th>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($per as $key=>$p)
                      <tr id="">
                      	<td><input type="checkbox" name=""></td>
                        <td>{{ $key }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->position }}</td>
                        
                        <td>
                            <a href="{{ route('admin.permission.list_group',$p->id) }}" class="badge badge-info"><i class="fa fa-eye"></i> List permisson</a>
                        	<!-- <div class="dropdown">
							    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
							      Action
							    </button>
							    <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
							      <a class="dropdown-item badge badge-danger"  id="delete" onclick  href="javascript::void(0)"><i class="fa fa-trash-o"></i> Xóa</a>
							    </div>
					  		</div> -->
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

   
              

@endsection
