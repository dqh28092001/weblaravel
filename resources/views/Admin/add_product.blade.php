@extends('Admin.admin_header')
@section('dashboard')


<!-- page start-->
<!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Sản Phẩm
            </header>
            <div class="panel-body">
                <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="text-alert">'.$message.'</span>' ;
                        Session::put('message'.null);
                    }
	            ?>
                <div class="position-center">
                    <form role="form" action="{{ URL::to('/save_product') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                            <input type="text" data-validation="length" data-validation-length="min1"
                            data-validation-error-msg="Tên Sản Phẩm Không Được Để Trống"
                            name="product_name" class="form-control" id="exampleInputEmail1"
                                placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                            <input  data-validation="number" data-validation-error-msg="Giá Sản Phẩm Không Được Để Trống" type="text" name="product_price" class="form-control" id="exampleInputEmail1"
                                placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
                            <textarea style="resize:none" rows="8" class="form-control" id="exampleInputPassword1"
                                name="product_desc" placeholder="Mô tả sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                            <textarea style="resize:none" rows="8" class="form-control" id="exampleInputPassword1"
                                name="product_content" placeholder="Nội dung sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh Mục Sản Phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)

                                <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương Hiệu Sản Phẩm</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach($brand_product as $key => $brand)

                                <option value="{{ $brand->brand_id}}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển Thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiện Thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_product" class="btn btn-info">Thêm Sản Phẩm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
