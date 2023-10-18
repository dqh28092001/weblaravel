<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ashion | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('FE/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('FE/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('FE/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('FE/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('FE/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('FE/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('FE/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('FE/css/style.css') }}" type="text/css">
    {{-- <link rel="stylesheet" href="{{ asset('FE/css/dropdown.css') }}" type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('FE/css/sweetalert.css') }}" type="text/css">

    <link href="{{ asset('FE/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('FE/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('FE/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('FE/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('FE/css/responsive.css') }}" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>


    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt"></span>
                    <div class="tip">2</div>
                </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                    <div class="tip">2</div>
                </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="{{ asset('FE/img/logo.png') }}" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="#">Login</a>
            <a href="#">Register</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="{{ URL::to('/home') }}"><img src="{{ asset('FE/img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu" style="display: flex">
                        <ul style="display: flex;
                        margin-right: 10pc;">
                            <li class="active"><a href="{{ URL::to('/home') }}">Home</a></li>
                            {{-- <li><a href="./shop.html">Shop</a></li> --}}
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    @foreach ($category as $key => $cate)
                                        <li><a
                                                href="{{ URL::to('/danh_muc_san_pham/' . $cate->category_id) }}">{{ $cate->category_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            {{-- <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contact</a></li> --}}

                        </ul>
                        <div class="input-group">
                            <form action="{{ URL::to('/search') }}" method="POST" style="display:flex">
                                {{ csrf_field() }}
                                <input style="width: 12pc;" name="keywords_submit"
                                    class="form-control mr-3 border-end-0 border rounded-pill" type="search"
                                    id="search-input" placeholder="Search ...">
                                <span class="input-group-append">
                                    <button
                                        class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5"
                                        type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </form>
                        </div>

                    </nav>

                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">
                            <?php
                                $customer_id = Session::get('customer_id');
                                if ($customer_id != NULL) {
                                ?>
                            <a href="{{ URL::to('/logout_checkout') }}">Đăng Xuất</a>
                            <?php
                            }else {
                                ?>
                            <a href="{{ URL::to('/login_checkout') }}">Đăng Nhập</a>
                            <?php
                            }
                            ?>

                        </div>
                        <div class="header__right__auth">
                            <?php
                                $customer_id = Session::get('customer_id');
                                $shipping_id = Session::get('shipping_id');
                                if ($customer_id != NULL && $shipping_id == NULL) {
                                ?>
                            <a href="{{ URL::to('/show_checkout') }}">Thanh Toán </a>
                            <?php
                            }elseif($customer_id != NULL && $shipping_id != NULL) {
                            ?>
                            <a href="{{ URL::to('/payment') }}">Thanh Toán </a>
                            <?php
                            }else {
                            ?>
                            <a href="{{ URL::to('/login_checkout') }}">Thanh Toán </a>
                            <?php
                            }
                            ?>
                        </div>
                        <ul class="header__right__widget">
                            <div class="header__right">

                                <li><a href="#"><span class="icon_heart_alt"></span>
                                        <div class="tip">2</div>
                                    </a></li>
                                <li><a href="{{ URL::to('/show_cart_ajax') }}"><span class="icon_bag_alt"></span>
                                        <div class="tip">2</div>
                                    </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    @yield('products')

    <!-- Instagram Begin -->
    <div class="instagram">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="{{ asset('FE/img/instagram/insta-1.jpg') }}">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="{{ asset('FE/img/instagram/insta-2.jpg') }}">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="{{ asset('FE/img/instagram/insta-3.jpg') }}">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="{{ asset('FE/img/instagram/insta-4.jpg') }}">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="{{ asset('FE/img/instagram/insta-5.jpg') }}">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="{{ asset('FE/img/instagram/insta-6.jpg') }}">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Instagram End -->

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="./index.html"><img src="{{ asset('FE/img/logo.png') }}" alt=""></a>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            cilisis.</p>
                        <div class="footer__payment">
                            <a href="#"><img src="{{ asset('FE/img/payment/payment-1.png') }}"
                                    alt=""></a>
                            <a href="#"><img src="{{ asset('FE/img/payment/payment-2.png') }}"
                                    alt=""></a>
                            <a href="#"><img src="{{ asset('FE/img/payment/payment-3.png') }}"
                                    alt=""></a>
                            <a href="#"><img src="{{ asset('FE/img/payment/payment-4.png') }}"
                                    alt=""></a>
                            <a href="#"><img src="{{ asset('FE/img/payment/payment-5.png') }}"
                                    alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-5">
                    <div class="footer__widget">
                        <h6>Quick links</h6>
                        <ul>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Blogs</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="footer__widget">
                        <h6>Account</h6>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Orders Tracking</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Wishlist</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-8">
                    <div class="footer__newslatter">
                        <h6>NEWSLETTER</h6>
                        <form action="#">
                            <input type="text" placeholder="Email">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <div class="footer__copyright__text">
                        <p>Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i
                                class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank">Colorlib</a>
                        </p>
                    </div>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{ asset('FE/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('FE/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('FE/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('FE/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('FE/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('FE/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('FE/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('FE/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('FE/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('FE/js/main.js') }}"></script>
    <script src="{{ asset('FE/js/sweetalert.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}


    <script type="text/javascript">
        $(document).ready(function() {
            $('.add-to-cart').click(function() {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/add-cart-ajax') }}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        _token: _token
                    },
                    success: function() {

                        // alert('Cart added successfully')
                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{ url('/show_cart_ajax') }}";
                            });

                    }

                });
            });
        });
    </script>

</body>

</html>
