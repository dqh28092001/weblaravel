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
                                    @php
                                        echo '<pre>';
                                        print_r(Session::get('cart'));
                                        echo '</pre>';
                                    @endphp



                                    @foreach (Session::get('cart') as $key => $cart)
                                    
                                        <tr>
                                            <td class="cart__product__item">
                                                <img src="" width="100" height="100" alt="">
                                                <div class="cart__product__item__title">
                                                    <h6></h6>
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
                                            </td>
                                            </td>
                                            <td class="cart__quantity">
                                                <form action="" method="POST" style="display: flex">

                                                    <span class="qty-btn minus" style="margin-top: 4px;"
                                                        data-rowid="">-</span>
                                                    <div class="qty-display">
                                                        <input type="text" value="" class="quantity"
                                                            name="cart_qty" data-rowid="">
                                                    </div>
                                                    <span class="qty-btn plus" style="margin-top: 4px;"
                                                        data-rowid="">+</span>
                                                </form>
                                            </td>

                                            <td class="cart__total product-total">
                                                <span class="product-total-value">
                                                    VNĐ
                                                </span>
                                            </td>

                                            <td class="cart__close"><a href=""><span class="icon_close"></span></a>
                                            </td>
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
                                Subtotal : <span style="font-weight:900 ; color:#ca1515 "> VNĐ</span>
                            </div>

                        </ul>
                        <a href="#" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </section>
    </body>

    </html>
@endsection
