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
        

    </head>
	
	<body>
				

		<!--new-arrivals start -->
		<section id="new-arrivals" class="new-arrivals">
			<div class="container">
				<div class="section-header">
					<br>
					<br>

					<h2>All Soil Products</h2>

				</div><!--/.section-header-->
				<div class="new-arrivals-content">
					<div class="Row">

						@foreach($products as $product)
						@php
						$img=Str::substr($product->Product_Image, 0, 44);   
						@endphp
						@if($product->Product_Type == "Soil")
							<div class="single-new-arrival" style="float:left; padding:8px;">
								<div class="single-new-arrival-bg">
								<a href="{{ url('item/'.$product->Product_ID)}}" class="photo"><img style="width:269px; height: 370px;"src="{{URL::asset('storage/images/products/'.$img)}}" alt="new-arrivals images">
									<div class="single-new-arrival-bg-overlay"></div>
									<div class="new-arrival-cart">
										
									<!-- <p 
									class="btn-holder"><a href="javascript:void(0);" data-id="{{$product->Product_ID}}" 
										class="btn btn-warning btn-block text-center add-to-cart" role="button">Add to cart</a>
                                <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                            </p> -->
						<p>@if($product->Product_Quantity == 0)
								<a style="color:red;">Out of Stock</a>
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
								<h4><a href="{{ url('item/'.$product->Product_ID)}}">{{$product->Product_Name}}</a></h4>
								<p class="arrival-product-price">RM {{$product->Product_Price}}</p>
							</div>
							@endif
						@endforeach

    <!-- <script type="text/javascript">
        $(".add-to-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            ele.siblings('.btn-loading').show();

            $.ajax({
                url: '{{ url('cart') }}' + '/' + ele.attr("data-id"),
                method: "get",
                data: {_token: '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {

                    ele.siblings('.btn-loading').hide();

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                    $("#header-bar").html(response.data);
                }
            });
        });
    </script> -->
						
					</div>
				</div>		
			</div><!--/.container-->
		
		</section><!--/.new-arrivals-->
		<!--new-arrivals end -->
	
		<!-- clients end -->
		
		<!-- Include all js compiled plugins (below), or include individual files as needed -->

		<script src="js/jquery.js"></script>
        
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


	</body>

	@include('footer')


        
    
	
</html>