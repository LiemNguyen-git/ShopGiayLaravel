@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
    </div>
    <div class="row w3-res-tb">
      {{-- <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Chọn nhiều</option>
          <option value="1">Xóa đã chọn</option>
          <option value="2">Sửa tất cả</option>
          <option value="3">Xuất</option>
        </select>
        <button class="btn btn-sm btn-default">Áp dụng</button>                
      </div> --}}
      <div class="col-sm-8">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Tìm kiếm">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Tìm</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
<!-- thong bao kich hoat danh muc -->
      <?php
              $message = Session::get('message');
              if($message)//neu ton tai thi moi in ra message
                  {
                      echo $message;
                      Session::put('message',null);
                  }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên khách hàng</th>
            <th>Tổng giá tiền</th>
            <th>Tình trạng đơn hàng</th>
            {{-- <th>Địa chỉ</th>
            <th>Số điện thoại</th> --}}
            <th>Hiển thị</th>
            

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

          @foreach($all_order as $key => $order)

          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $order->customer_name }}</td>
            <td>{{ $order->order_total }}</td>
            <td>{{ $order->order_status }}</td>
            {{-- <td>{{ $order->customer_address }}</td>
            <td>{{ $order->customer_phone }}</td> --}}

            
            <td>
              <a href="{{URL::to('/view-order/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i> 
    <!-- pencil-square co nghia la  -->
    <!-- onclick kiem tra xoa -->
              <a onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không?')" href="{{URL::to('/delete-order/'.$order->order_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
            
          </tr>

          @endforeach

        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm"></small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection