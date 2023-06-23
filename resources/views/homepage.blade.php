<?php use Illuminate\Support\Facades\Auth;
	$user=Auth::check();
?>

<?php 
use App\Models\Product;
$products=Product::all();
?>

<!doctype html>
<style>
	.single-new-arrival-bg img{
		
	}

	.Rows {
    display: table;
    width: 100%; /*Optional*/
    table-layout: fixed; /*Optional*/
    border-spacing: 10px; /*Optional*/
	}
	
	.expand{
		margin-right: 12px;
		
	}

	
	
</style>
<html class="no-js" lang="en">

    <head>
		<!-- Displays appropriate header -->
        @if($user)
		    @include('header')
		@else
			@include('guestheader')
		@endif

        <!-- meta data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
        
        <!-- title of site -->
        <title>Cacti Succulent KCH</title>

       
        <!--font-awesome.min.css-->
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <!--linear icon css-->
		<link rel="stylesheet" href="css/linearicons.css">

		<!--animate.css-->
        <link rel="stylesheet" href="css/animate.css">

        <!--owl.carousel.css-->
        <link rel="stylesheet" href="css/owl.carousel.min.css">
		<link rel="stylesheet" href="css/owl.theme.default.min.css">
		
        <!--bootstrap.min.css-->
        <link rel="stylesheet" href="css/bootstrap.min.css">
		
		<!-- bootsnav -->
		<link rel="stylesheet" href="css/bootsnav.css" >	
        
        <!--style.css-->
        <link rel="stylesheet" href="css/style.css">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="css/responsive.css">

		<link rel="stylesheet" href="css/viewProductsAdmin.css">
    </head>
	
	<body>
		
		
		<!--welcome-hero start -->
		<header id="home" class="welcome-hero">

			<div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
				<!--/.carousel-inner -->
				<div class="carousel-inner" role="listbox">
					<!-- .item -->
					<div class="item active">
						<div class="single-slide-item slide1">
							<div class="container">
								<div class="welcome-hero-content">
									<div class="row">
										<div class="col-sm-7">
											<div class="single-welcome-hero">											
												<iframe src="https://www.youtube.com/embed/_vKQZp-MGFg?autoplay=1&mute=1&loop=1&playlist=_vKQZp-MGFg"></iframe>
												<div class="welcome-hero-txt">
													@if(Auth::check())
														<h2 style="text-align:left;float:left;">Welcome To Cacti Succulent KCH, {{Auth::user()->name}}</h2>
													@else
														<h2>Welcome To Cacti Succulent KCH</h2>
													@endif
														<h3>The gardening that matters</h3>
														<a href="product">Explore</a>
												</div><!--/.welcome-hero-txt-->
											</div><!--/.single-welcome-hero-->
										</div><!--/.col-->
									</div><!--/.row-->
								</div><!--/.welcome-hero-content-->
							</div><!-- /.container-->
						</div><!-- /.single-slide-item-->
					</div><!-- /.item .active-->
				</div><!-- /.carousel-inner-->
			</div><!--/#header-carousel-->
		</header><!--/.welcome-hero-->
		<!--welcome-hero end -->

		<!-- Homepage register banner -->
		<section id="register-banner">
				<div class="single-register-banner">
					<img src="images/homepage/bgimage10.jpeg"/>
					<!-- <div class="gardener-img">
						<img src="images/collection/gardener.png"/>
					</div> -->
					<div class="register-text">
						@if(Auth::check())
							<h2>Our Background</h2>
							<h3>Find out more about us</h3>
							<a class="begin-btn" href="aboutUs">Discover</a>
						@else
							<h2>Begin your Journey Here!</h2>
							<h3 style="margin-top:10px;">Sign up for free!</h3>
							<a class="begin-btn" href="register">Register</a>
						@endif
					<div>
				</div>
		</section>
		<!-- Homepage register banner end -->

		<!--Cacti-collection start -->
		<section id="Cacti-collection">
			<div class="owl-carousel owl-theme" id="collection-carousel">
				<div class="Cacti-collection collectionbg1">
					<div class="container">
						<div class="Cacti-collection-txt">
							<h2>unlimited succulent collection</h2>
							<p>
								our succulent are homegrown and the best in kuching. the owners specialized in this field for over 30 years of experience in growing succulent
							</p>
							<div class="Cacti-collection-price">
								<h4>starting from <span>RM12</span></h4>
							</div>
							<a href="product">View More</a>
							<!-- <button class="btn-cart welcome-add-cart Cacti-collection-btn" style="color:white;" onclick="window.location='http://127.0.0.1:8000/product'">
								View <span>More </span>
							</button> -->
						</div>
					</div>	
				</div><!--/.Cacti-collection-->
				<div class="Cacti-collection collectionbg2">
					<div class="container">
						<div class="Cacti-collection-txt">
							<h2>other gardening appliances</h2>
							<p>
								we also provide soils and pots for your gardening
							</p>
							<div class="Cacti-collection-price">
								<h4>starting from <span>RM12</span></h4>
							</div>
							<div>
								<a href="product">View More</a>
							</div>
							<!-- <button class="btn-cart welcome-add-cart Cacti-collection-btn" type="button" style="color:white;" onclick="window.location='http://127.0.0.1:8000/product'">
								View <span>More </span>
							</button> -->
						</div>
					</div>
				</div><!--/.Cacti-collection-->
			</div><!--/.collection-carousel-->
		</section>
		<!-- <section id="about-banner">
			<div class="container">
				<div class="longphoto">
					<img src="images/collection/bgimage20.jpeg">
				</div>
			</div>
		</section> -->

		<!--feature start -->
		<section id="feature" class="feature">
			<div class="container">
				<div class="section-header">
					<h2>featured products</h2>
				</div><!--/.section-header-->
				<div class="new-arrivals-content">
					<div class="Row">

						
						
						@foreach($products as $product)

						@php
						$img=Str::substr($product->Product_Image, 0, 44);   
						@endphp
						
							<div class="single-new-arrival" style="float:left; padding:8px;">
								<div class="single-new-arrival-bg">
								<a href="{{ url('item/'.$product->Product_ID)}}" class="photo"><img style="width:269px; height: 370px;"src="{{URL::asset('storage/images/products/'.$img)}}" alt="new-arrivals images">
									<div class="single-new-arrival-bg-overlay"></div>
									<div class="new-arrival-cart">
										
							<p>@if($product->Product_Quantity == 0)
								<a href="{{ url('item/'.$product->Product_ID)}}" style="color:red;">Out of Stock</a>
								@else
											<span class="lnr lnr-cart"></span>
											<a href="{{ url('cart/'.$product->Product_ID) }}" role="button">add <span>to </span> cart</a>
										</p>
										@endif
										<p class="arrival-review pull-right">
											<a href="{{ url('item/'.$product->Product_ID)}}" role="button" class="lnr lnr-frame-expand expand"></a>

										</p>
									</div>
								</div>
								<h4><a href="{{ url('item/'.$product->Product_ID)}}">{{$product->Product_Name}}</a> 
								</h4>
								<p class="arrival-product-price">RM {{$product->Product_Price}}</p>
								
							</div>
						@endforeach
						
					</div>
				</div>		
			</div><!--/.container-->
		
		</section><!--/.new-arrivals-->
			</div>
		</section><!--/.feature-->
		<!--feature end -->

		<!-- Include all js compiled plugins (below), or include individual files as needed -->

		<script src="js/jquery.js">
			function Function() {
				window.location.href = "http://127.0.0.1:8000/product"
			}

		</script>
        
        <!--modernizr.min.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		
		<!--bootstrap.min.js-->
        <script src="js/bootstrap.min.js"></script>
		
		<!-- bootsnav js -->
		<script src="js/bootsnav.js"></script>

		<!--owl.carousel.js-->
        <script src="js/owl.carousel.min.js"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
		
        <!--Custom JS-->
        <script src="js/custom.js"></script>

		<!--footer start -->
		@include('footer')
		<!--footer end -->
        
    </body>
	
</html>
