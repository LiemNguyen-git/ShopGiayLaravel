 <!DOCTYPE html>
<html lang="en">

<head>
	

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Trang chủ | Thích Giày</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precompoassetsed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body background="control-carousel" style="background-image:url('public/frontend/images/backgound2.jpg'); background-repeat: no-repeat; background-size: cover;">
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li>Liên hệ: </li>
								<li><a href="tel:0944408844"><i class="fa fa-phone" ></i> 0944408844</a></li>
								<li><a href="mailto:liem.nguyen@gmail.com"><i class="fa fa-envelope"></i> liem.nguyen@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								
								<li><a>Fanpage: </a></li>
								<li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
								
								<li><a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a></li>
								
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="http://localhost/MyLaravel/trang-chu"><img src="{{('public/frontend/images/logo3.png')}}" height="50px" width="150px" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							{{-- <div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div> --}}
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								{{-- <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-user"></i> Tài khoản</a></li> --}}
								<?php
									$customer_id = Session::get('customer_id');
									$order_id = Session::get('order_id');
									if($customer_id != NULL)
									

								?>
								<li><a href="{{URL::to('/show-order')}}"><i class="fa fa-shopping-cart"></i> Xem lại đơn hàng </a></li>
								
								<?php
									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
									if($customer_id != NULL && $shipping_id == NULL)
									{

								?>
								<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán </a></li>
								

								<?php
									}
									elseif($customer_id != NULL && $shipping_id != NULL)
									{
								?>

								<li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>

								<?php
								}else{
								?>			
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
								}
								?>	

								
								<li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>

								

								<?php
									$customer_id = Session::get('customer_id');
									if($customer_id != NULL)
									{

								?>
								<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i>{{$customer_name = Session::get('customer_name')}}(Đăng xuất) </a></li>
									{{-- {{$customer_id=Session::get('customer_name')}}
								@if('customer_id'!=NUll)
								<li></li>
								@endif
								<li> </li> --}}
								<?php
									}else{
								?>

								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập </a></li>

								<?php
								}
								?>		

							</ul>
								
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
								{{-- <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Giày nam</a></li>
                                        <li><a href="shop.html">Giày nữ</a></li>
										
                                    </ul>
                                </li>  --}}
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Xu hướng nam</a></li>
										<li><a href="blog-single.html">Xu hướng nữ</a></li>
                                    </ul>
                                </li> 
								{{-- <li><a href="{{URL::to('/show-cart')}}">Giỏ hàng</a></li>
								<li><a href="contact-us.html">Liên hệ</a></li> --}}
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form action="{{URL::to('/tim-kiem')}}" method="POST">
							{{csrf_field()}}
						<div class="search_box pull-right">
							<input type="text" name="keywords_search" placeholder="Nhập sản phẩm cần tìm"/>
							<input type="submit" style="margin-top: 0; color:#GGG;width:60px;" name="search_items" class="btn btn-info btn-sm" value="Tìm"  />
						</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								{{-- <div class="col-sm-6">
									<h1><span></span>SHOPPING WITH</h1>
									<h2>THICHGIAY.GA</h2>
									<p>Giá trị sống của bạn là nhiệm vụ của chúng tôi. </p>
									
								</div> --}}
								<div class="col-sm-6">
								<img src="{{('public/frontend/images/baner1.jpg')}}" style="height:500px; max-width: fit-content;" class="girl img-responsive" alt="" />
								
								</div>
							</div>
							<div class="item">
								{{-- <div class="col-sm-6">
									<h1><span></span>SHOPPING WITH</h1>
									<h2>THICHGIAY.GA</h2>
									<p>Thể hiện phong cách đậm chất dân chơi. </p>
								
								</div> --}}
								<div class="col-sm-6">
									<img src="{{('public/frontend/images/baner2.jpg')}}" style="height:500px; max-width: fit-content;" class="girl img-responsive" alt="" />
									
								</div>
							</div>
							
							<div class="item">
								{{-- <div class="col-sm-6">
									<h1><span></span>SHOPPING WITH</h1>
									<h2>THICHGIAY.GA</h2>
									<p>Từng bước chân của bạn là niềm hãnh diện của chúng tôi. </p>
									
								</div> --}}
								<div class="col-sm-6">
									<img src="{{('public/frontend/images/baner3.jpg')}}" style="height:500px; max-width: fit-content;" class="girl img-responsive" alt="" />
									
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2 style="color: #04B4AE;">Loại sản phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							
							@foreach($category as $key => $cate)

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/loai-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></h4>
								</div>
							</div>
							
							@endforeach

						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2 style="color: #04B4AE;">Thương hiệu</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">

									@foreach($brand as $key => $brand)

									<li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}">{{$brand->brand_name}}</a></li>

									@endforeach
								</ul>
							</div>
						</div><!--/brands_products-->

					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					
					@yield('content') 
					
					
					
					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		{{-- <div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2>SHOPPING WITH THICHGIAY.GA</h2>
							<p>Sản phẩm là niềm tự hào của chúng tôi.</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/iframe1.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/iframe2.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/iframe3.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/iframe4.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div> --}}
		
		<div class="footer-widget" style="align-content: center;">
			<div class="container">
				<div class="row">
					
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Danh Mục</h2>
							<ul class="nav nav-pills nav-stacked">
								
								<li><a href="#">Thời trang nam</a></li>
								<li><a href="#">Thời trang nam</a></li>
								<li><a href="#">Phụ kiện nổi bật</a></li>
								<li><a href="#">Chai xịt rửa giày</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="single-widget">
							<h2>Chính sách</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Điều khoản đổi trả</a></li>
								<li><a href="#">Chính sách bảo hành</a></li>
								<li><a href="#">Chính sách hoàn tiền</a></li>
								<li><a href="#">Hệ thống thanh toán</a></li>
								
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Giới thiệu về thichgiay.ga</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Thông tin công ty</a></li>
								<li><a href="#">Vị trí cửa hàng</a></li>
								<li><a href="#">Chương trình liên kết</a></li>
								<li><a href="#">Bản quyền</a></li>
								
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Thông tin mua hàng</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="tel:0999.888.777">Mua hàng: 0999.888.777</a></li>
								<li><a href="tel:0999.888.888">Khiếu nại: 0999.888.888</a></li>
								<li><a href="tel:0999.888.666">Hỗ trợ trả góp: 0999.888.666</a></li>
								<li><a href="tel:0999.888.999">Hỗ trợ kỹ thuật: 0999.888.999</a></li>
								
							</ul>
						</div>
					</div>
					
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left" style="text-align: center;">Hãy đến với thichgiay.ga chúng tôi luôn chào đón bạn.</p>
					
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
</body>'
</html>