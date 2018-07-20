<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Models\CategoriesModels;
use App\Http\Requests\CategoriesRequest;
class CategoriesController extends Controller
{

	public function index() {
		$cates = CategoriesModels::get_cates();
		$data = ['cates'=>$cates];
		return view('admin.categories.list')->with($data);
	}

	public function search() {
		$name = $_GET['name'];
		$parent = $_GET['parent'];
		$result = DB::table('categories')->where('name','like','%'.$name.'%');
		if($parent!="all") {
			$result = $result->where('parent_id',$parent);
		}
		$result = $result->get();
		$data = ['cates'=>$result];
		// var_dump($result);
		return view('admin.categories.search')->with($data);
	}

	public function create() {

		return view('admin.categories.create');
	}

	public function store(Request $request) {
		$data = [
			'name' => $request->name,
			'alias' => changeTitle($request->name),
			'parent_id' => $request->parent,
			'description' => $request->description,
			'soft' => (CategoriesModels::max_soft()!=null)?CategoriesModels::max_soft() + 1 : 1,
			
			'link' => ' ' 
		];
		$last_id = CategoriesModels::insert_cates($data);
		if($last_id != null) {
			$request->session()->flash('alert-success',"Success");
    		return back();
		} else {
			$request->session()->flash('alert-danger','Fail');
    		return back();
		}
	}


	public function edit($id) {
		
		$cate = CategoriesModels::get_cates_by_id($id);
		$cates = CategoriesModels::get_cates();
		$data = ['cate'=>$cate, 'cates'=>$cates];
		return view('admin.categories.edit')->with($data);
	}

	public function update($id, CategoriesRequest $request) {
		$cate = CategoriesModels::get_cates_by_id($id);

		$data = [
			'name' => $request->name,
			'alias' => changeTitle($request->name),
			'parent_id' => $request->parent,
			'description' => $request->description,
		];

		if( $id != $request->parent && CategoriesModels::update_cates($id,$data)) {
			$request->session()->flash('alert-success',"Success");
    		return redirect()->route('admin.categories.list');
		} else if ($request->parent == $id) {
			$request->session()->flash('alert-danger','Wrong Parent!!!');
    		return back();
		} else {
			$request->session()->flash('alert-danger','Fail');
    		return back();
		}
	}

	public function delete(Request $request) {
		$id = $_GET['id'];
		$parent = CategoriesModels::get_cates_by_parentid($id);
		if(count($parent) == 0 && CategoriesModels::delete_cate($id)) {
			echo "success";
		} else if(count($parent) > 0){
			echo "parent_error";
		} else {
			echo "fail";
		}
	}
	
}

