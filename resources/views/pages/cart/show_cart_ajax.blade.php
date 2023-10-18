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
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @elseif (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                    <div class="col-lg-12">
                        <form action="{{ url('/update_cart_ajax') }}" method="POST" style="display: flex">

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
                                    {{-- @php
                                        echo '<pre>';
                                        print_r(Session::get('cart'));
                                        echo '</pre>';
                                    @endphp --}}

                                    @php
                                    $total = 0;
                                @endphp
                                            @foreach (Session::get('cart') as $key => $cart)
                                            @php
                                                $subtotal = $cart['product_price']*$cart['product_qty'];
                                                $total += $subtotal;
                                            @endphp

                                        <tr>
                                            <td class="cart__product__item">
                                                <img src="{{ asset('public/upload/product/'.$cart['product_image']) }}" width="100" height="100" alt="{{ $cart['product_name'] }}">
                                                <div class="cart__product__item__title">
                                                    <h6>{{ $cart['product_name'] }}</h6>
                                                    <div class="rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price product-price">{{ number_format($cart['product_price'],0,',',',' )}}VNĐ
                                            </td>
                                            </td>
                                            <td class="cart__quantity">

                                                    <span class="qty-btn minus" style="margin-top: 4px;"
                                                        data-rowid="">-</span>
                                                    <div class="qty-display">
                                                        <input type="text" value="{{ $cart['product_qty'] }}" class="quantity"
                                                            name="cart_qty" data-rowid="">
                                                    </div>
                                                    <span class="qty-btn plus" style="margin-top: 4px;"
                                                        data-rowid="">+</span>

                                            </td>

                                            <td class="cart__total product-total">
                                                <span class="product-total-value">
                                                    {{ number_format($subtotal,0,',',',' )}}
                                                </span>
                                            </td>

                                            <td class="cart__close"><a href="{{ url('/delete_cart_ajax/'.$cart['session_id']) }}"><span class="icon_close"></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
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
                                Subtotal : <span style="font-weight:900 ; color:#ca1515 "> {{ number_format($total,0,',',',' )}}VNĐ</span>
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
