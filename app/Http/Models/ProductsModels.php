<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ProductsModels extends Model
{

	public static function get_products() {
		return DB::table('products')->where('status',0)->orderBy('id','DESC')->get();
	}

	public static function get_products_paging($pages) {
		return DB::table('products')->where('status',0)->orderBy('id','DESC')->paginate($pages);
	}

	public static function get_product_by_id($id) {
		$result = DB::table('products')->where('id',$id)->get();
		if(empty($result[0])) {
			return false;
		}
		return $result[0];
	}

	public static function get_products_by_cate($cate_id) {
		return DB::table('products')->where('cate_id',$cate_id)->where('status',0)->inRandomOrder()->limit(4)->get();
	}

	public static function insert_product($data) {
		return DB::table('products')->insertGetId($data);
	}

	public static function update_product($id,$data) {
		return DB::table('products')->where('id',$id)->update($data);
	}

	public static function delete_product($id) {
		return DB::table('products')->where('id',$id)->update(['status'=>1]);
	}
}