@extends('layout')
@section('content')

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản của bạn</h2>
						<form action="#">
							<input type="text" name="email_account" placeholder="Tên tài khoản" />
							<input type="password"  name="password_account" placeholder="Mật khẩu" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ đăng nhập
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký tài khoản mới</h2>
						<form action="{{URL::to('/add-user')}}" method="POST">
								{{csrf_field()}}

							<input type="text" name="user_name" placeholder="Họ tên"/>
							<input type="email" name="user_email" placeholder="Địa chỉ Email"/>
							<input type="password" name="user_password"  placeholder="Mật khẩu"/>
							<input type="text" name="user_phone"  placeholder="Số điện thoại"/>
							<input type="text" name="user_address"  placeholder="Địa chỉ"/>	
							<input type="text" name="user_sex"  placeholder="Giới tính"/>
							<input type="date" name="user_birthday"  placeholder="Ngày sinh"/>
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection