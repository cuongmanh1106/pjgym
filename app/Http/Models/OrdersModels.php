<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class OrdersModels extends Model
{

	public static function get_orders() {
		return DB::table('orders')->orderBy('status','ASC')->orderBy('created_at','DESC')->get();
	}

	public static function get_status() {
		return DB::table('status')->get();
	}

	public static function insert_order($data) {
		return DB::table('orders')->insertGetId($data);
	}

	public static function insert_order_detail($data){
		return DB::table('order_details')->insert($data);
	}


	public static function get_order_by_id($id) {
		$result = DB::table('orders')->where('id',$id)->get();
		if(empty($result[0])) {
			return false;
		}
		return $result[0];
	}

	public static function get_order_by_customer($cus_id) {
		return DB::table('orders')->where('customer_id',$cus_id)->orderBy('created_at','desc')->get();
	}

	public static function get_detail_by_order($order_id) {
		return DB::table('order_details')->where('order_id',$order_id)->get();
	}

	public static function update_order($data,$id) {
		return DB::table('orders')->where('id',$id)->update($data);
	}

	public static function insert_ship($data) {
		return DB::table('ship')->insert($data);
	}

	public static function list_ship() {
		return DB::table('ship')->get();
	}

	public static function update_ship($id,$data) {
		return DB::table('ship')->where('id',$id)->update($data);
	}


	
}