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

class OrdersController extends Controller
{

	public function index() {
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
		if($order->status == 1 && $request->status != 5) {
			$data = [
				'delivery_place' => $request->delivery_place,
				'delivery_cost' => $request->delivery_cost,
				'status' => $request->status
			];
			if(OrdersModels::update_order($data,$id)) {
				$request->session()->flash('alert-success','Success');
				return redirect()->route('admin.orders.list');

			} else {
				$request->session()->flash('alert-danger','Fail');
				return back();
			}
		} else if($request->status == 5){
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
							$total = $value + $d->quantity;
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
				$request->session()->flash('alert-success','Success');
				return redirect()->route('admin.orders.list');

			} else {
				$request->session()->flash('alert-success','Fail');
				return back();
			}
			
			
		} else {
			$data = [
				'status' => $request->status
			];
			if(OrdersModels::update_order($data,$id)) {
				$request->session()->flash('alert-success','Success');
				return redirect()->route('admin.orders.list');

			} else {
				$request->session()->flash('alert-success','Fail');
				return back();
			}
		}
		

	}



}
