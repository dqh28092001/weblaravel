@extends('welcome')
@section('products')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('FE/css/cart.css') }}" type="text/css">

        <title>Document</title>
    </head>

    <body>
        <section class="shop-cart spad">
            <div class="container">
                <div class="row">
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
                                                            data-rowid="{{ $value_content->rowId }}">
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
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6" style="margin-right: 13pc">
                        <div class="cart__btn">
                            <a href="{{ URL::to('/home') }}">Continue Shopping</a>
                        </div>
                    </div>

                    <div class="cart__total__procced" style="width: 22pc;">
                        <h6>Cart total</h6>
                        <ul>
                            <div id="cart-total">
                                Subtotal : <span
                                    style="font-weight:900 ; color:#ca1515 ">{{ number_format(Cart::subtotal(), 0, ',', ',') }}VNĐ</span>
                            </div>

                        </ul>
                        <a href="{{ URL::to('/checkout') }}" class="primary-btn">Proceed to checkout</a>
                            <?php
                                $customer_id = Session::get('customer_id');
                                if ($customer_id != NULL) {
                                ?>
                            <a href="{{ URL::to('/show_checkout') }}" class="primary-btn" style="margin-top: 1pc">Thanh
                                Toán</a>

                            <?php
                            }else {
                            ?>
                            <a href="{{ URL::to('/login_checkout') }}" class="primary-btn" style="margin-top: 1pc">Thanh
                                Toán</a>

                            <?php
                            }
                            ?>
                    </div>
                </div>
            </div>
        </section>
    </body>

    </html>


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
