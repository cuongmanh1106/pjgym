<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class CommentModels extends Model
{

	
	public static function get_comment($pro_id,$skip,$take) {
		return DB::table('comments')->where('parent',0)->where('pro_id',$pro_id)->orderBy('created_at','DESC')->skip($skip)->take($take)->get();
	}

	public static function get_comment_all($pro_id){
		return DB::table('comments')->where('parent',0)->where('pro_id',$pro_id)->get();
	}
	public static function get_comments() {
		return DB::table('comments')->get();
	}



	public static function get_comment_by_id($id) {
		$result =  DB::table('comments')->where('id',$id)->get();
		if(empty($result[0])) {
			return false;
		}
		return $result[0];
	}

	public static function get_like($user_id){

	}

	public static function insert_like($data){
		return DB::table('like')->insert($data);
	}

	public static function insert_comment($data) {
		return DB::table('comments')->insertGetId($data);
	}

	public static function update_comment($id,$data) {
		return DB::table('comments')->where('id',$id)->update($data);
	}

	public static function delete_like($comment_id,$user_id) {
		return DB::table('like')->where('comment_id',$comment_id)->where('user_id',$user_id)->delete();
		
	}
	
}