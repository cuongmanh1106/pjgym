<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Models\CategoriesModels;
use App\Http\Models\ProductsModels;
use App\Http\Models\CommentModels;
use App\Http\Requests\CategoriesRequest;
class ProductsController extends Controller
{

    public function index() {
        $products = ProductsModels::get_products();
        $data =['products'=>$products];
        return view('frontend.products.list')->with($data);
    }

    public function product_filter(){
        $price = $_GET['price'];
        $discount = $_GET['discount'];
        $name = $_GET['name'];
        $soft = $_GET['soft'];
        $result = DB::table('products');
        if($price != 'all'){
            $cost = explode('-',$price);
            if(count($cost)>1){ // price nằm trong khoảng 
                $result = $result->where('price','>',$cost[0])->where('price','<',$cost[1]);
            } else { // Có 1 giá trị price
                $fil_price = explode(',',$price);
                if($fil_price[0] == "small") {
                    $result = $result->where('price','<',$fil_price[1]);
                } elseif($fil_price[0] == "big") {
                    $result = $result->where('price','>',$fil_price[1]);
                }
            }
        }
        $result = $result->where('name','like','%'.$name.'%');
        if($soft != 'all') {
            switch($soft){
                case 'price_high':
                $result = $result->orderBy('price','DESC');break;
                case 'price_low':
                $result = $result->orderBy('price','ASC');break;
                case 'popular':
                $result = $result->orderBy('view','DESC');break;
                case 'newest':
                $result = $result->orderBy('created_at','DESC');break;
            }
        }

        $result = $result->get();
        $data = ['products'=>$result];


        return view('frontend.products.filter')->with($data);
    }

    public function single($id) {
        $product = ProductsModels::get_product_by_id($id);
        $comments = CommentModels::get_comment($id,0,10);
        $pro_cate = ProductsModels::get_products_by_cate($product->cate_id);
        $all_comment = CommentModels::get_comment_all($id);
        $data = ['product'=>$product,'pro_cate'=>$pro_cate,'comments'=>$comments,'all_comment'=>$all_comment];
        return view('frontend.products.single')->with($data);
    }

    public function add_comment() {
        $comment = $_POST['comment'];
        $pro_id = $_POST['pro_id'];
        $user_id = $_POST['user_id'];
        $data = [
            'pro_id' => $pro_id,
            'user_id' => $user_id,
            'comment' => $comment,
            'like' => 0
        ];
        $id = CommentModels::insert_comment($data);
        if($id != null) {
            $comment = CommentModels::get_comment_by_id($id);
            return json_encode($comment);
        }
    }

    public function add_sub_comment(){
        $comment = $_POST['comment'];
        $pro_id = $_POST['pro_id'];
        $user_id = $_POST['user_id'];
        $id = $_POST['id'];
        $data = [
            'pro_id' => $pro_id,
            'user_id' => $user_id,
            'parent' =>  $id,
            'comment' => $comment,
            'like' => 0
        ];
        $user_name = DB::table('users')->where('id',$user_id)->first();
        $id = CommentModels::insert_comment($data);
        if($id != null) {
            $comment = CommentModels::get_comment_by_id($id);
            $data = [
                'comment'=>$comment,
                'user_name' => $user_name
            ];
            return json_encode($data);
        }
    }

    public function show_more(){
        $pro_id = $_POST['pro_id'];
        $count = $_POST['count'];
        $comments = CommentModels::get_comment($pro_id, $count, 10);
        $data = ['comments'=>$comments,'pro_id'=>$pro_id];
        return view('frontend.products.show_more')->with($data);
    }


    public function like() {
        $comment_id = $_POST['cmt_id'];
        $user_id = $_POST['user_id'];
        $cmt = CommentModels::get_comment_by_id($comment_id);
        $data = [
            'comment_id' => $comment_id,
            'user_id' => $user_id
        ];
        
        if(CommentModels::insert_like($data)) {
            $data_cmt = [
                'like' => $cmt->like + 1 
            ];
            CommentModels::update_comment($comment_id, $data_cmt);

            return "success";
        }
        return "fail";
    }
    public function dislike() {
        $comment_id = $_POST['comment_id'];
        $user_id = $_POST['user_id'];
        $cmt = CommentModels::get_comment_by_id($comment_id);
       
        
        if(count(CommentModels::delete_like($comment_id,$user_id))==1) {
            $data_cmt = [
                'like' => $cmt->like - 1
            ];
            CommentModels::update_comment($comment_id, $data_cmt);

            return "success";
        }
        return "fail";
    }

    
}

