@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
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
      </div>
      <div class="col-sm-4">
      </div> --}}
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Tìm kiếm">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button" >Tìm</button>
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
            <th>Tên sản phẩm</th>
            <th>Gía</th>
            <th>Hình sản phẩm</th>
            <th>Loại giày</th>
            <th>Thương hiệu</th>
            <th>Màu</th>
            <th>Size giày</th>
            <th>Ngày thêm</th>
            <th>Hiển thị</th>
            
           
            <th style="width:30px;"></th>

          </tr>
        </thead>
        <tbody>

          @foreach($all_product as $key => $product)

          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->product_price }}</td>
            <td><img src="public/uploads/product/{{ $product->product_image }}" height="100" width="100"></td>
            <td>{{ $product->category_name }}</td>
            <td>{{ $product->brand_name }}</td>
            <td>{{ $product->product_color }}</td>
            <td>{{ $product->product_size }}</td>
            <td>{{ $product->created_at }}</td>
            <td><span class="text-ellipsis">
    <!-- kich hoat san pham -->
                <?php

                  if($product->product_status==0)
                    {
                ?>
                      <a href="{{URL::to('/unactive-product/'.$product->product_id)}}"> <span class="fa-thumb-styling fa fa-thumbs-up"></span> </a>
                <?php
                    }
                  else
                    {
                ?>
                      <a href="{{URL::to('/active-product/'.$product->product_id)}}"> <span class="fa-thumb-styling fa fa-thumbs-down"></span> </a>
                <?php
                    }

                ?>

            </span>
          </td>
          
            <td>
              <a href="{{URL::to('/edit-product/'.$product->product_id)}}" class="active" ui-toggle-class="">
    <!-- pencil-square co nghia la xoa -->
                <i class="fa fa-pencil-square-o text-success text-active"></i> 
    
    <!-- onclick kiem tra xoa -->
              <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm giày này không?')" href="{{URL::to('/delete-product/'.$product->product_id)}}" class="active" ui-toggle-class="">
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