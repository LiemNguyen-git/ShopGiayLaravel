@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="http://localhost/MyLaravel/trang-chu">Trang chủ</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>

			<div class="register-req">
				<p style="width: 200px;">Vui lòng đăng nhập hoặc đăng ký nếu chưa có tài khoản để có thể mua và xem lịch sử mua hàng.</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Điền thông tin nhận hàng</p>
							<div class="form-one">
								<form action="{{URL::to('/save-checkout-customer')}}" method="POST">
									{{csrf_field()}}
									
									<input type="text" name="shipping_email" placeholder="Email*">
									<input type="text" name="shipping_name" placeholder="Họ và tên*">
									<input type="text" name="shipping_address" placeholder="Địa chỉ">
									<input type="text" name="shipping_phone" placeholder="Số điện thoại*">
									<textarea name="shipping_notes" placeholder="Ghi chú nhận hàng" rows="6"></textarea>

									<input type="submit" value="Thanh toán" name="send_order" class="btn btn-primary btn-sm">

								</form>
							</div>
							
						</div>
					</div>			
				</div>
			</div>
			{{-- <div class="review-payment">
				<h2>Xem lại giở hàng</h2>
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
		</div> --}}
	</section> <!--/#cart_items-->

@endsection