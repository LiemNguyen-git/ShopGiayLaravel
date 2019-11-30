@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->


			<div class="register-req">
				<p>Vui lòng đăng ký hoặc đăng nhập để thanh toán giỏ hàng.</p>
			</div><!--/register-req-->
			<form>
				<div class="shopper-informations">
					<div class="row">
						
						<div class="col-sm-10 clearfix">
							<div class="bill-to">
								<p>Nhập thông tin nhận hàng</p>
								<div class="form-one">
									<form action="{{URL::to('/save-checkout-customer')}}" method="POST">
										{{csrf_field()}}
										<input type="text" name="shipping_email" placeholder="Email*">
										<input type="text" name="shipping_name" placeholder="Họ và tên*">
										<input type="text" name="shipping_address" placeholder="Địa chỉ nhận hàng *">
										<input type="text" name="shipping_phone" placeholder="Số điện thoại *">
										<textarea name="shipping_notes" placeholder="Ghi chú đơn hàng của bạn." rows="10"></textarea>
										<input type="submit" name="send_order" value="Thanh toán" class="btn btn-primary btn-sm">
									</form>
								</div>
								
							</div>
						</div>
						{{-- <div class="col-sm-4">
							<div class="order-message">
								<p>Ghi chú gửi hàng</p>
								
								
							</div>	
						</div>	 --}}				
					</div>
				</div>
			</form>
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
			</div>

			
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->

@endsection