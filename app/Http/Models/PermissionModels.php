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

	
}