<?php use Illuminate\Support\Facades\Auth;
	$user=Auth::check();
?>
<!doctype html>

<style>
	.single-new-arrival-bg img{
		
	}

	.Rows {
    display: table;
    width: 100%; 
    table-layout: fixed; 
    border-spacing: 10px; 
	}

	.expand{
		margin-right: 12px;
		
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
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
        
        <!-- title of site -->
        <title>Cacti Succulent KCH Products</title>

        <!-- For favicon png -->
		<link rel="shortcut icon" type="/image/icon" href="/logo/favicon.png"/>
       
        <!--font-awesome.min.css-->
        <link rel="stylesheet" href="/css/font-awesome.min.css">

        <!--linear icon css-->
		<link rel="stylesheet" href="/css/linearicons.css">

		<!--animate.css-->
        <link rel="stylesheet" href="/css/animate.css">

        <!--owl.carousel.css-->
        <link rel="stylesheet" href="/css/owl.carousel.min.css">
		<link rel="stylesheet" href="/css/owl.theme.default.min.css">
		
        <!--bootstrap.min.css-->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
		
		<!-- bootsnav -->
		<link rel="stylesheet" href="/css/bootsnav.css" >	
        
        <!--style.css-->
        <link rel="stylesheet" href="/css/style.css">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="/css/responsive.css">

		 <!--responsive.css-->
		 <link rel="stylesheet" href="css/responsive.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
          
        

    </head>
		<!--new-arrivals start -->
		<section id="new-arrivals" class="new-arrivals">
			<div class="container">
				<div class="section-header">
					<br>
					<br>

					<h2>Search Results</h2>

				</div><!--/.section-header-->

				<div class="mb-3" style="float:left;margin-top:15px;">
				
				<div class="form-check form-check-inline">
                        <input class="form-check-input"  style="border-color: #32cd32;" type="radio" name="inlineRadioOptions" id="prodsCheck" value="option0" onclick="javascript:yesnoCheck();" checked>
						<span style="color:black;">All Products</span>
						<label class="form-check-label" for="prodsCheck"></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" style="border-color: #32cd32;" type="radio" name="inlineRadioOptions" id="potsCheck" value="option1" onclick="javascript:yesnoCheck();">
						<span style="color:black;">Pots</span>
                        <label class="form-check-label" for="potsCheck"></label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" style="border-color: #32cd32;" type="radio" name="inlineRadioOptions" id="plantsCheck" value="option2" onclick="javascript:yesnoCheck();">
						<span style="color:black;">Plants</span>
                        <label class="form-check-label" for="plantsCheck"></label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" style="border-color: #32cd32;" type="radio" name="inlineRadioOptions" id="soilCheck" value="option3" onclick="javascript:yesnoCheck();">
						<span style="color:black;">Soils</span>
                        <label class="form-check-label" for="soilCheck"></label>
                    </div>
                </div> 

				<!-- <div class="form-check form-check-inline">
				<input class="form-check-input" type="checkbox" id="potsCheck" value="option1" onclick="javascript:yesnoCheck();">
				<label class="form-check-label" for="potsCheck">Pots</label>
				</div>
				<div class="form-check form-check-inline">
				<input class="form-check-input" type="checkbox" id="plantsCheck" value="option2" onclick="javascript:yesnoCheck();">
				<label class="form-check-label" for="plantsCheck">Plants</label>
				</div>
				<div class="form-check form-check-inline">
				<input class="form-check-input" type="checkbox" id="soilCheck" value="option3" onclick="javascript:yesnoCheck();">
				<label class="form-check-label" for="soilCheck">Soils</label>
				</div> -->

				<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
					<select class="form-control" name="price-sorting" style="width:11.25%;float:right;text-align:center;border-style:solid;border-color: #32cd32;margin-top:10px;">
					<option value="0" style="text-align:center; border-color:#32cd32;">Filter by Price</option>
					<option value="l2h" >Low - High Price</option>
					<option value="h2l" >High - Low Price</option>
					</select>

					

				
				<div class="new-arrivals-content">
				<div class="Row" id="allProds">

<?php
	use App\Models\Product;
	$products = $product
?>


	@foreach($products as $product)

			
	@php
	$img=Str::substr($product->Product_Image, 0, 44);   
	@endphp

		<div class="single-new-arrival" style="float:left; padding:8px;">
			<div class="single-new-arrival-bg">
			<a href="{{ url('item/'.$product->Product_ID)}}" class="photo"><img style="width:269px; height: 370px;"src="{{URL::asset('storage/images/products/'.$img)}}" alt="new-arrivals images">
				<div class="single-new-arrival-bg-overlay"></div>
				<div class="new-arrival-cart">
		<p><p>@if($product->Product_Quantity == 0)
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
			<p class="arrival-product-price" data-price="{{$product->Product_Price}}">RM {{$product->Product_Price}}</p>
		</div>
	@endforeach
	
</div>

					<div class="Row1" id="allPots" novalidate style="display: none;">

				


						@foreach($products as $product)
						@if($product->Product_Type == "Pot")

						@php
						$img=Str::substr($product->Product_Image, 0, 44);   
						@endphp

							<div class="single-new-arrival1" style="float:left; padding:8px;">
								<div class="single-new-arrival-bg">
								<a href="{{ url('item/'.$product->Product_ID)}}" class="photo"><img style="width:269px; height: 370px;"src="{{URL::asset('storage/images/products/'.$img)}}" alt="new-arrivals images">
									<div class="single-new-arrival-bg-overlay"></div>
									<div class="new-arrival-cart">
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
								<h4 style="text-align:center;padding-top:25px;"><a href="{{ url('item/'.$product->Product_ID)}}" >{{$product->Product_Name}}</a></h4>
								<p class="arrival-product-price1" style="text-align:center;color:#5f5b57;padding-top:11px;" data-price="{{$product->Product_Price}}">RM {{$product->Product_Price}}</p>
							</div>
							@endif
						@endforeach
						
					</div>

					<div class="Row2" id="allPlants" novalidate style="display: none;">

				


					@foreach($products as $product)
					@if($product->Product_Type == "Plant")

					@php
					$img=Str::substr($product->Product_Image, 0, 44);   
					@endphp

						<div class="single-new-arrival2" style="float:left; padding:8px;">
							<div class="single-new-arrival-bg">
							<a href="{{ url('item/'.$product->Product_ID)}}" class="photo"><img style="width:269px; height: 370px;"src="{{URL::asset('storage/images/products/'.$img)}}" alt="new-arrivals images">
								<div class="single-new-arrival-bg-overlay"></div>
								<div class="new-arrival-cart">
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
							<h4 style="text-align:center;padding-top:25px;"><a href="{{ url('item/'.$product->Product_ID)}}" >{{$product->Product_Name}}</a></h4>
								<p class="arrival-product-price2" style="text-align:center;color:#5f5b57;padding-top:11px;" data-price="{{$product->Product_Price}}">RM {{$product->Product_Price}}</p>
							</div>
						@endif
					@endforeach

					</div>

					<div class="Row3" id="allSoils" novalidate style="display: none;">

				


@foreach($products as $product)
@if($product->Product_Type == "Soil")

	@php
	$img=Str::substr($product->Product_Image, 0, 44);   
	@endphp

	<div class="single-new-arrival3" style="float:left; padding:8px;">
		<div class="single-new-arrival-bg">
		<a href="{{ url('item/'.$product->Product_ID)}}" class="photo"><img style="width:269px; height: 370px;"src="{{URL::asset('storage/images/products/'.$img)}}" alt="new-arrivals images">
			<div class="single-new-arrival-bg-overlay"></div>
			<div class="new-arrival-cart">
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
		<h4 style="text-align:center;padding-top:25px;"><a href="{{ url('item/'.$product->Product_ID)}}" >{{$product->Product_Name}}</a></h4>
								<p class="arrival-product-price3" style="text-align:center;color:#5f5b57;padding-top:11px;" data-price="{{$product->Product_Price}}">RM {{$product->Product_Price}}</p>
							</div>
	@endif
@endforeach

</div>
				</div>

				
				</div><!--/.container-->
		
		</section><!--/.new-arrivals-->	
		
	
				
			

					
					<script>
					$(document).on("change", ".form-control", function() {
					var sortingMethod = $(this).val();
					
					if(sortingMethod == 'l2h') {
						sortProductsPriceAscending();
					} else if (sortingMethod == 'h2l') {
						sortProductsPriceDescending();
					}
					});

					function sortProductsPriceAscending() {
					var gridItems = $('.single-new-arrival');

					gridItems.sort(function(a, b) {
						return $('.arrival-product-price', a).data("price") - $('.arrival-product-price', b).data("price");
					});

					$(".Row").append(gridItems);
					}

					function sortProductsPriceDescending() {
					var gridItems = $('.single-new-arrival');

					gridItems.sort(function(a, b) {
						return $('.arrival-product-price', b).data("price") - $('.arrival-product-price', a).data("price");
					});

					$(".Row").append(gridItems);
					}

				</script>


		
		<script>
			

			function yesnoCheck(){


				if (document.getElementById('prodsCheck').checked) {
					document.getElementById('allProds').style.display = 'block';
					document.getElementById('allPots').style.display = 'none';
					document.getElementById('allSoils').style.display = 'none';
					document.getElementById('allPlants').style.display = 'none';


					$(document).on("change", ".form-control", function() {
					var sortingMethod = $(this).val();
					
					if(sortingMethod == 'l2h') {
						sortProductsPriceAscending();
					} else if (sortingMethod == 'h2l') {
						sortProductsPriceDescending();
					}
					});

					function sortProductsPriceAscending() {
					var gridItems = $('.single-new-arrival');

					gridItems.sort(function(a, b) {
						return $('.arrival-product-price', a).data("price") - $('.arrival-product-price', b).data("price");
					});

					$(".Row").append(gridItems);
					}

					function sortProductsPriceDescending() {
					var gridItems = $('.single-new-arrival');

					gridItems.sort(function(a, b) {
						return $('.arrival-product-price', b).data("price") - $('.arrival-product-price', a).data("price");
					});

					$(".Row").append(gridItems);
					}


				}else if (document.getElementById('potsCheck').checked) {
					document.getElementById('allProds').style.display = 'none';

					document.getElementById('allPots').style.display = 'block';

					document.getElementById('allPlants').style.display = 'none';
					document.getElementById('allSoils').style.display = 'none';


					$(document).on("change", ".form-control", function() {
					var sortingMethod = $(this).val();
					
					if(sortingMethod == 'l2h') {
						sortProductsPriceAscending();
					} else if (sortingMethod == 'h2l') {
						sortProductsPriceDescending();
					}
					});

					function sortProductsPriceAscending() {
					var gridItems = $('.single-new-arrival1');

					gridItems.sort(function(a, b) {
						return $('.arrival-product-price1', a).data("price") - $('.arrival-product-price1', b).data("price");
					});

					$(".Row1").append(gridItems);
					}

					function sortProductsPriceDescending() {
					var gridItems = $('.single-new-arrival1');

					gridItems.sort(function(a, b) {
						return $('.arrival-product-price1', b).data("price") - $('.arrival-product-price1', a).data("price");
					});

					$(".Row1").append(gridItems);
					}

				} else if (document.getElementById('plantsCheck').checked) {
					document.getElementById('allProds').style.display = 'none';

					document.getElementById('allPots').style.display = 'none';

					document.getElementById('allPlants').style.display = 'block';
					document.getElementById('allSoils').style.display = 'none';


					$(document).on("change", ".form-control", function() {
					var sortingMethod = $(this).val();
					
					if(sortingMethod == 'l2h') {
						sortProductsPriceAscending();
					} else if (sortingMethod == 'h2l') {
						sortProductsPriceDescending();
					}
					});

					function sortProductsPriceAscending() {
					var gridItems = $('.single-new-arrival2');

					gridItems.sort(function(a, b) {
						return $('.arrival-product-price2', a).data("price") - $('.arrival-product-price2', b).data("price");
					});

					$(".Row2").append(gridItems);
					}

					function sortProductsPriceDescending() {
					var gridItems = $('.single-new-arrival2');

					gridItems.sort(function(a, b) {
						return $('.arrival-product-price2', b).data("price") - $('.arrival-product-price2', a).data("price");
					});

					$(".Row2").append(gridItems);
					}
				} else if (document.getElementById('soilCheck').checked) {
					document.getElementById('allProds').style.display = 'none';

					document.getElementById('allPots').style.display = 'none';

					document.getElementById('allPlants').style.display = 'none';
					document.getElementById('allSoils').style.display = 'block';


					$(document).on("change", ".form-control", function() {
					var sortingMethod = $(this).val();
					
					if(sortingMethod == 'l2h') {
						sortProductsPriceAscending();
					} else if (sortingMethod == 'h2l') {
						sortProductsPriceDescending();
					}
					});

					function sortProductsPriceAscending() {
					var gridItems = $('.single-new-arrival3');

					gridItems.sort(function(a, b) {
						return $('.arrival-product-price3', a).data("price") - $('.arrival-product-price3', b).data("price");
					});

					$(".Row3").append(gridItems);
					}

					function sortProductsPriceDescending() {
					var gridItems = $('.single-new-arrival3');

					gridItems.sort(function(a, b) {
						return $('.arrival-product-price3', b).data("price") - $('.arrival-product-price3', a).data("price");
					});

					$(".Row3").append(gridItems);
					}

				}


			}
			function yesnoCheckE() {
				if (document.getElementById('plantsCheck').checked) {
					document.getElementById('ifYes').style.display = 'none';
					document.getElementById('allProds').style.display = 'none';

				} else if (document.getElementById('potsCheck').checked) {
					document.getElementById('ifYesPot').style.display = 'block';
					document.getElementById('allProds').style.display = 'none';

				}else if (document.getElementById('soilCheck').checked) {
					document.getElementById('ifYesSoil').style.display = 'block';
					document.getElementById('ifYes').style.display = 'none';
					document.getElementById('ifYesPot').style.display = 'none';
					document.getElementById('allProds').style.display = 'none';

				}else if ((document.getElementById('soilCheck').checked) && (document.getElementById('potsCheck').checked)) {
					document.getElementById('ifYesSoil').style.display = 'block';
					document.getElementById('ifYes').style.display = 'none';
					document.getElementById('ifYesPot').style.display = 'block';
					document.getElementById('allProds').style.display = 'none';
				}

				else if ((document.getElementById('plantsCheck').checked) && (document.getElementById('potsCheck').checked)) {
					document.getElementById('ifYesSoil').style.display = 'none';
					document.getElementById('ifYes').style.display = 'block';
					document.getElementById('ifYesPot').style.display = 'block';
					document.getElementById('allProds').style.display = 'none';
				}

				else if ((document.getElementById('plantsCheck').checked) && (document.getElementById('soilCheck').checked)) {
					document.getElementById('ifYesSoil').style.display = 'block';
					document.getElementById('ifYes').style.display = 'block';
					document.getElementById('ifYesPot').style.display = 'none';
					document.getElementById('allProds').style.display = 'none';
				}

				else if ((document.getElementById('plantsCheck').checked) && (document.getElementById('soilCheck').checked)&& (document.getElementById('potsCheck').checked)) {
					document.getElementById('allProds').style.display = 'block';
					document.getElementById('ifYesSoil').style.display = 'none';
					document.getElementById('ifYes').style.display = 'none';
					document.getElementById('ifYesPot').style.display = 'none';
				}

				else{
					document.getElementById('allProds').style.display = 'block';
					document.getElementById('ifYes').style.display = 'none';
					document.getElementById('ifYesSoil').style.display = 'none';
					document.getElementById('ifYes').style.display = 'none';
					document.getElementById('ifYesPot').style.display = 'none';

				}

			}

			</script>


				

			

			


		
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

		<script src="text/jquery">




		</script>


		

	</body>

	@include('footer')


        
    
	
</html>