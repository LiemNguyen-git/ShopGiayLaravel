@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			
			<div class="review-payment">
				<h5 style="margin: 50px 0;font-size: 25px;">Cảm ơn bạn đã mua sắm tại " thichgiay.ga ".</h5>
			</div>
			
			<a href="http://localhost/MyLaravel/trang-chu" class="active">

				<button type="Submit" class="btn btn-success">
											Tiếp tục mua sắm
											</button>


			</a>

				{{-- <button type="submit" class="btn btn-default">Tiếp tục mua sắm</button>
			</form> --}}
			<form action="{{URL::to('/order-place')}}" method="POST">
						{{ csrf_field() }}
			
			</form>
		</div>
	</section> <!--/#cart_items-->

@endsection