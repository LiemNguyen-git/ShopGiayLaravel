@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
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

                                @foreach($edit_product as $key => $product)

                                <form role="form" action="{{URL::to('/update-product/'.$product->product_id)}}" method="post" enctype="multipart/form-data">
                                    <!-- tu dong tao token -->
                                    {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputCategory">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="product_name" class="form-control" value="{{$product->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCategory">Giá sản phẩm</label>
                                    <input type="text" value="{{$product->product_price}}" class="form-control" name="product_price" class="form-control"  >

                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputCategory">Hình ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="product_image" class="form-control">
                                    <img src="{{URL::to('/public/uploads/product/'.$product->product_image)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputDesc_Category">Mô tả sản phẩm</label>
                                    <!-- chinh cho textarea co dinh khong dc keo dan ra -->
                                    <textarea style="resize: none" rows="4" class="form-control" name="product_desc" id="exampleInputDesc_product" placeholder="Mô tả sản phẩm">{{$product->product_desc}}</textarea>
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputCategory">Ngày thêm</label>
                                    <textareatype="date" class="form-control" name="product_date" class="form-control" id="exampleInputproduct" placeholder="Ngày thêm"> {{ $product->created_at }}
                                    </textarea> 
                                
                                </div>

                                 <div class="form-group">
                                <label for="exampleInputView">Loại sản phẩm</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)

                                        @if($cate->category_id == $product->category_id)

                                        <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @else
                                         <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                 <div class="form-group">
                                <label for="exampleInputView">Thương hiệu</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                       
                                        @if($cate->category_id == $product->category_id)
                                        <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        
                                        @else
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endif
                                        
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputCategory">Màu</label>
                                    <input type="text" class="form-control" name="product_color" class="form-control" id="exampleInputproduct" placeholder="Màu sản phẩm" value="{{$product->product_color}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputCategory">Size giày</label>
                                    <input type="text" class="form-control" name="product_size" class="form-control" id="exampleInputproduct" placeholder="Kích thước sản phẩm" value="{{$product->product_size}}">
                                </div>

                                <div class="form-group">
                                <label for="exampleInputView">Hiển thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="1">Ẩn</option>
                                        <option value="0">Hiện</option>
                                    </select>
                                </div>
                                
                                <button type="submit" name="update_product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>

                            @endforeach

                            </div>

                        </div>
                    </section>

            </div>
@endsection