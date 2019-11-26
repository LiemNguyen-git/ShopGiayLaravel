@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật thương hiệu giày
                        </header>
                        
                            <?php
                                $message = Session::get('message');
                                if($message)//neu ton tai thi moi in ra message
                                    {
                                        echo $message;
                                        Session::put('message',null);
                                    }
                            ?>
                            <div class="panel-body">
                                @foreach($edit_brand_product as $key => $edit_value)
                            <div class="position-center">
                                <!-- update danh muc theo id -->
                                <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="post">
                                    <!-- tu dong tao token -->
                                    {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputbrand">Tên thương hiệu</label>
                                    <input type="text" value="{{$edit_value->brand_name}}" class="form-control" name="brand_product_name" class="form-control" id="exampleInputbrand" placeholder="Tên danh mục">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputDesc_brand">Mô tả thương hiệu</label>
                                    <!-- chinh cho textarea co dinh khong dc keo dan ra -->
                                    <textarea style="resize: none" rows="6" class="form-control" name="brand_product_desc" id="exampleInputDesc_brand">{{$edit_value->brand_desc}}</textarea>
                                </div>
                                
                                 <div class="form-group">
                                    <label for="exampleInputCategory">Ngày thêm</label>
                                    <input type="date" class="form-control" name="brand_product_date" class="form-control" id="exampleInputCategory" placeholder="Ngày thêm">
                                </div>

                                <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật danh mục</button>
                            </form>
                            </div>

                            @endforeach
                        </div>

                    </section>

            </div>
@endsection