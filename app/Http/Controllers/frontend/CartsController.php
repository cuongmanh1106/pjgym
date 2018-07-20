<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Models\CategoriesModels;
use App\Http\Models\ProductsModels;
use App\Http\Models\CommentModels;
use App\Http\Models\OrdersModels;
use App\Http\Requests\CategoriesRequest;
use Cart;
use Auth;
class CartsController extends Controller
{

    public function add_cart() {

        $c = $_POST['count'];

        $pro_id = $_POST['pro_id'];
        $size = 'XS';
        $qty = 1;
        if(isset($_POST['size'])) {
            $size = $_POST['size'];
            if($size == " "){
                $size = 'XS';
            }
        }
        if(isset($_POST['qty'])){
            $qty = $_POST['qty'];
        }
        $product = ProductsModels::get_product_by_id($pro_id);
        $sizes = json_decode($product->size);
        foreach ($sizes as $key => $value) {
            if($size == $key && $qty > $value) {
                return 'overlimit';
            }
        }
        $cartItem = Cart::add(array('id'=>$pro_id,'name'=>$size, 'qty'=>$qty, 'price'=>$product->price,'options'=>['size'=>$size]));
        foreach ($sizes as $key => $value) { /* với trường hợp cộng dồn qty thì khi update xong so sánh với product nếu lớn hơn thì - 1 quantity cho cart đó rồi báo lỗi */
            if($cartItem->qty > $value && $cartItem->name == $key) {
                Cart::update($cartItem->rowId,$cartItem->qty - 1);
                return 'overlimit';
            }
        }
        $count = Cart::content()->count();
        $total = Cart::subtotal();
        $data = ['cart'=>$cartItem, 'count'=>$count,'total'=>$total];
        return view('frontend.cart.add_cart')->with($data);
    }

    public function checkout() {
        $carts = Cart::content();
        $total = Cart::subtotal();
        $data = ['carts'=>$carts,'total'=>$total];
        return view('frontend.cart.checkout')->with($data);
    }

    public function update_cart() {
        $rowId = $_POST['rowId'];
        $size = $_POST['size'];
        $qty = $_POST['qty'];
        $pro_id = $_POST['pro_id'];
        $product = ProductsModels::get_product_by_id($pro_id);
        $sizes = json_decode($product->size);
        foreach($sizes as $key=>$si) {
            if($qty > $si && $size == $key) {
                return json_encode(['content'=>'overlimit']);
            }
        }
        $item = Cart::get($rowId);
        Cart::update($rowId,[
            'qty'=>$qty,
            'name'=>$size
        ]);
        $content = Cart::get($rowId);
        $total = Cart::subtotal();
        $data = ['content'=>$content,'total'=>$total];
        return json_encode($data);
    }

    public function delete_cart() {
        $rowId = $_GET['rowId'];
        Cart::remove($rowId);
        $count = Cart::content()->count();
        $total = Cart::subtotal();
        $data = [
            'count'=>$count,
            'total' => $total
        ];
        return json_encode($data);
    }

    public function process_to_buy() {
        $carts = Cart::content();
        $total = Cart::subtotal();
        $data = ['carts'=>$carts,'total'=>$total];
        return view('frontend.cart.process_to_buy')->with($data);
    }

    public function order(Request $request) {
        $area = $request->destination;
        $delivery_cost = 0;
        if($area == "hcm") {
            $delivery_cost = 2;
        } else {
            $delivery_cost = 4;
        }
        $customer_id = Auth::user()->id; 

        $data = [
            'customer_id' => $customer_id,
            'delivery_place' => $request->specific,
            'area' => $area,
            'delivery_cost' => $delivery_cost,
            'status' => 1
        ];  

        $id = OrdersModels::insert_order($data);
        if($id != null) {
            $carts = Cart::content();
            foreach($carts as $c) {
                $product = ProductsModels::get_product_by_id($c->id);
                $data_detail = [
                    'order_id' => $id,
                    'pro_id' => $c->id,
                    'price' => $c->price,
                    'size' => $c->name,
                    'quantity' => $c->qty
                ];
                $product = ProductsModels::get_product_by_id($c->id);
                $sizes = json_decode($product->size);
                $total_quantity = 0;
                foreach ($sizes as $key => $value) { /*cập nhật lại size khi mua hàng*/
                    if($c->name == $key) {
                        if($value >= $c->qty) {
                            $sizes->$key = $value - $c->qty;
                            $total_quantity += $value - $c->qty;
                        } else { // nếu mà số lượng mua lớn hơn tồn thì báo lỗi
                            return "not enough to supply";
                        }
                        
                    } else {
                        $total_quantity += $value;
                    }
                }
                $data_product = [
                    'quantity' => $total_quantity,
                    'size' => json_encode($sizes)
                ];
                ProductsModels::update_product($c->id,$data_product);
                OrdersModels::insert_order_detail($data_detail);
            }

            $order = OrdersModels::get_order_by_id($id);

            $data = ['carts'=>Cart::content(),'total'=>Cart::subtotal(),'order'=>$order];
            return view('frontend.cart.success')->with($data);
        }



    }



}

