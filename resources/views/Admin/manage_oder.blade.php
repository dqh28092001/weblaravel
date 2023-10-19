@extends('Admin.admin_header')
@section('dashboard')


<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Đơn Hàng
    </div>
    <div class="table-responsive">
      <?php
        $message = Session::get('message');
          if ($message) {
            echo '<span class="text-alert">'.$message.'</span>' ;
            Session::put('message'.null);
      }
	    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>

            <th>Thứ Tự</th>
            <th>Mã Đơn Hàng</th>
            <th>Tình Trạng Đơn Hàng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @php
                $i = 0 ;
            @endphp
          @foreach($oder as $key => $ord)
@php
    $i++;
@endphp
          <tr>
            <td><label><i>{{ $i }}</i></label></td>
            <td>{{ $ord->oder_code }} </td>
            <td>
                @if ( $ord->oder_status == 1)
                    Đơn Hàng Mới
                    @else
                    Đã xử lý
                @endif
                </td>


            <td>
              <a href="{{ URL::to('/view_oder/'.$ord->oder_code) }}" class="active styling-edit"
                ui-toggle-class=""><i class="fa fa-eye text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn Có Chắc Chắn Muốn Xóa Thương Hiệu Này Không?')"
                href="{{ URL::to('/delete_oder/'.$ord->oder_code) }}" class="active styling-edit"
                ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>

  </div>
</div>

@endsection
