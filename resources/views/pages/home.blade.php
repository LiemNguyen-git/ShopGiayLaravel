@extends('layout')
@section('content')

<!--features_items-->
<div class="features_items">
						<h2 class="title text-center" style="color: #04B4AE;">SẢN PHẨM MỚI NHẤT</h2>

						@foreach($all_product as $key => $product)

						<form action="{{URL::to('/save-cart')}}" method="POST">		
							{{ csrf_field() }}

						<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">

						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
						</a>
											<h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
											<p>{{$product->product_name}}</p>
											<input type="hidden" name="qty" type="number" min="1" value="1" /> 
											<input name="productid_hidden" type="hidden" value="{{$product->product_id}}" />
												<button type="Submit" class="btn btn-fefault cart">
											<i class="fa fa-shopping-cart"></i>
												Thêm vào giỏ hàng
											</button>
										
										</div>	
								</div>
							</div>
						</div>
						
						</a>
						</form>

						@endforeach
						
</div>
					<!--features_items-->


@endsection