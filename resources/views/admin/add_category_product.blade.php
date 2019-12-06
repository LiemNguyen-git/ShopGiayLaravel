@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm loại sản phẩm
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
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                                    <!-- tu dong tao token -->
                                    {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputCategory">Tên loại</label>
                                    <input type="text" class="form-control" name="category_product_name" class="form-control" id="exampleInputCategory" placeholder="Tên danh mục">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputDesc_Category">Mô tả loại giày</label>
                                    <!-- chinh cho textarea co dinh khong dc keo dan ra -->
                                    <textarea style="resize: none" rows="6" class="form-control" name="category_product_desc" id="exampleInputDesc_Category" placeholder="Mô tả danh mục"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputCategory">Ngày thêm</label>
                                    <input type="date" class="form-control" name="category_product_date" class="form-control" id="exampleInputCategory" placeholder="Tên danh mục">
                                </div>

                                <div class="form-group">
                                <label for="exampleInputView">Hiển thị</label>
                                    <select name="category_product_status" class="form-control input-sm m-bot15">
                                        <option value="1">Ẩn</option>
                                        <option value="0">Hiện</option>
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm loại giày</button>
                            </form>
                            </div>

                        </div>
                    </section>
                    
            </div>
@endsection