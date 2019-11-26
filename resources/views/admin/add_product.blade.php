@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
                        </header>
                        <div class="panel-body">
                            <?php
                                $message = Session::get('message');
                                if($message)//neu ton tai thi moi in ra message
                                    {
                                        echo $message;
                                        Session::put('message',null);
                                    }
                            ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    <!-- tu dong tao token -->
                                    {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputCategory">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="product_name" class="form-control" id="exampleInputproduct" placeholder="Tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCategory">Giá</label>
                                    <input type="text" class="form-control" name="product_price" class="form-control" id="exampleInputproduct" placeholder="Tên sản phẩm">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputCategory">Hình sản phẩm</label>
                                    <input type="file" class="form-control" name="product_image" class="form-control" id="exampleInputproduct">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputDesc_Category">Mô tả</label>
                                    <!-- chinh cho textarea co dinh khong dc keo dan ra -->
                                    <textarea style="resize: none" rows="4" class="form-control" name="product_desc" id="exampleInputDesc_product" placeholder="Mô tả sản phẩm"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputCategory">Ngày thêm</label>
                                    <input type="date" class="form-control" name="product_date" class="form-control" id="exampleInputproduct" placeholder="Ngày thêm" >
                                </div>

                                 <div class="form-group">
                                <label for="exampleInputView">Loại sản phẩm</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)

                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>

                                 <div class="form-group">
                                <label for="exampleInputView">Thương hiệu</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)

                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputCategory">Màu</label>
                                    <input type="text" class="form-control" name="product_color" class="form-control" id="exampleInputproduct" placeholder="Màu sản phẩm">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputCategory">Size giày</label>
                                    <input type="text" class="form-control" name="product_size" class="form-control" id="exampleInputproduct" placeholder="Kích thước sản phẩm">
                                </div>

                                <div class="form-group">
                                <label for="exampleInputView">Hiển thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="1">Ẩn</option>
                                        <option value="0">Hiện</option>
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection