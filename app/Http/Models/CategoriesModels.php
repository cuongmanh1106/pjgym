<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class CategoriesModels extends Model
{
	public static function get_cates() {
		return DB::table('categories')->where('status',0)->get();
	}

	public static function max_soft() {
		return DB::table('categories')->max('soft');
	}

	public static function get_cates_by_parentid($id) {
		return $result =  DB::table('categories')->where('parent_id','=',$id)->where('status',0)->get();
		}


	public static function get_cates_by_id($id) {
		$result = DB::table('categories')->where('id',$id)->get();
		if(empty($result[0])) {
			return false;
		}
		return $result[0];
	}
	public static function search_cates($value) {
		return DB::table('categories')->where('name','like','%'.$value.'%')->get();
	}

	public static function insert_cates($data) {
		return DB::table('categories')->insertGetId($data);
	}

	public static function update_cates($id,$data) {
		return DB::table('categories')->where('id',$id)->update($data);
	}

	public static function delete_cate($id) {
		return DB::table('categories')->where('id',$id)->update(['status'=>1]);
	}

}