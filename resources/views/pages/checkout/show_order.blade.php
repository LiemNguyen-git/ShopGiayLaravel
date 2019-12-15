@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="http://localhost/MyLaravel/trang-chu">Trang chủ</a></li>
				  <li class="active" style="font-size: 50px;">Đơn hàng bạn đã đặt.</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
					$content = Cart::content();
					
				?>
				<table class="table table-condensed" style="width: 700px;">
					<thead>
						<tr class="cart_menu" >
							<td class="image"  width="250">Hình ảnh</td>
							
							<td class="description"  width="100"></td>
							
							<td class="price"  width="100">Giá</td>
							{{-- <td class="size">Kích thước</td>
							<td class="color">Màu</td> --}}
							<td class="quantity"  width="150">Số lượng</td>
							<td class="total" width="100">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="100" alt="" /></a>
							</td>
							
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>{{$v_content->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' '.'VNĐ'}}</p>
							</td>
							
							<td class="cart_quantity">
								<div class="cart_quantity_button">

									<form action="{{URL::to('/')}}" method="">

										{{ csrf_field() }}
									
									<input class="cart_quantity_input" style="width:80px;" type="text" name="cart_quantity" value="{{$v_content->qty}}" {{-- autocomplete="off" size="2" --}}>
									
									<input type="hidden" name="rowId_cart" value="{{$v_content->rowId}}" class="form-control">
									{{-- <input type="submit" name="update_qty" value="Cập nhật" class="btn_default btn-sm"> --}}
									</form>

								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									
										<?php

										$subtotal= $v_content->price * $v_content->qty;
										echo number_format($subtotal).' '.'VNĐ';

										?>

								</p>
							</td>
							{{--  --}}
						</tr>

						@endforeach
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Tổng hóa đơn của bạn là:</h3>
				{{-- <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p> --}}
			</div>
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng giỏ hàng <span>{{Cart::total().' '.'VNĐ'}}</span></li>
							<li>Thuế <span>{{Cart::tax().' '.'VNĐ'}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span>{{Cart::total().' '.'VNĐ'}}</span></li>
						</ul>
							
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection