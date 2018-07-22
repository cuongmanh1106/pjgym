<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Models\CategoriesModels;
use App\Http\Models\ProductsModels;
use App\Http\Models\CommentModels;
use App\Http\Models\UsersModels;
use App\Http\Requests\UsersRequests;
use Hash;
use App\User;
use Illuminate\Support\Facades\Auth;
use Charts;

class ChartController extends Controller
{
	

  public function index() {
  	$year = date("Y");

    $product = DB::table('order_details')->select(DB::raw('SUM(price*quantity) as total, Month(created_at) as month'))->whereRaw('Year(created_at) = '.$year)->groupBy(DB::raw('Month(created_at)'))->get();
    $top_product = DB::table('products')
    				->join('order_details','products.id','=','order_details.pro_id')
    				->select(DB::raw(' products.id, products.name,products.image,products.price,SUM(order_details.quantity) as total_quantity,SUM(products.price*order_details.quantity) as total'))->groupBy('products.id')->orderBy('total','DESC')->skip(0)->take(10)->get();
   
    $labels = [];
    $values = []; 
    foreach ($product as $key => $value) {
    	$labels[] = $value->month;
    	$values[] = $value->total;
    }

    $pie_chart = Charts::create('bar','highcharts')
    	->title('Revenue earch month this year')
    	->labels($labels)
    	->values($values)
    	->dimensions(1000,500)
    	->responsive(true);
    	
    	

    return view('admin.chart.list',compact('pie_chart','top_product'));
 }

 public function year() {
 	$year = $_POST['year'];
 	$product = DB::table('order_details')->select(DB::raw('SUM(price*quantity) as total, Month(created_at) as month'))->whereRaw('Year(created_at) = '.$year)->groupBy(DB::raw('Month(created_at)'))->get();
 	
    $labels = [];
    $values = []; 
    foreach ($product as $key => $value) {
    	$labels[] = $value->month;
    	$values[] = $value->total;
    }

    $pie_chart = Charts::create('bar','highcharts')
    	->title('Revenue earch month this year')
    	->labels($labels)
    	->values($values)
    	->dimensions(1000,500)
    	->responsive(true);

    	return view('admin.chart.year',compact('pie_chart'));

 }

 public function filter() {
 	$date = $_POST['date'];
 	$date = date_create($date);
	$date = date_format($date,"Y-m-d");
	$product = DB::table('order_details')->select(DB::raw('SUM(price*quantity) as total'))->whereRaw("date(created_at) = '".$date."'")->groupBy(DB::raw('date(created_at)'))->get();
	if(count($product) == 0) {
		return "0";
	}
	return $product[0]->total;

 }



}
