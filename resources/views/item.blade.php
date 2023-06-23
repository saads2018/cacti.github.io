<?php use Illuminate\Support\Facades\Auth;
	$user=Auth::check();
?>



<?php 
session_start();?>

<?php
use App\Models\Product;
$products=Product::all();
?>

<?php
$product = Product::where([ 'Product_ID' => 6 ]);
?>

<!doctype html>

<style>
	.single-new-arrival-bg img{
		max-height:350px;
		max-width:300px;
		object-fit: cover;
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

/* Position the "next button" to the right */
.nextSSE {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.welcome-hero-img{
	margin-top:-170px;
	margin-bottom:-170px;
	margin-right:-555px;
	transition: 0.5s all ease-in-out;


}



.primaryPic{

	position: relative; /* Declared position allows for location changes */
    top: -447px; /* Moves the image 2px closer to the top of the page */
	right:-400px;
	transition: 0.5s all ease-in-out;
	box-shadow: 2px 2px 2px 2px;
	width:190px;height:240px;
	
	

}

.secondaryPic{

position: relative; /* Declared position allows for location changes */
top: -267px; /* Moves the image 2px closer to the top of the page */
right:-400px;
transition: 0.5s all ease-in-out;
width:190px;height:240px;
}

.col-sm-5{

}


.carousel-control-prev-icon
{
	background-color: black;
	opacity:10px;

}

.carousel-control-next-icon
{
    background-color: black;
	opacity:10px;



}





.def {
	/* top: -84560px; Moves the image 2px closer to the top of the page */
	position: relative;
  text-align: center;
  color: white;
}

.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  color: white;

  transform: translate(-50%, -50%);
}

.available {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color:white;
}


	
</style>

<html class="no-js" lang="en">

    <head>

		<!-- Displays appropriate header -->
        @if($user)
		    @include('ALTheader')
		@else
			@include('ALTguestheader')
		@endif

        <!-- meta data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags must come first in the head; any other head content must come after these tags -->

        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
        
        <!-- title of site -->
        <title>Cacti Succulent KCH Products</title>

        <!-- For favicon png -->
		<link rel="shortcut icon" type="image/icon" href="logo/favicon.png"/>
       
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
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        

    </head>
	
	<body>
		

		<!--welcome-hero start -->
		<header id="home" class="welcome-hero">

		

			<div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
				<!--/.carousel-indicator -->
				 
					@foreach($products as $product)
					@if($product->Product_ID == $id)

					
				
				<!-- /ol-->
				<!--/.carousel-indicator -->

				<!--/.carousel-inner -->
				<div class="carousel-inner" role="listbox">

					<!-- .item -->

					<div class="item active ">


				  <div class="container">
						<div class="slideshow-container">
								<div class="welcome-hero-content">
									<div class="row">
									<div class="col-sm-7">
								 		<div class="single-welcome-hero">
											<div class="welcome-hero-img">
											<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" >
												
												@php
												$img_full=$product->Product_Image;
												$img=Str::substr($img_full, 0, 44);
												$img_full=Str::substr($img_full, 46);   
												@endphp
												
											<div class="carousel-inner" style="width:450px;height:500px;">
												<div class="carousel-item active">
												<img src="{{URL::asset('storage/images/products/'.$img)}}" alt="..." style="width:450px;height:500px;">
												</div>

												@while ($img_full!="")

													@php
														$img=Str::substr($img_full, 0, 44);
													@endphp
													
													<div class="carousel-item " style="width:450px;height:500px;">
														<img src="{{URL::asset('storage/images/products/'.$img)}}" alt="..." style="width:450px;height:500px;">
													</div>
													
													@php
														$img_full=Str::substr($img_full, 46);   
													@endphp

												@endwhile
								
											</div>
											<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" >
												<span class="carousel-control-prev-icon"  style="font-size:30px;"></span>
											</button>
											<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
												<span class="carousel-control-next-icon" aria-hidden="true"></span>
											</button>
										  </div>

											</div>
											</div>
										</div>
										<div class="col-sm-5" style="	margin-left:-145px;">
											<div class="single-welcome-hero">
												<div class="welcome-hero-txt">
													<h4>Cacti collection</h4>
													<h2 style="color:black;">{{$product->Product_Name}}</h2>
													<p>
													{{$product->Product_Desc}}
													</p>
													<div>
														<h3 style="font-size:33px;color:#32CD32;">
														RM {{$product->Product_Price}}
														</h3>
													</div>@if($product->Product_Quantity == 0)
								<a style="color:red;">Out of Stock</a>
								@else
													
													<button class="btn-cart welcome-add-cart" style=" width:550px;color:white;"onClick="location.href='{{ url('cart/'.$product->Product_ID) }}'">
														<span class="lnr lnr-plus-circle" ></span>
														add <span>to </span> cart
													</button>
													@endif

													
												</div><!--/.welcome-hero-txt-->
											</div><!--/.single-welcome-hero-->
										</div><!--/.col-->
										
									</div><!--/.row-->
									@endif
									@endforeach
								</div><!--/.welcome-hero-content-->
							</div><!-- /.container-->

						</div><!-- /.single-slide-item-->

					</div><!-- /.item .active-->

					
				</div><!-- /.carousel-inner-->

			</div><!--/#header-carousel-->

		
		</header><!--/.welcome-hero-->
		<div class="def">
					<img src="/images/homepage/bgimage40Pilgrim.jpg"/>
				<div class="centered">
					<a style="color:white; font-size:76px;"href="/product">Shop More</a>
				</div>
		</div>



		
		<!--new-arrivals end -->
	
		<!-- clients end -->
		
		<!-- Include all js compiled plugins (below), or include individual files as needed -->

		<script src="/js/jquery.js"></script>
        
        <!--modernizr.min.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		
		<!--bootstrap.min.js-->
        <script src="/js/bootstrap.min.js"></script>
		
		<!-- bootsnav js -->
		<script src="/js/bootsnav.js"></script>

		<!--owl.carousel.js-->
        <script src="/js/owl.carousel.min.js"></script>


		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
		
        
        <!--Custom JS-->
        <script src="/js/custom.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		

	</body>

	@include('footer')


        
    
	
</html>