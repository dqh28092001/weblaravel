@extends('welcome')
@section('products')
    <section id="cart_items">
        <div class="container">
            <div class="register-req">
                <p  style="margin-left: 16pc;">Làm Ơn Đăng Kí Hoặc Đăng Nhập Để Thanh Toán Giỏ Hàng Và Xem Lại Lịch Sử Mua Hàng</p>
            </div><!--/register-req-->
            <div class="shopper-informations">
            </div>
            <div class="review-payment">
                <h2>Xem Lại Giỏ Hàng</h2>
            </div>

            <div class="col-lg-12">
                <?php
                // Cart::content() hiển thị nội dung
                $content = Cart::content();
                // echo '<pre>';
                // print_r($content);
                // echo '</pre>';
                ?>
                <div class="shop__cart__table">
                    <table>
                        <thead>

                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($content as $key => $value_content)
                                <tr>
                                    <td class="cart__product__item">
                                        <img src="{{ URL::to('public/upload/product/' . $value_content->options->image) }}"
                                            width="100" height="100" alt="">
                                        <div class="cart__product__item__title">
                                            <h6>{{ $value_content->name }}</h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price product-price">
                                        {{ number_format($value_content->price) . ' ' . 'VNĐ' }}</td>
                                    </td>
                                    <td class="cart__quantity">
                                        <form action="{{ URL::to('/update_cart') }}" method="POST"
                                            style="display: flex">
                                            {{ csrf_field() }}
                                            <span class="qty-btn minus" style="margin-top: 4px;"
                                                data-rowid="{{ $value_content->rowId }}">-</span>
                                            <div class="qty-display">
                                                <input type="text" value="{{ $value_content->qty }}"
                                                    class="quantity" name="cart_qty"
                                                    data-rowid="{{ $value_content->rowId }}" style="border: none;
                                                    text-align: center;
                                                    width: 6pc;
                                                ">
                                            </div>
                                            <span class="qty-btn plus" style="margin-top: 4px;"
                                                data-rowid="{{ $value_content->rowId }}">+</span>
                                        </form>
                                    </td>

                                    <td class="cart__total product-total">
                                        {{--  Biến khóa {{ $key }}dự kiến ​​sẽ được thay thế bằng mã định danh duy nhất cho từng sản phẩm,
                        cho phép JavaScript xác định và cập nhật tổng giá trị của sản phẩm tương ứng --}}
                                        <span class="product-total-value-{{ $key }}">
                                            {{ number_format($value_content->price * $value_content->qty, 0, ',', ',') }}
                                            VNĐ
                                        </span>
                                    </td>

                                    <td class="cart__close"><a
                                            href="{{ URL::to('/delete_to_cart/' . $value_content->rowId) }}"><span
                                                class="icon_close"></span></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <h4 style="margin: 40px 0;font-size:20px">Chọn Hình Thức Thanh Toán</h4>
            <form action="{{ URL::to('/oder_place') }}" method="POST">
                {{ csrf_field() }}
            <div class="payment-options">
                <span>
                    <label><input name="payment_option" value="1" type="checkbox"> Trả bằng thẻ ATM</label>
                </span>
                <span>
                    <label><input name="payment_option" value="2" type="checkbox"> Trả bằng tiền mặt</label>
                </span>
                <span>
                    <label><input  name="payment_option" value="3" type="checkbox"> Paypal</label>
                </span>
                <input type="submit" value="Đặt Hàng" name="send_oder_place" class="btn btn-primary btn-sm" >

            </div>
        </form>
        </div>
    </section> <!--/#cart_items-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Xử lý khi nhấn nút +
            $('.plus').on('click', function() {
                // lấy giá trị của thuộc tính data-rowid từ nút "plus" được nhấn,
                var rowId = $(this).data('rowid');
                var quantityInput = $(
                `.quantity[data-rowid="${rowId}"]`); //data-rowid để lưu trữ mã định danh duy nhất cho sản phẩm, giúp xác định sản phẩm cần cập nhật.
                var currentQty = parseInt(quantityInput.val());
                quantityInput.val(currentQty + 1);
                // rowId, giá trị định danh của sản phẩm,
                updateCart(rowId, currentQty + 1);
            });

            // Xử lý khi nhấn nút -
            $('.minus').on('click', function() {
                var rowId = $(this).data('rowid');
                var quantityInput = $(`.quantity[data-rowid="${rowId}"]`);
                var currentQty = parseInt(quantityInput.val());
                if (currentQty > 1) { // Đảm bảo số lượng không âm và ít nhất là 1
                    quantityInput.val(currentQty - 1);
                    updateCart(rowId, currentQty - 1);
                } else {
                    alert('Số lượng sản phẩm phải ít nhất là 1.');
                }
            });

            // Lắng nghe sự kiện thay đổi giá trị của input số lượng
            $('.quantity').on('change', function() {
                // Lấy mã định danh của sản phẩm (rowId) từ thuộc tính data-rowid của trường nhập.
                var rowId = $(this).data('rowid');
                var newQty = $(this).val();
                if (newQty >= 1) {
                    updateCart(rowId, newQty);
                } else {
                    alert('Số lượng sản phẩm phải ít nhất là 1.');
                    // Khôi phục lại số lượng sản phẩm về 1 hoặc giá trị trước khi thay đổi không hợp lệ.
                    var previousQty = $(this).attr(
                    'value'); //attr() đặt hoặc trả về các thuộc tính và giá trị của các phần tử được chọn.
                    $(this).val(
                    previousQty); //đặt giá trị của trường nhập số lượng trở lại giá trị trước đó
                }
            });

            function updateCart(rowId, newQty) {
                $.ajax({
                    type: 'POST',
                    url: '/update_cart',
                    data: {
                        _token: '{{ csrf_token() }}', //token, đây là mã CSRF token để đảm bảo tính bảo mật,
                        rowId: rowId, //rowId để xác định sản phẩm cần cập nhật,
                        newQty: newQty //newQty để cập nhật số lượng sản phẩm.
                    },
                    success: function(data) {
                        // Cập nhật số lượng sản phẩm
                        $(`.product-price[data-rowid="${rowId}"]`).html(data.productPrice);

                        // Cập nhật số tiền sản phẩm
                        var productTotalValue = $(`.product-total-value-${rowId}`);
                        productTotalValue.text(data.totalPrice);

                        // Cập nhật tổng tiền của giỏ hàng
                        $('#cart-total span').text(data.cartTotal);
                    }
                });
            }
        });
    </script>
@endsection
