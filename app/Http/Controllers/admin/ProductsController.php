<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Models\CategoriesModels;
use App\Http\Models\ProductsModels;
use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\ProductsRequest;
class ProductsController extends Controller
{


	public function index() {
		$products = ProductsModels::get_products();
		$cates = CategoriesModels::get_cates();

		$data = [
			'products' => $products,
			'cates' => $cates
		];

		return view('admin.products.list')->with($data);
	}

	public function search() {
		$name = $_GET['name'];
		$price_from = $_GET['price_from'];
		$price_to = $_GET['price_to'];
		$cate = $_GET['cate'];
		
		$result = DB::table('products')->where('name','like','%'.$name.'%');
		if($price_from != null && $price_to != null) {
			$result = $result->where('price', '>=',$price_from)->where('price','<=',$price_to);
		} else if($price_from != null && $price_to == null) {
			$result = $result->where('price', '>=',$price_from);
		} else if($price_from == null && $price_to != null) {
			$result = $result->where('price','<=',$price_to);
		}

		if($cate != 'all') {
			$result = $result->where('cate_id',$cate);
		}
		$cates = CategoriesModels::get_cates();
		$products = $result->get();
		$data = ['products'=>$products, 'cates'=>$cates];

		return view('admin.products.search')->with($data);

	}

	public function create(){
		$cate = CategoriesModels::get_cates();
		$data =['cates'=>$cate];
		return view('admin.products.create')->with($data);
	}

	public function store(ProductsRequest $request){
		$file = $request->file('image');
		$img_name = $file->getClientOriginalName();
		$img_name = newImage($img_name);
		$total_quantity = 0;
		$size = '';
		if(isset($_POST['size'])) {
			$arr_size = $_POST['size'];
			$arr_quantity = $_POST['quantity'];
			$merge=array_combine($arr_size,$arr_quantity);
			$total_quantity = array_sum($arr_quantity);
			$size = json_encode($merge);
		}
		/* reduce equal price mean dont reduce */
		$reduce = str_replace(',', '', $request->price);
		if($_POST['reduce'] != "") {
			$reduce = str_replace(',', '', $request->reduce);
		}
		

		
		$data = [
			'name' => $request->name,
			'price' => str_replace(',', '', $request->price),
			'reduce' => $reduce,
			'alias' => changeTitle($request->name),
			'cate_id' => $request->cate_id,
			'intro' => $request->intro,
			'description' => $request->description,
			'quantity' => $total_quantity,
			'size' => $size,
			'image' => $img_name,
			
		];
		$pro_id = ProductsModels::insert_product($data);
		if($pro_id != null) {
			//move file to server
			$file->move("public/admin/images",$img_name);

			//update sub_image
			$sub_image = '';
			if($request->file('sub_image')){
				$sub_image_array = array();
				$f = $request->file('sub_image');
				foreach ($f as $key => $value) {
					$sub_img = newImage($value->getClientOriginalName());
					$sub_image_array[] = $sub_img;
					$sub_image = json_encode($sub_image_array);
					$data_update = [
						'sub_image' => $sub_image
					];
					if(ProductsModels::update_product($pro_id,$data_update)) {
						$value->move("public/admin/images",$sub_img);
					}
				}
				$request->session()->flash('alert-success','Thành công');
				return back();
				
			} else {
				$request->session()->flash('alert-success','Thành công');
				return back();
			}
		} else {
			$request->session()->flash('alert-danger','Thất bại');
			return back();
		}
		

	}

	public function edit($id) {

		$product = ProductsModels::get_product_by_id($id);
		$cates = CategoriesModels::get_cates();
		$data =[
			'product'=>$product,
			'cates' => $cates
		];

		return view('admin.products.edit')->with($data);
	}

	public function update(Request $request, $id) {

		$new_sub_image = $request->old_sub_image;
		$delete_sub_image = [];
		$product = ProductsModels::get_product_by_id($id);
		if(!empty($product->sub_image)){
			$old_sub_image = (array) json_decode($product->sub_image);
		}
		if(count($new_sub_image) != count($old_sub_image) && $new_sub_image != null && $old_sub_image != null){ // nếu hình phụ k thay đổi 
			$delete_sub_image = array_diff($old_sub_image, $new_sub_image); //Những Phần tử Khác nhau giữa 2 array
																//$result = array_intersect($array1, $array2); những phần tữ giống nhau giữa hai mảng

			$new_sub_image = array_intersect($old_sub_image, $new_sub_image);
		}
		
		var_dump($new_sub_image);
		var_dump($delete_sub_image);


		$old_img = $product->image;
		$new_img = $old_img;
		$file = $request->file('image');
		if($file != null) {
			$new_img = newImage($file->getClientOriginalName());
		}

		$total_quantity = 0;
		$size = '';
		if(isset($_POST['size'])) {
			$arr_size = $_POST['size'];
			$arr_quantity = $_POST['quantity'];
			$merge=array_combine($arr_size,$arr_quantity);
			$total_quantity = array_sum($arr_quantity);
			$size = json_encode($merge);
		}
		/* reduce equal price mean dont reduce */
		$reduce = str_replace(',', '', $request->price);
		if($_POST['reduce'] != "") {
			$reduce = str_replace(',', '', $request->reduce);
		}
		/* nếu chỉ thêm hình thì dữ liêu k thay đổi vì load hình rồi mới update dữ liệu nên cần thay đồi dữ liệu để nó chạy vào if update*/
		$description = $request->description;
		if($product->sub_image == json_encode($new_sub_image)) { 
			$description = $description.'.';
		}

		$data = [
			'name' => $request->name,
			'price' => str_replace(',', '', $request->price),
			'reduce' => $reduce,
			'alias' => changeTitle($request->name),
			'cate_id' => $request->cate_id,
			'intro' => $request->intro,
			'description' => $description,
			'quantity' => $total_quantity,
			'size' => $size,
			'image' => $new_img,
			'sub_image' => json_encode($new_sub_image)
			 //tám thêm hình phụ còn lại chưa có hình phụ update
			
		];

		if(ProductsModels::update_product($id,$data)) {
			
			//Xóa hình chính nếu nó bị thay đổi
			if($old_img != $new_img) {
				if (file_exists(public_path('admin/images/'.$old_img)))
					unlink(public_path('admin/images/'.$old_img));
				$file->move("public/admin/images",$new_img);
			}

			//Xóa hình phụ đã bị user xóa
			foreach($delete_sub_image as $value) {
				if (file_exists(public_path('admin/images/'.$value)))
					unlink(public_path('admin/images/'.$value));

			}
			$sub_image = '';

			//thêm hình phụ
			if($request->file('sub_image')){
				 //convert thành array
				$f = $request->file('sub_image');
				foreach ($f as $key => $value) {
					$sub_img = newImage($value->getClientOriginalName());
					$new_sub_image[] = $sub_img;
					$sub_image = json_encode($new_sub_image);
					$data_update = [
						'sub_image' => $sub_image
					];
					if(ProductsModels::update_product($id,$data_update)) {
						$value->move("public/admin/images",$sub_img);
					}
				}
				var_dump($new_sub_image);
				$request->session()->flash('alert-success','Success');
				return back();
				
			} else {
				$request->session()->flash('alert-success','Success');
				return back();
			}
		} else {
			$request->session()->flash('alert-danger','Fail');
			return back();
		}
		

	}

