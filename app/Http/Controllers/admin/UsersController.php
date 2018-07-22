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
use App\Http\Requests\EditUserRequest;
use Hash;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;
class UsersController extends Controller
{

    public function index() {
        if(check_permission('list_user')!=1){
            Session::flash('alert-danger',get_message());
            return back();
        }
        $users = UsersModels::get_users();
        $data = ['users'=>$users];
        return view('admin.users.list')->with($data);
    }

    //register
    public function create() {
        if(check_permission('insert_user')!=1){
            Session::flash('alert-danger',get_message());
            return back();
        }
        $per = PermissionModels::get_permission();
        $data =['per'=>$per];
        return view('admin.users.create')->with($data);
    }

    public function store(UsersRequests $request) {
        if(check_permission('edit_user')!=1){
            Session::flash('alert-danger',get_message());
            return back();
        }
        $file = '';
        $img_name = '';
        if($request->file('image')!=null) {
            $file = $request->file('image');
            $img_name = $file->getClientOriginalName();
            $img_name = newImage($img_name);
        }

        $data = array(
            'first_name'   => $request->first_name,
            'last_name'    =>$request->last_name,
            'email'        =>$request->email,
            'password'     =>Hash::make($request->password),
            'phone_number' =>$request->phone_number,
            'image'        =>$img_name,
            'permission_id'=>$request->permission_id
        );
            //var_dump($data);
        if(User::create($data)){
            if($request->file('image')!=null) {
                $file->move("public/admin/images",$img_name);
            }
            $request->session()->flash('alert-success',"Success");
            return redirect()->back();
        } else {
            $request->session()->flash('alert-danger',"Fail");
            return redirect()->back();
        }
    }

    public function delete() {
        $id = $_GET['id'];
        if(UsersModels::update_user(['status'=>1],$id)) {
            return 'success';
        }
    }

    public function login(Request $request) {
        $login = array(
            'email' => $request->email,
            'password' => $request->password
        );

        if(Auth::attempt($login) && Auth::user()->permission_id != 4) {
            return redirect()->route('admin.chart.list');
        } else {
            return back();
        }
    } 
    public function logout() {
        Auth::logout() ;
            return back();
        
    } 

    public function profile($id) {
        $user = UsersModels::get_user_by_id($id);
        $data = ['user'=>$user];
        return view('admin.users.profile');
    } 

    public function update_profile(EditUserRequest $request) {
        $id = $_POST['user_id'];
        $file = '';
        $old_image = (Auth::user()->image != '')?Auth::user()->image:'';
        $img_name = $old_image;
        if($request->file('image')!=null) {
            $file = $request->file('image');
            $img_name = $file->getClientOriginalName();
            $img_name = newImage($img_name);
        }

        $data = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'image' => $img_name
        );

        if(UsersModels::update_user($data,$id)){
            if($request->file('image')!=null) {
                $file->move("public/admin/images",$img_name);
                // unlink(public_path('admin/images/'.$old_image));
            }
        $request->session()->flash('alert-success',"Success");
            return redirect()->back();
        } else {
            $request->session()->flash('alert-danger',"Fail");
            return redirect()->back();
        }
    }

    public function update(Request $request) {
        $data = ['password' => $request->new_password];
        if(UsersModels::update_user($data,Auth::user()->id)) {
             $request->session()->flash('alert-success',"Success");
            return redirect()->back();
        } else {
            $request->session()->flash('alert-danger',"Fail");
            return redirect()->back();
        }
    }

    public function change_password() {
        $password = $_POST['passowrd'];
        $result = DB::table('users')->where('id',Auth::user()->id)->where('password',Hash::make($password))->get();
        echo $result;
    }

    public function check_password() {
        $password = $_POST['password'];
        $new_password = $_POST['new_password'];
        if(Hash::check($password,Auth::user()->password)){
            $user_id = Auth::User()->id;                       
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($new_password);
            $obj_user->save(); 
            return "success";
        }
        return "fail";
       
    }
}
