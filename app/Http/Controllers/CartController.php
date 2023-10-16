<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; // Correct import for DB
use App\Http\Requests;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session; // Correct import for Session
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash; // Correct import for Hash
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        $productId = $request->productid_hidden;
        $quantity = $request->qty;

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $product_info = DB::table('tbl_product')->where('product_id', $productId)->first();

        // Đảm bảo bạn đã lấy thông tin sản phẩm thành công
        if ($product_info) {
            Cart::add([
                'id' => $product_info->product_id,
                'name' => $product_info->product_name,
                'qty' => $quantity,
                'price' => $product_info->product_price,
                'weight' => 123, //có thể điều chỉnh điều này khi cần thiết
                'options' => [
                    'image' => $product_info->product_image, //đặt các tùy chọn bổ sung cho mục này.nó bao gồm một hình ảnh liên quan đến sản phẩm.
                ],
            ]);
        }

        return Redirect::to('/show_cart');
    }


    public function show_cart()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product);
    }


    public function delete_to_cart($rowId)
    {
        // để xóa một mặt hàng khỏi giỏ hàng.
        Cart::remove($rowId);
        return Redirect::to('/show_cart');
    }


    public function update_cart(Request $request)
    {
        $rowId = $request->input('rowId'); // Tham số này được sử dụng để xác định sản phẩm cần cập nhật trong giỏ hàng.
        $newQty = $request->input('newQty'); // Số lượng mới của sản phẩm sau khi cập nhật.

        Cart::update($rowId, $newQty);

        // Tính tổng tiền cho sản phẩm cụ thể
        $item = Cart::get($rowId);
        $totalPrice = $item->price * $item->qty;

        $formattedTotalPrice = number_format($totalPrice, 0, ',', ',') . ' VNĐ';

        $cartTotal = Cart::subtotal();

        $formattedCartTotal = number_format($cartTotal, 0, ',', ',') . ' VNĐ';

        return response()->json(['cartTotal' => $formattedCartTotal, 'totalPrice' => $formattedTotalPrice]);
    }

// --------------------------------------------------------------------------------------------------------------------

    // add to cart ajax
    public function add_cart_ajax(Request $request)
    {
        //lấy toàn bộ dữ liệu
        $data = $request->all();
        // session_id mới cho sản phẩm được thêm vào giỏ hàng. 
        $session_id = substr(md5(microtime()), rand(0, 26), 5); // để lấy thời gian hiện tại với độ chính xác micro giây và  mã hóa nó bằng hàm md5()
        $cart = Session::get('cart');//Lấy giỏ hàng hiện tại từ phiên (session)

        // Kiểm tra xem giỏ hàng đã tồn tại hay chưa.
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                    $cart[$key] = array(
                    'session_id' => $val['session_id'],
                    'product_name' => $val['product_name'],
                    'product_id' => $val['product_id'],
                    'product_image' => $val['product_image'],
                    'product_qty' => $val['product_qty']+ $data['cart_product_qty'],
                    'product_price' => $val['product_price'],
                    );
                    Session::put('cart',$cart);
                }
            }
            // nếu kh có cái nào trùng thì nó sẽ thêm sản phẩm mới vào
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);//Cập nhật giỏ hàng trong phiên với dữ liệu mới
            }
        } else {

            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
        }
        Session::put('cart', $cart);
        Session::save();
    }

    public function show_cart_ajax(Request $request)
    {
        $meta_desc = "Giỏ Hàng Của Bạn";
        $meta_keywords = "Giỏ Hàng Ajax";
        $meta_title = "Giỏ Hàng Ajax ";
        $url_canonical = $request->url();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        return view('pages.cart.show_cart_ajax')->with('category', $cate_product)->with('brand', $brand_product)
        ->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
    }
}
