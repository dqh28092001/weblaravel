<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>ADMIN || ASHION</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('BE/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('BE/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('BE/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('BE/css/font.css') }}" type="text/css" />
    <link href="{{ asset('BE/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('BE/css/morris.css') }}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('BE/css/monthly.css') }}">


</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    ADMIN
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ asset('BE/images/2.png') }}">
                            <span class="username">
                                <?php
                                $admin_name = Session::get('admin_name');
                                if ($admin_name) {
                                    echo $admin_name;
                                }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{ URL::to('/logout') }}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{ URL::to('dashboard') }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Đơn Hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/manage_oder') }}">Quản Lý Đơn Hàng</a></li>
                                {{-- <li><a href="{{ URL::to('/all_category_product') }}">Liệt Kê Danh Mục Sản Phẩm</a></li> --}}
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh Mục Sản Phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add_category_product') }}">Thêm Danh Mục Sản Phẩm</a></li>
                                <li><a href="{{ URL::to('/all_category_product') }}">Liệt Kê Danh Mục Sản Phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thương Hiệu Sản Phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add_brand_product') }}">Thêm Thương Hiệu Sản Phẩm</a></li>
                                <li><a href="{{ URL::to('/all_brand_product') }}">Liệt Kê Thương Hiệu Sản Phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span> Sản Phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add_product') }}">Thêm Sản Phẩm</a></li>
                                <li><a href="{{ URL::to('/all_product') }}">Liệt Kê Sản Phẩm</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                @yield('dashboard')
            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <!-- //font-awesome icons -->
    <script src="{{ asset('BE/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('BE/js/raphael-min.js') }}"></script>
    <script src="{{ asset('BE/js/morris.js') }}"></script>
    {{-- form validator jquery --}}
    <script src="{{ asset('BE/js/jquery.form-validator.min.js') }}"></script>
    <script type="text/javascript">
        $.validate({

        });
    </script>
    <script src="{{ asset('BE/js/bootstrap.js') }}"></script>
    <script src="{{ asset('BE/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('BE/js/scripts.js') }}"></script>
    <script src="{{ asset('BE/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('BE/js/jquery.nicescroll.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{ asset('BE/js/flot-chart/excanvas.min.js') }}"></script><![endif]-->
    <script src="{{ asset('BE/js/jquery.scrollTo.js') }}"></script>


    <!-- morris JavaScript -->
    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,
                data: [{
                        period: '2015 Q1',
                        iphone: 2668,
                        ipad: null,
                        itouch: 2649
                    },
                    {
                        period: '2015 Q2',
                        iphone: 15780,
                        ipad: 13799,
                        itouch: 12051
                    },
                    {
                        period: '2015 Q3',
                        iphone: 12920,
                        ipad: 10975,
                        itouch: 9910
                    },
                    {
                        period: '2015 Q4',
                        iphone: 8770,
                        ipad: 6600,
                        itouch: 6695
                    },
                    {
                        period: '2016 Q1',
                        iphone: 10820,
                        ipad: 10924,
                        itouch: 12300
                    },
                    {
                        period: '2016 Q2',
                        iphone: 9680,
                        ipad: 9010,
                        itouch: 7891
                    },
                    {
                        period: '2016 Q3',
                        iphone: 4830,
                        ipad: 3805,
                        itouch: 1598
                    },
                    {
                        period: '2016 Q4',
                        iphone: 15083,
                        ipad: 8977,
                        itouch: 5185
                    },
                    {
                        period: '2017 Q1',
                        iphone: 10697,
                        ipad: 4470,
                        itouch: 2038
                    },

                ],
                lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="{{ asset('BE/js/monthly.js') }}"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

            switch (window.location.protocol) {
                case 'http:':
                case 'https:':
                    // running on a server, should be good.
                    break;
                case 'file:':
                    alert('Just a heads-up, events will not work when run locally.');
            }

        });
    </script>
    <!-- //calendar -->

    {{-- xử lý về đơn hàng còn trong kho product  --}}
    <script type="text/javascript">
        $('.oder_detail').change(function() {
            var oder_status = $(this).val();
            var oder_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();

            //lay ra so luong
            quantity = [];
            $("input[name='product_sales_quantity']").each(function() {
                quantity.push($(this).val());
            });
            //lay ra product id
            oder_product_id = [];
            $("input[name='oder_product_id']").each(function() {
                oder_product_id.push($(this).val());
            });
            j = 0;
            for (i = 0; i < oder_product_id.length; i++) {
                //so luong khach dat
                var oder_qty = $('.oder_qty_' + oder_product_id[i]).val();
                //so luong ton kho
                var oder_qty_storage = $('.oder_qty_storage_' + oder_product_id[i]).val();

                if (parseInt(oder_qty) > parseInt(oder_qty_storage)) {
                    j = j + 1;
                    if (j == 1) {
                        alert('Số lượng bán trong kho không đủ');
                    }
                    $('.color_qty_' + oder_product_id[i]).css('background', '#000');
                }
            }
            if (j == 0) {

                $.ajax({
                    url: '{{ url('/update_oder_qty') }}',
                    method: 'POST',
                    data: {
                        oder_status: oder_status,
                        oder_id: oder_id,
                        quantity: quantity,
                        oder_product_id: oder_product_id,
                        _token: _token
                    },
                    success: function() {
                        alert('Thay đổi tình trạng đơn hàng thành công');
                        location.reload();
                    }
                });
            }
        })
    </script>


    {{-- cập nhật số lượng trong admin đơn hàng --}}
    <script type="text/javascript">
        $('.update_quantity_oder').click(function() {
            var oder_product_id = $(this).data('product_id');
            var oder_qty = $('.oder_qty_' + oder_product_id).val();
            var oder_code = $('.oder_code').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ url('/update_qty') }}',
                method: 'POST',
                data: {
                    _token: _token,
                    oder_product_id: oder_product_id,
                    oder_qty: oder_qty,
                    oder_code: oder_code
                },
                // dataType:"JSON",
                success: function(data) {

                    alert('Cập nhật số lượng thành công');

                    location.reload();
                }
            });
        });
    </script>
</body>

</html>
