@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
	

						@foreach($category_name as $key => $name)
						<h2 class="title text-center" style="color: #04B4AE;">{{$name->category_name}} </h2>
						@endforeach
						@foreach($category_by_id as $key => $product)

						<form action="{{URL::to('/save-cart')}}" method="POST">
									{{ csrf_field() }}

						<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">

						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />

											<h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
											<p>{{$product->product_name}}</p>
											<input type="hidden" name="qty" type="number" min="1" value="1" /> 
											<input name="productid_hidden" type="hidden" value="{{$product->product_id}}" />
											<button type="Submit" class="btn btn-fefault cart"><i class="fa fa-shopping-cart"></i>
											Thêm vào giỏ hàng
											</button>
												
										</div>
										
								</div>
								{{-- <div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
									</ul>
								</div> --}}
							</div>
						</div>
						</a>
					</form>
						@endforeach
						
					</div><!--features_items-->
<!--/recommended_items-->
@endsection