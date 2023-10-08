@extends('Admin.admin_header')
@section('dashboard')


<!-- page start-->
<!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập Nhật Danh Mục Sản Phẩm
            </header>
           
                <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="text-alert">'.$message.'</span>' ;
                        Session::put('message'.null);
                    }
	            ?>
                 <div class="panel-body">
                    @foreach($edit_category_product as $key => $edit_value)
                        
                <div class="position-center">
                    <form role="form" action="{{ URL::to('/update_category_product/'.$edit_value->category_id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Danh Mục</label>
                            <input type="text" value="{{ $edit_value->category_name }}" name="category_product_name" class="form-control" id="exampleInputEmail1"
                                placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô Tả Danh Mục</label>
                            <textarea style="resize:none" rows="8" class="form-control" id="exampleInputPassword1"
                                name="category_product_desc">{{ $edit_value->category_desc }}</textarea>
                        </div>
                        

                        <button type="submit" name="update_category_product" class="btn btn-info">Cập Nhật Danh Mục</button>
                    </form>
                </div>
                @endforeach

            </div>
        </section>
        
    </div>
</div>

@endsection