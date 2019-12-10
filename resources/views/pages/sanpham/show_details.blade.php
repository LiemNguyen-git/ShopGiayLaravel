@extends('layout')
@section('content')
@foreach($details_product as $key => $value)

					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('/public/uploads/product/'.$value->product_image)}}" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										
										<div class="item active">
										  <a href=""><img src="{{URL::to('public/frontend/images/giaytreem1.jpg')}}" height="80" width="80" alt=""></a>
										  <a href=""><img src="{{URL::to('public/frontend/images/giaytreem2.jpg')}}" height="80" width="80" alt=""></a>
										  <a href=""><img src="{{URL::to('public/frontend/images/giaytreem3.jpg')}}" height="80" width="80" alt=""></a>
										</div>
									
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$value->product_name}}</h2>
								<p>Mã sản phẩm: {{$value->product_id}}</p>
								<img src="images/product-details/rating.png" alt="" />

								<form action="{{URL::to('/save-cart')}}" method="POST">
									{{ csrf_field() }}
								

								<span>
									<span>{{number_format($value->product_price).'VNĐ'}}</span>
									<label>Số lượng:</label>
									<input name="qty" type="number" min="1" value="1" />
									<input name="productid_hidden" type="hidden" value="{{$value->product_id}}" />
									<button type="Submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm vào giỏ hàng
									</button>
								</span>

								</form>

								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Điều kiện:</b> Mới 100%</p>
								<p><b>Loại sản phẩm:</b> {{$value->category_name}}</p>
								<p><b>Thương hiệu:</b> {{$value->brand_name}}</p>
								<p><b>Màu:</b> {{$value->product_color}}</p>
								<p><b>Kích thước:</b> {{$value->product_size}}</p>
								
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->



					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
								
								<li ><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>{!!$value->product_desc!!}</p>
							</div>

							
							<div class="tab-pane fade " id="reviews" >
								<div class="col-sm-12">
									{{-- <ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul> --}}
									<p>Giày hay giầy là một vật dụng đi vào bàn chân con người để bảo vệ và làm êm chân trong khi thực hiện các hoạt động khác nhau. Giày cũng được sử dụng như một món đồ trang trí.

									Thiết kế của giày đã đa dạng và phong phú vô cùng theo thời gian, văn hoá và mục đích sử dụng. Ngoài ra thời trang cũng chi phối nhiều yếu tố thiết kế, chẳng hạn như giày có gót rất cao (giày cao gót) hay có gót phẳng (giày thể thao). Giày dép hiện đại rất khác nhau về mục đích sử dụng, phong cách và giá thành. Dép đơn giản có thể rất mỏng và chỉ bao gồm một dây duy nhất trong khi giày thời trang hiện đại có thể được làm từ các vật liệu rất tốn kém, kết cấu phức tạp và giá hàng ngàn đôla một đôi. Các loại giày khác cho các mục đích sử dụng khác như giày leo núi hay giày trượt tuyết,...

									Giày có truyền thống được làm từ da, gỗ, vải,... nhưng đang ngày càng được làm từ cao su, nhựa và các vật liệu hoá dầu khác.</p>
									
										

									<form action="" method="">
											
										
										{{-- <span>
											<input type="text" name="comment_name" value="" />
											<input type="email" name="comment_email" placeholder="Email Address"/>
										</span> --}}
										<textarea name=""  placeholder="Nhập bình luận của bạn." rows="3" ></textarea>
										
										<button type="button" class="btn btn-default pull-right " >
											Submit
										</button>
										
									</form>
									
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
@endforeach					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center" style="color: #04B4AE;">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	

									@foreach($related as $key => $relate)

									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{URL::to('public/uploads/product/'.$relate->product_image)}}"  alt="" />
													<h2>{{number_format($relate->product_price).' '.'VNĐ'}}</h2>
													<p>{{$relate->product_name}}</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									
								</div>

							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
@endsection	