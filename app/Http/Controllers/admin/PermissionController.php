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

class PermissionController extends Controller
{

    public function index() {
       $per = PermissionModels::get_permission();
       $data = ['per'=>$per];
       return view('admin.permission.list')->with($data);
   }

   public function store(Request $request) {
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
}
