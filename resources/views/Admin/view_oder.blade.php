@extends('Admin.admin_header')
@section('dashboard')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông Tin Khách Hàng Đăng Nhập
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message' . null);
                }
                ?>
                <table class="table table-striped b-t b-light" style="text-align: center">
                    <thead>
                        <tr>
                            <th style="text-align: center">Tên Khách Hàng</th>
                            <th style="text-align: center">Email</th>
                            <th style="text-align: center">Số Điện Thoại</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->customer_email }}</td>
                            <td>{{ $customer->customer_phone }}</td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông Tin Vận Chuyển Hàng Hóa
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message' . null);
                }
                ?>
                <table class="table table-striped b-t b-light" style="text-align: center">
                    <thead>
                        <tr>
                            <th style="text-align: center">Tên Người Nhận Hàng</th>
                            <th style="text-align: center">Địa Chỉ</th>
                            <th style="text-align: center">Số Điện Thoại</th>
                            <th style="text-align: center">Email</th>
                            <th style="text-align: center">Ghi Chú</th>
                            <th style="text-align: center">Hình Thức Thanh Toán</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $shipping->shipping_name }}</td>
                            <td>{{ $shipping->shipping_address }}</td>
                            <td>{{ $shipping->shipping_phone }}</td>
                            <td>{{ $shipping->shipping_email }}</td>
                            <td>{{ $shipping->shipping_note }}</td>
                            <td>
                                @if ($shipping->shipping_method == 0)
                                    Chuyển Khoản
                                @else
                                    Tiền Mặt
                                @endif
                            </td>
                        </tr>
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
                <table class="table table-striped b-t b-light" style="text-align: center">
                    <thead>
                        <tr>
                            <th style="text-align: center"></th>
                            <th style="text-align: center">Tên Sản Phẩm</th>
                            <th style="text-align: center">Số Lượng Kho Còn</th>
                            <th style="text-align: center">Số Lượng</th>
                            <th style="text-align: center">Giá </th>
                            <th style="text-align: center">Thành Tiền</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                            $total = 0;
                        @endphp
                        @foreach ($oder_detail as $detail)
                            @php
                                $i++;
                                $subtotal = $detail->product_sales_quantity * $detail->product_price;
                                $total += $subtotal;
                            @endphp
                            <tr class="color_qty_{{$detail->product_id}}">
                                <td>{{ $i }}</td>
                                <td>{{ $detail->product_name }} </td>
                                <td>{{ $detail->product->product_quantity }} </td>
                                <td>

                                    <input type="number" min="1" {{$oder_status==2 ? 'disabled' : ''}} class="oder_qty_{{$detail->product_id}}" value="{{$detail->product_sales_quantity}}" name="product_sales_quantity">

                                    <input type="hidden" name="oder_qty_storage" class="oder_qty_storage_{{$detail->product_id}}" value="{{$detail->product->product_quantity}}">

                                    <input type="hidden" name="oder_code" class="oder_code" value="{{$detail->oder_code}}">

                                    <input type="hidden" name="oder_product_id" class="oder_product_id" value="{{$detail->product_id}}">

                                   @if($oder_status!=2)

                                    <button class="btn btn-default update_quantity_oder" data-product_id="{{$detail->product_id}}" name="update_quantity_oder">Cập nhật</button>

                                  @endif

                                  </td>
                                <td>{{ number_format($detail->product_price, 0, ',', ',') }}</td>
                                <td>{{ number_format($subtotal, 0, ',', ',') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">
                                @foreach ($oder as $key => $or)
                                    @if ($or->oder_status == 1)
                                        <form action="">
                                            @csrf
                                            <select class="form-control oder_detail">
                                                <option>-----------------Chọn Hình Thức Đơn Hàng-------------------</option>
                                                <option id="{{ $or->oder_id }}" value="1" selected>Chưa Xử Lý
                                                </option>
                                                <option id="{{ $or->oder_id }}" value="2">Đã Xử Lý - Đã Giao hàng
                                                </option>
                                                <option id="{{ $or->oder_id }}" value="3">Hủy Đơn Hàng - Tạm Giữ
                                                </option>
                                            </select>
                                        </form>
                                        @csrf
                                    @elseif ($or->oder_status == 2)
                                        <form action="">
                                            @csrf

                                            <select class="form-control oder_detail">
                                                <option>-----------------Chọn Hình Thức Đơn Hàng-------------------</option>
                                                <option id="{{ $or->oder_id }}" value="1">Chưa Xử Lý</option>
                                                <option id="{{ $or->oder_id }}" value="2" selected>Đã Xử Lý - Đã Giao
                                                    hàng</option>
                                                <option id="{{ $or->oder_id }}" value="3">Hủy Đơn Hàng - Tạm Giữ
                                                </option>
                                            </select>
                                        </form>
                                    @else
                                        <form action="">
                                            @csrf

                                            <select class="form-control oder_detail">
                                                <option>-----------------Chọn Hình Thức Đơn Hàng-------------------</option>
                                                <option id="{{ $or->oder_id }}" value="1">Chưa Xử Lý</option>
                                                <option id="{{ $or->oder_id }}" value="2">Đã Xử Lý - Đã Giao hàng
                                                </option>
                                                <option id="{{ $or->oder_id }}" value="3" selected>Hủy Đơn Hàng - Tạm
                                                    Giữ</option>
                                            </select>
                                        </form>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-5 text-center">
                    </div>
                    <div class="col-sm-7 text-right text-center-xs" style="padding-right: 9pc;">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <small class="text-muted inline m-t-sm m-b-sm" style="font-weight:900 ; color:#ca1515 ">Tổng
                                Tiền : {{ number_format($total, 0, ',', ',') }}</small>

                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
