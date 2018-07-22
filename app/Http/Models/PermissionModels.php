<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PermissionModels extends Model
{

	public static function get_permission() {
		return DB::table('permission')->get();
	}

	public static function get_max_position() {
		return DB::table('permission')->max('position');
	}

	public static function insert_permission($data) {
		return DB::table('permission')->insert($data);
	}

	public static function check_permission($controller, $per_id) {
		$result = DB::table('group_permission')->where('per_id',$per_id)->first();
		return $result->$controller;
	}

	public static function get_list_permission($id) {
		return DB::table('group_permission')->where('per_id',$id)->first();
	}

	public static function get_permission_by_id($id){
		$result = DB::table('permission')->where('id',$id)->get();
		if(empty($result)) {
			return false;
		}
		return $result[0];
	}

	public static function insert_list_permission($data){
		return DB::table('group_permission')->insert($data);
	}

	public static function update_list_permission($id,$data) {
		return DB::table('group_permission')->where('id',$id)->update($data);
	}

	
}