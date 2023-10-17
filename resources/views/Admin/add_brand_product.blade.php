@extends('Admin.admin_header')
@section('dashboard')


<!-- page start-->
<!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Thương Hiệu Sản Phẩm
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
                    <form role="form" action="{{ URL::to('/save_brand_product') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Thương Hiệu</label>
                            <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1"
                                placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="brand_slug" class="form-control" id="exampleInputEmail1"
                                placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô Tả Thương Hiệu</label>
                            <textarea style="resize:none" rows="8" class="form-control" id="exampleInputPassword1"
                                name="brand_product_desc" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển Thị</label>
                            <select name="brand_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiện Thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm Thương Hiệu</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
