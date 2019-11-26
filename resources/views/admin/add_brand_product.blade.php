@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm thương hiệu giày
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
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                                    <!-- tu dong tao token -->
                                    {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputCategory">Tên thương hiệu</label>
                                    <input type="text" class="form-control" name="brand_product_name" class="form-control" id="exampleInputCategory" placeholder="Tên thương hiệu">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputDesc_Category">Mô tả thương hiệu</label>
                                    <!-- chinh cho textarea co dinh khong dc keo dan ra -->
                                    <textarea style="resize: none" rows="6" class="form-control" name="brand_product_desc" id="exampleInputDesc_Category" placeholder="Mô tả thương hiệu"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputCategory">Ngày thêm</label>
                                    <input type="date" class="form-control" name="brand_product_date" class="form-control" id="exampleInputCategory" placeholder="Ngày thêm">
                                </div>

                                <div class="form-group">
                                <label for="exampleInputView">Hiển thị</label>
                                    <select name="brand_product_status" class="form-control input-sm m-bot15">
                                        <option value="1">Ẩn</option>
                                        <option value="0">Hiển thị</option>
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection