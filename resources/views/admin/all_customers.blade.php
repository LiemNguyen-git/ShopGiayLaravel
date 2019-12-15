@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách khách hàng
    </div>
    <div class="row w3-res-tb">
     
      <div class="col-sm-8">
      </div>
      <div class="col-sm-3">
        
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
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Mật khẩu</th>
            <th>Địa chỉ</th>
            

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

          @foreach($all_customers as $key => $customer)

          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $customer->customer_name }}</td>
            <td>{{ $customer->customer_email }}</td>
            <td>{{ $customer->customer_phone }}</td>
            <td>{{ $customer->customer_password }}</td>
            <td>{{ $customer->customer_address }}</td>

            
            <td>
              
    <!-- pencil-square co nghia la  -->
    <!-- onclick kiem tra xoa -->
              <a onclick="return confirm('Bạn có chắc muốn xóa khách hàng này không?')" href="{{URL::to('/delete-customer/'.$customer->customer_id)}}" class="active" ui-toggle-class="">
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