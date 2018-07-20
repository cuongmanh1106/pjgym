<?php



namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{

	public function index() {
		if(Auth::check()&& Auth::user()->permission_id != 4) 
		{
			Auth::logout();
		}
		return view('frontend.home.index');
	}
}
