@extends('Admin.admin_header')
@section('dashboard')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông Tin Khách Hàng
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message' . null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên Khách Hàng</th>
                            <th>Email</th>
                            <th>Số Điện Thoại</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($oder_by_id as $order_client)
                            <tr>
                                <td>{{ $order_client->customer_name }}</td>
                                <td>{{ $order_client->customer_email }}</td>
                                <td>{{ $order_client->customer_phone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông Tin Vận Chuyển
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message' . null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên Người Nhận Hàng</th>
                            <th>Địa Chỉ</th>
                            <th>Số Điện Thoại</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($oder_by_id as $order_shipping)
                            <tr>
                                <td>{{ $order_shipping->shipping_name }}</td>
                                <td>{{ $order_shipping->shipping_address }}</td>
                                <td>{{ $order_shipping->shipping_phone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br><br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt Kê Chi Tiết Đơn Hàng
            </div>
            <div class="row w3-res-tb">
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message' . null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá </th>
                            <th>Thành Tiền</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($oder_by_id as $order_detail)
                            <tr>
                                <td>{{ $order_detail->product_name }} </td>
                                <td>{{ $order_detail->product_sales_quantity }}</td>
                                <td>{{ number_format($order_detail->product_price, 0, ',', ',') }}</td>
                                <td>{{ number_format($order_detail->product_sales_quantity * $order_detail->product_price, 0, ',', ',') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-5 text-center">
                    </div>
                    <div class="col-sm-7 text-right text-center-xs" style="padding-right: 9pc;">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <small class="text-muted inline m-t-sm m-b-sm"  style="font-weight:900 ; color:#ca1515 ">Tổng Tiền : {{ $order_detail->oder_total }}</small>

                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
