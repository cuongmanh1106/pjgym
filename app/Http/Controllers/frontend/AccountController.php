<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Models\CategoriesModels;
use App\Http\Models\ProductsModels;
use App\Http\Models\OrdersModels;
use App\Http\Requests\UsersRequests;
use App\Http\Requests\EditUserRequest;
use Hash;
use App\User;
use Illuminate\Support\Facades\Auth;
class AccountController extends Controller
{

    public function getRegister() {
        return view('frontend.account.register');
    }
    public function postRegister(UsersRequests $request) {
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
            'permission_id'=>4,
            'address' => $request->address
        );
            //var_dump($data);
        if(User::create($data)){
            if($request->file('image')!=null) {
                $file->move("public/admin/images",$img_name);
            }
            $request->session()->flash('alert-success',"Success");
            return redirect()->route('frontend.account.getlogin');
        } else {
            $request->session()->flash('alert-danger',"Fail");
            return redirect()->back();
        }
    }

    public function getlogin() {
        return view('frontend.account.login');
    }

    public function postlogin(Request $request) {
        $login = array(
            'email' => $request->email,
            'password' => $request->password
        );

        if(Auth::attempt($login) && Auth::user()->permission_id == 4) {
            return redirect()->route('home');
        } else {
            Auth::logout();
            $request->session()->flash('alert-danger',"Wrong password or email");
            return back();
        }
    }

    public function profile() {
        return view('frontend.account.profile');
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

    public function logout(){
        Auth::logout() ;
            return redirect()->route('home');
    }

    public function history_order() {
        $user_id = Auth::user()->id;
        $orders = OrdersModels::get_order_by_customer($user_id);
        $data =['orders'=>$orders];
        return view('frontend.account.history_order')->with($data);
    }

    public function history_detail($id) {
        $details = OrdersModels::get_detail_by_order($id);
        $data = ['details'=>$details];
        return view('frontend.account.history_detail')->with($data);
    }

    
}

