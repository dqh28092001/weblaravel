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
        $rowId = $request->input('rowId');
        $newQty = $request->input('newQty');

        Cart::update($rowId, $newQty);

        $cartTotal = Cart::subtotal();

        return response()->json(['cartTotal' => $cartTotal]);
    }
}
