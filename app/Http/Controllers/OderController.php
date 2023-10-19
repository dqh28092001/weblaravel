<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Oder;
use App\Models\Shipping;
use App\Models\OderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OderController extends Controller
{
    public function manage_oder(){
        $oder = Oder::orderBy("created_at","desc")->get();
        return view("admin.manage_oder")->with(compact('oder'));
    }

    // list danh sách đơn hàng ra
    public function view_oder($oder_code){
        $oder_detail = OderDetail::with('product')->where('oder_code',$oder_code)->get();
        $oder = Oder::where("oder_code",$oder_code)->get();

        foreach($oder as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $oder_status = $ord->oder_status;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();

        $oder_detail = OderDetail::with('product')->where('oder_code',$oder_code)->get();
        return view("admin.view_oder")->with(compact('oder','customer','shipping','oder_detail','oder','oder_status'));

    }

    //update (oder) số lượng còn trong kho
    public function update_oder_qty(Request $request){
        // updata oder
        $data = $request->all();
		$oder = Oder::find($data['oder_id']);
		$oder->oder_status = $data['oder_status'];
		$oder->save();
		if($oder->oder_status==2){
			foreach($data['oder_product_id'] as $key => $product_id){

				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
								$pro_remain = $product_quantity - $qty;
								$product->product_quantity = $pro_remain;
								$product->product_sold = $product_sold + $qty;
								$product->save();
                    }
                }

            }
        }elseif($oder->oder_status!=2 && $oder->oder_status!=3){
			foreach($data['oder_product_id'] as $key => $product_id){

				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
								$pro_remain = $product_quantity + $qty;
								$product->product_quantity = $pro_remain;
								$product->product_sold = $product_sold - $qty;
								$product->save();
						}
				}
			}
		}

        // return view("admin.manage_oder")->with(compact('oder'));
    }

    // update số lượng (qty)
    public function update_qty(Request $request){
		$data = $request->all();
		$oder_detail = OderDetail::where('product_id',$data['oder_product_id'])->where('oder_code',$data['oder_code'])->first();
		$oder_detail->product_sales_quantity = $data['oder_qty'];
		$oder_detail->save();
	}
}
