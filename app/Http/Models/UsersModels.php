<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class UsersModels extends Model
{

	public static function get_users() {
		return DB::table('users')->where('status','0')->orderBy('id','DESC')->get();
	}

	public static function get_customer() {
		return DB::table('users')->where('permission_id',4)->get();
	}
	public static function get_user_by_id($id) {
		$result = DB::table('users')->where('id',$id)->get();
		if(empty($result[0])) {
			return false;
		}
		return $result[0];
	}

	public static function update_user($data,$id) {
		return DB::table('users')->where('id',$id)->update($data);
	}


	
}