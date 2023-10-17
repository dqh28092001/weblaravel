<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Correct import for DB
use App\Http\Requests;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session; // Correct import for Session
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash; // Correct import for Hash

class CheckoutController extends Controller
{
     // ngăn chặn người dùng chưa đăng nhập mà vô được bên trong
     public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            // gửi tất cả data bằng hàm send() thay vì phải ghi lại từng biến chứa dữ liệu
            return Redirect::to('admin_login')->send();

        }
    }

    // khi thanh toán mà chưa đăng nhập thì nó sẽ đẩy người dùng ra đăng nhập
    public function login_checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }

    //Đăng Kí để thanh toán sản phẩm
    public function login_add_customer(Request $request)
    {
        $data = array();

        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);

        return Redirect::to('/show_checkout');
    }


    // Đăng Nhập để thanh toán sản phẩm
    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();

        if ($result) {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/show_checkout');
        } else {
            return Redirect::to('/login_checkout');
        }
    }

    // Đăng Xuất
    public function logout_checkout()
    {
        Session::flush();
        return Redirect::to('/login_checkout');
    }

    // THôgn tin khách hàng để mua sản phẩm
    public function show_checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }

    // Lưu thôgn tin khách hàng lại
    public function save_checkout_customer(Request $request)
    {
        $data = array();

        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_note'] = $request->shipping_note;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id', $shipping_id);

        return Redirect::to('/payment');
    }

    // in sản phẩm đã add ra thôii
    public function payment()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        return view('pages.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product);
    }

    // quy trình đặt hàng
    public function oder_place(Request $request)
    {
        // insert payment_methood
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        //insertGetId chèn dữ liệu này vào bảng và sau đó trả về giá trị ID của bản ghi vừa được chèn.
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        // insert oder
        $oder_data = array();
        $oder_data['customer_id'] = Session::get('customer_id');
        $oder_data['shipping_id'] = Session::get('shipping_id');
        $oder_data['payment_id'] = $payment_id;
        $oder_data['oder_total'] = number_format(Cart::subtotal(), 0, ',', ',');
        $oder_data['oder_status'] = 'Đang chờ xử lý';
        $oder_id = DB::table('tbl_oder')->insertGetId($oder_data);


        // insert oder_detail
        $content = Cart::content();
        foreach ($content as $v_content) {
            $oder_detail_data['oder_id'] = $oder_id;
            $oder_detail_data['product_id'] = $v_content->id;
            $oder_detail_data['product_name'] = $v_content->name;
            $oder_detail_data['product_price'] = $v_content->price;
            $oder_detail_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_oder_detail')->insert($oder_detail_data);
        }

        if ($data['payment_method'] == 1) {
            echo 'thanh toan bằng atm';
        } elseif ($data['payment_method'] == 2) {
            Cart::destroy();
            $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
            $brand_product = DB::table('tbl_brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

            return view('pages.checkout.handcash')->with('category', $cate_product)->with('brand', $brand_product);
        } else {
            echo ' paypal';
        }
    }

    // manage-oder admin
    public function manage_oder(){
        $this->AuthLogin();
        $all_oder= DB::table('tbl_oder')
        ->join('tbl_customers','tbl_oder.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_oder.*','tbl_customers.customer_name')
        ->orderBy('tbl_oder.oder_id','desc')->get();
        $manage_oder = view('/Admin.manage_oder')->with('all_oder', $all_oder);
        return view('/Admin.admin_header')->with('admin.manage_oder', $manage_oder);
    }

    public function view_oder($oder_id){
        $this->AuthLogin();
        $oder_by_id = DB::table('tbl_oder')
            ->join('tbl_customers', 'tbl_oder.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_oder.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->join('tbl_oder_detail', 'tbl_oder.oder_id', '=', 'tbl_oder_detail.oder_id')
            ->select('tbl_oder.*', 'tbl_customers.*', 'tbl_shipping.*', 'tbl_oder_detail.*')
            ->where('tbl_oder.oder_id', $oder_id)->get();

        $manage_oder_by_id = view('Admin.view_oder')->with('oder_by_id', $oder_by_id);
        return view('Admin.admin_header')->with('admin_view_oder', $manage_oder_by_id);
    }

}
