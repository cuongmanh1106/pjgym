<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Models\CategoriesModels;
use App\Http\Models\ProductsModels;
use App\Http\Models\CommentModels;
use App\Http\Models\UsersModels;
use App\Http\Models\OrdersModels;
use App\Http\Requests\UsersRequests;
use Hash;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;
class OrdersController extends Controller
{


	public function index() {
		if(check_permission('list_order') != 1) {
			Session::flash('alert-danger',get_message());
			return back();
		}
		$orders = OrdersModels::get_orders();
		$customer = UsersModels::get_customer();
		$status = OrdersModels::get_status();
		$data = ['orders'=>$orders,'customer'=>$customer,'status'=>$status];
		return view('admin.orders.list')->with($data);
	}

	public function search() {
		$cus_id = $_POST['cus_search'];
		$status = $_POST['status_search'];
		$date_from = $_POST['date_from'];
		$date_to = $_POST['date_to'];

		$result = DB::table('orders');
		if($date_from != '' && $date_to == ''){
			$date_from = date_create($date_from);
			$date_from = date_format($date_from,"Y-m-d H:i:s");
			$result = $result->where('created_at','>=',$date_from);
		} 
		else if($date_to != '' && $date_from == ''){
			$date_to = date_create($date_to);
			$date_to = date_format($date_to,"Y-m-d H:i:s");
			$result = $result->where('created_at','<=',$date_to);
		} else if ($date_to != '' && $date_from != ''){
			$result = $result->where('created_at','<=',$date_to)->where('created_at','>=',$date_from);
		}
		if($cus_id != 'all') {
			$result = $result->where('customer_id',$cus_id);
		}
		if($status != 'all') {
			$result = $result->where('status',$status);
		}

		$result = $result->orderBy('status','ASC')->orderBy('created_at','DESC')->get();

		
		$data = ['orders'=>$result];
		return view('admin.orders.search')->with($data);

	}

	public function details($id) {
		if(check_permission('edit_order') != 1) {
			Session::flash('alert-danger',get_message());
			return back();
		}
		$details = OrdersModels::get_detail_by_order($id);
		$order = OrdersModels::get_order_by_id($id);
		$status = OrdersModels::get_status();
		$data = ['details'=>$details,'order'=>$order,'status'=>$status];
		return view('admin.orders.details')->with($data);
	}

	public function confirm($id,Request $request) {
		$order = OrdersModels::get_order_by_id($id);
		$data = array();
		var_dump($order->status);
		if($order->status == 1 && $request->status != 5 && $request->status != 3) { // nếu status cũ là 1 và status vừa chọn khác 5 và 3 
			$data = [
				'delivery_place' => $request->delivery_place,
				'delivery_cost' => $request->delivery_cost,
				'status' => $request->status
			];
			if(OrdersModels::update_order($data,$id)) {
				$request->session()->flash('alert-success','status la 1 ');
				return redirect()->route('admin.orders.list');

			} else {
				$request->session()->flash('alert-danger','Fail');
				return back();
			}
		} else if($request->status == 5){ //nếu chọn 5 thì phải update quantity bên product
			$detail = OrdersModels::get_detail_by_order($id);
			$data = [
				'status' => $request->status
			];
			if(OrdersModels::update_order($data,$id)) {
				foreach($detail as $d ){
					$product = ProductsModels::get_product_by_id($d->pro_id);
					$sizes = json_decode($product->size);
					$total = 0;
					foreach ($sizes as $key => $value) {
						if($key == $d->size) {
							$sizes->$key = $value + $d->quantity;
							$total += $value + $d->quantity;
						} else {
							$total += $value;
						}
					}
					$data_product = [
						'quantity' => $total,
						'size' => json_encode($sizes)
					];
					ProductsModels::update_product($product->id,$data_product);
				}
				$request->session()->flash('alert-success','status la 5');
				return redirect()->route('admin.orders.list');

			} else {

				$request->session()->flash('alert-success','Fail');
				return back();
			}
			
			
		} else { //nếu chọn 3 thì phải chọn shipper

			$data = [
				'status' => $request->status
			];
			if(OrdersModels::update_order($data,$id)) {
				/*Giao cho shipper giao hang neu status la delivery*/
				$shipper = '';
				if($request->status == 3) {
					$shipper = $_POST['shipper'];
					OrdersModels::insert_ship(['user_id'=>$shipper,'order_id'=>$id]);
				}
				


				$request->session()->flash('alert-success','Status khach 1 va 5');
				return redirect()->route('admin.orders.list');

			} else {
				$request->session()->flash('alert-success','Fail');
				return back();
			}
		}
		

	}

	public function ship() {
		$ship = array();
		if(Auth::user()->permission_id == 6) {
			$ship = DB::table('ship')->where('user_id',Auth::user()->id)->get();
		} else {
			$ship = OrdersModels::list_ship();
		}
		
		$data = [
			'ship'=>$ship
		];


		return view('admin.orders.ship')->with($data);
	}

	public function search_ship(){
		$order_id = $_POST['order_id'];
		$user_id = $_POST['user_id'];
		$status = $_POST['status'];

		$result = DB::table('ship');
		$result = $result->where('order_id','like','%'.$order_id.'%');
		if($user_id != "all"){
			$result = $result->where('user_id',$user_id);
		}
		if($status != "all"){
			$result = $result->where('status',$status);
		}

		$ship = $result->get();
		$data = ['ship'=>$ship];
		return view('admin.orders.search_ship')->with($data);

		
	}

	public function update_status() {
		$id = $_POST['id'];
		$status = $_POST['status'];
		$order_id = $_POST['order_id'];

		if($status != 2) {
			$data = [
				'status' => $status
			];
			if(OrdersModels::update_ship($id,$data)) {
				if(OrdersModels::update_order(['status'=>4],$order_id)){
					return 'success';
				} else {
					return 'fail';
				}
				
			} else {
				return 'fail';
			}
		} else {

			$order = OrdersModels::get_order_by_id($order_id);
			$order_detail = OrdersModels::get_detail_by_order($order_id);
			OrdersModels::update_ship($id,['status'=>2]);
			if(OrdersModels::update_order(['status'=>5],$order_id)) { // nếu cancel thì update lại product nha nha 
				foreach($order_detail as $d ){
					$product = ProductsModels::get_product_by_id($d->pro_id);
					$sizes = json_decode($product->size);
					$total = 0;
					foreach ($sizes as $key => $value) {

						if($key == $d->size) {
							$sizes->$key = $value + $d->quantity;
							$total += $value + $d->quantity;
						} else {
							$total += $value;
						}
						

					}
					$data_product = [
						'quantity' => $total,
						'size' => json_encode($sizes)
					];
					ProductsModels::update_product($product->id,$data_product);
				}
				return 'success';
			} else {
				return 'fail';
			}
			
			
			

		}
	}



}
