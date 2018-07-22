<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Models\CategoriesModels;
use App\Http\Models\ProductsModels;
use App\Http\Models\PermissionModels;
use App\Http\Models\UsersModels;
use App\Http\Requests\UsersRequests;
use Hash;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;
class PermissionController extends Controller
{

  public function index() {

    if(check_permission('list_permission')!=1){
      Session::flash('alert-danger',get_message());
      return back();
    }
    $per = PermissionModels::get_permission();
    $data = ['per'=>$per];
    return view('admin.permission.list')->with($data);
  }

  public function store(Request $request) {
    if(check_permission('insert_permission')!=1){
      Session::flash('insert-danger',get_message());
      return back();
    }
    $data = [
      'name' => $request->name,
      'position' => PermissionModels::get_max_position() + 1 
    ];

    if(PermissionModels::insert_permission($data)) {
     $request->session()->flash('alert-success',"Success");
     return redirect()->back();
   }  else {
    $request->session()->flash('alert-danger',"Fail");
    return redirect()->back();
  }


}

public function list_group($id) {
  $list_permission= array();
  if(PermissionModels::get_list_permission($id) != null){
    $list_permission = PermissionModels::get_list_permission($id);
  }
  $permission = PermissionModels::get_permission_by_id($id);
  $data =['list_permission'=>$list_permission,'permission'=>$permission];
  return view('admin.permission.list_group')->with($data);
}

public function update_group(Request $request) {
  if(check_permission('edit_permission')!=1){
      Session::flash('insert-danger',get_message());
      return back();
    }
  $per_id = $_POST['per_id'];
  $id_permission = $_POST['id'];
  $id_group = $_POST['id_group'];

  $data = [
    'per_id' => $id_permission,
    'list_product' => ($request->list_product == 'on')?1:0,
    'insert_product' => ($request->insert_product == 'on')?1:0,
    'edit_product' => ($request->edit_product == 'on')?1:0,
    'delete_product'=> ($request->delete_product == 'on')?1:0,

    'list_category' => ($request->list_category == 'on')?1:0,
    'insert_category' => ($request->insert_category == 'on')?1:0,
    'edit_category' => ($request->edit_category == 'on')?1:0,
    'delete_category'=> ($request->delete_category == 'on')?1:0,

    'list_user' => ($request->list_user == 'on')?1:0,
    'insert_user' => ($request->insert_user == 'on')?1:0,
    'edit_user' => ($request->edit_user == 'on')?1:0,
    'delete_user'=> ($request->delete_user == 'on')?1:0,

    'list_permission' => ($request->list_permission == 'on')?1:0,
    'insert_permission' => ($request->insert_permission == 'on')?1:0,
    'edit_permission' => ($request->edit_permission == 'on')?1:0,
    'delete_permission'=> ($request->delete_permission == 'on')?1:0,

    'list_order' => ($request->list_order=='on')?1:0,
    'edit_order' => ($request->edit_order == 'on')?1:0
  ];


  if($per_id == '' || $id_group == ''){
    if(PermissionModels::insert_list_permission($data)) {
      $request->session()->flash('alert-success',"Success");
      return back();
    } else {
      $request->session()->flash('alert-danger',"Fail");
      return back();
    }  
  } else {
    if(PermissionModels::update_list_permission($id_group,$data)){
      $request->session()->flash('alert-success','Success');
      return redirect()->back();
    } else 
    {
      $request->session()->flash('alert-danger','Fail');
      return back();
    }
  }
}


}
