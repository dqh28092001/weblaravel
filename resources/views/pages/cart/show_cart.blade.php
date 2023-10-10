@extends('welcome')
@section('products')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('FE/css/cart.css')}}" type="text/css">

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
                                        <td class="cart__price product-price">{{ number_format($value_content->price) . ' ' . 'VNĐ' }}</td>
                                        </td>
                                        {{-- <td class="cart__quantity" >
                                            <div class="pro-qty" data-rowid="{{ $value_content->rowId }}">
                                                <input type="text" value="{{ $value_content->qty }}" class="quantity" data-rowid="{{ $value_content->rowId }}">
                                            </div>
                                        </td> --}}
                                        <td class="cart__quantity">

                                                <span class="qty-btn minus" data-rowid="{{ $value_content->rowId }}">-</span>
                                                <div class="qty-display">
                                                    <input type="text" value="{{ $value_content->qty }}" class="quantity" data-rowid="{{ $value_content->rowId }}">
                                                </div>
                                                <span class="qty-btn plus" data-rowid="{{ $value_content->rowId }}">+</span>
                                   
                                        </td>
                                        
                                        <td class="cart__total product-total">
                                            <?php
                                            $subtotal = $value_content->price * $value_content->qty;
                                            echo number_format($subtotal) . ' ' . 'VNĐ';
                                            ?>
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
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="{{ URL::to('/home') }}">Continue Shopping</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn update__btn">
                        <a href="#"><span class="icon_loading"></span> Update cart</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="discount__content">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">Apply</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Cart total</h6>
                        <ul>
                            <div id="cart-total">
                                Subtotal <span>{{ number_format(Cart::subtotal(), 0, ',', ',') }}</span>
                            </div>

                        </ul>
                        <a href="#" class="primary-btn">Proceed to checkout</a>
                    </div>
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
                var rowId = $(this).data('rowid');
                var quantityInput = $(`.quantity[data-rowid="${rowId}"]`);
                var currentQty = parseInt(quantityInput.val());
                quantityInput.val(currentQty + 1); // Tăng giá trị
                updateCart(rowId, currentQty + 1); // Gọi hàm cập nhật giỏ hàng
            });
    
            // Xử lý khi nhấn nút -
            $('.minus').on('click', function() {
                var rowId = $(this).data('rowid');
                var quantityInput = $(`.quantity[data-rowid="${rowId}"]`);
                var currentQty = parseInt(quantityInput.val());
                if (currentQty > 1) { // Đảm bảo số lượng không âm và ít nhất là 1
                    quantityInput.val(currentQty - 1); // Giảm giá trị
                    updateCart(rowId, currentQty - 1); // Gọi hàm cập nhật giỏ hàng
                }
            });
    
            // Hàm cập nhật giỏ hàng thông qua Ajax
            function updateCart(rowId, newQty) {
                $.ajax({
                    type: 'POST',
                    url: '/update_cart',
                    data: {
                        _token: '{{ csrf_token() }}',
                        rowId: rowId,
                        newQty: newQty
                    },
                    success: function(data) {
                        // Cập nhật số lượng sản phẩm
                        $(`.product-price[data-rowid="${rowId}"]`).html(data.productPrice);
                        // Cập nhật tổng tiền sản phẩm
                        $(`.product-total[data-rowid="${rowId}"]`).html(data.productTotal);
    
                        // Cập nhật tổng tiền của giỏ hàng
                        $('#cart-total').html('Subtotal <span>' + data.cartTotal + '</span>');
                    }
                });
            }
        });
    </script>
    
@endsection