	public function delete() {

		$query = "SELECT * FROM nhanvien WHERE TENDANGNHAP =".$tendangnhap." AND MATKHAU = ".$matkhau;
		$id = $_GET['id'];

		if(ProductsModels::delete_product($id)) {
			echo "success";
		} else {
			echo "fail"; 
		}
	}

	public function edit_sub_image() {
		$id = $_GET['id'];
		$pro = ProductsModels::get_product_by_id($id);
		$sub_image = $pro->sub_image;
		return $sub_image;
	}

	public function update_sub_image(Request $request) {
		$id = $_POST['id_pro'];
		var_dump($id);
		$new_sub_image = $request->old_sub_image; // sub_image in database
		$delete_sub_image = []; //contain sub_images are deleted by user
		$product = ProductsModels::get_product_by_id($id);
		$old_sub_image = array();
		
		if(!empty($product->sub_image)){
			$old_sub_image = (array) json_decode($product->sub_image);
		}
		if(count($new_sub_image) != count($old_sub_image) && $new_sub_image != '' && $old_sub_image != ''){ // nếu hình phụ k thay đổi 
			$delete_sub_image = array_diff($old_sub_image, $new_sub_image); //Những Phần tử Khác nhau giữa 2 array
			$new_sub_image = array_intersect($old_sub_image, $new_sub_image);
		}
		

		

		if($request->file('sub_image') != null){ //Thêm hình
			 //convert thành array
			$f = $request->file('sub_image');
			foreach ($f as $key => $value) {
				$sub_img = newImage($value->getClientOriginalName());
				$new_sub_image[] = $sub_img;

				$sub_image = json_encode($new_sub_image);

				$data_update = [
					'sub_image' => $sub_image
				];

				if(ProductsModels::update_product($id,$data_update)) {
					$value->move("public/admin/images",$sub_img);
				}

			}
			//there are sub images are deleted
			if(count($delete_sub_image) != 0 ) {	
				foreach($delete_sub_image as $value) {
					if (file_exists(public_path('admin/images/'.$value)))
						unlink(public_path('admin/images/'.$value));
				}
			}
			$request->session()->flash('alert-success','Thêm hình');
			return back();
			/*chỉ xóa hình không có thêm hình*/
		} else if ($request->file('file_image') == null && count($delete_sub_image)!=0) { //Xóa hình mà k thêm
			$data_update = [
				'sub_image' => json_encode($new_sub_image)
			];
			if(ProductsModels::update_product($id,$data_update)) {
				foreach($delete_sub_image as $value) {
					if (file_exists(public_path('admin/images/'.$value)))
						unlink(public_path('admin/images/'.$value));
				}
			}
			
			$request->session()->flash('alert-success','Xóa hình mà k thêm');
			return back();
		} else if($new_sub_image == null) { //Xóa hết hình
			$data_update = [
				'sub_image' => ''
			];
			if(ProductsModels::update_product($id,$data_update)) {
				foreach($delete_sub_image as $value) {
					if (file_exists(public_path('admin/images/'.$value)))
						unlink(public_path('admin/images/'.$value));
				}
			}
			
			$request->session()->flash('alert-success','Xóa hết hình');
			return back();
		}

		
	}

	public function edit_size() {
		$id = $_GET['id'];
		$pro = ProductsModels::get_product_by_id($id);
		$size = $pro->size;
		return $size;
	}

	public function update_size(Request $request) {
		$id = $_POST['id_pro'];

		$total_quantity = 0;
		$size = '';
		if(isset($_POST['size'])) {
			$arr_size = $_POST['size'];
			$arr_quantity = $_POST['quantity'];
			$merge=array_combine($arr_size,$arr_quantity);
			$total_quantity = array_sum($arr_quantity);
			$size = json_encode($merge);

			$data = [
				'size' => $size,
				'quantity' => $total_quantity
			];

			if(ProductsModels::update_product($id,$data)) {
				$request->session()->flash('alert-success','Success');
				return back();
			} else {
				$request->session()->flash('alert-danger','Fail');
				return back();
			}
		}
	}
}