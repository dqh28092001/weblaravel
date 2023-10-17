@extends('welcome')
@section('products')
    <section id="cart_items">
        <div class="container">
            <div class="register-req">
                <p  style="margin-left: 16pc;">Làm Ơn Đăng Kí Hoặc Đăng Nhập Để Thanh Toán Giỏ Hàng Và Xem Lại Lịch Sử Mua Hàng</p>
            </div><!--/register-req-->
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-12 clearfix" style="margin-left: 20pc;">
                        <div class="bill-to">
                            <p style="margin-left: 9pc;">Điền Thông Tin Gửi Hàng</p>
                            <div class="form-one">
                                <form action="{{ URL::to('/save_checkout_customer')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="text" name="shipping_email" placeholder="Email">
                                    <input type="text" name="shipping_name" placeholder="Name ">
                                    <input type="text" name="shipping_address" placeholder="Address">
                                    <input type="text" name="shipping_phone"  placeholder="Phone">
                                    <textarea  name="shipping_note" placeholder="Ghi Chú Đơn Hàng Của Bạn" rows="16"></textarea>
                                    <input type="submit" value="Gửi" name="send_oder" class="btn btn-primary btn-sm" >
                        </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- <div class="review-payment">
                <h2>Xem Lại Giỏ Hàng</h2>
            </div>

            <div class="table-responsive cart_info">

            </div>
            <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div> --}}
        </div>
    </section> <!--/#cart_items-->
@endsection
