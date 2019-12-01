@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>

			<div class="review-payment">
				<h2>Xem lại giỏ hàng của bạn</h2>
			</div>

			<div class="table-responsive cart_info">
				<?php
					$content = Cart::content();
					
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu" >
							<td class="image">Hình ảnh</td>
							<td class="description"></td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
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

									<form action="{{URL::to('/update-cart-quantity')}}" method="POST">

										{{ csrf_field() }}
									
									<input class="cart_quantity_input" style="width:80px;" type="text" name="cart_quantity" value="{{$v_content->qty}}" {{-- autocomplete="off" size="2" --}}>
									
									<input type="hidden" name="rowId_cart" value="{{$v_content->rowId}}" class="form-control">
									<input type="submit" name="update_qty" value="Cập nhật" class="btn_default btn-sm">
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
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>

						@endforeach
						
					</tbody>
				</table>
			</div>
			
			<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng giỏ hàng <span>{{Cart::total().' '.'VNĐ'}}</span></li>
							<li>Thuế <span>{{Cart::tax().' '.'VNĐ'}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span>{{Cart::total().' '.'VNĐ'}}</span></li>
						</ul>
							{{-- <a class="btn btn-default update" href="">Update</a> --}}
							
							
					</div>
			</div>

			<h4 style="margin: 50px 0;font-size: 25px;">Chọn hình thức thanh toán</h4>
			<form action="{{URL::to('/order-place')}}" method="POST">
						{{ csrf_field() }}
			<div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Thanh toán bằng thẻ ATM</label>
					</span><br/>
					<span>
						<label><input name="payment_option" value="2" type="checkbox"> Trả tiền khi nhận được hàng</label>
					</span><br/>
					<span>
						<label><input name="payment_option" value="3" type="checkbox"> Thanh toán qua ví điện tử Momo</label>
					</span><br/>
					<span style="margin: 100px">
					<input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm">
				   </span>
				</div>
			</form>
		</div>
	</section> <!--/#cart_items-->

@endsection