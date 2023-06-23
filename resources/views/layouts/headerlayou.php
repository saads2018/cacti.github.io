<?php use Illuminate\Support\Facades\Auth;
	$user=Auth::check();
?>

<?php use App\Models\Product;
    $products=Product::all();?>
<!--font-family-->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<style>

.button11 {
padding-top:42px;
padding-left:15px;
border:2px;
color:#32CD32;
background: color #32CD32;
border-radius:12px;

}

.button11:hover{
	color:green;
}



.button {
  border: none;
  color: white;
  padding: 1px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 2px 970px 0px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: red; 
  border: 2px solid red;
}

.button1:hover {
  background-color: red;
  color: white;
}

</style>
<head>
        <!-- title of site -->

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
        <link rel="stylesheet" href="/css/viewProductsAdmin.css">
	
    </head>
<body>
<!-- top-area Start -->
<div class="top-area">
					<!-- Start Navigation -->
				    <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy"  data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

				        <!-- Start Top Search -->
						<div class="top-search">
				            <div class="container">
				                <div class="input-group">
				                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
				                    <input onchange = "search()" id ="searchBar2" type="text" class="form-control" placeholder="Search">
				                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
				                </div>
				            </div>
				        </div>
						<script type="text/javascript">
							function search()
							{
								var link= "/search/"+document.getElementById("searchBar2").value;
								document.addEventListener("keyup", function(event) {
									if (event.keyCode === 13) {
										location.replace(link);
									}
								});
							}
						</script>
				        <!-- <div class="top-search">
				            <div class="container">
				                <div class="input-group">
				                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
				                    <input type="text" class="form-control" placeholder="Search">
				                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
				                </div>
				            </div>
				        </div> -->
				        <!-- End Top Search -->

				        <div class="container">            
				            <!-- Start Atribute Navigation -->
							 <div class="attr-nav">
				                <ul>
				                	<li class="search">
				                		<a href="#"><span class="lnr lnr-magnifier"></span></a>
				                	</li><!--/.search-->
									
									<li>
										<a href="/login" style="font-size:18px;font-style:sans-serif;">Login</a>
				                	</li>
								</ul>

									
				                </ul>
				            </div><!--/.attr-nav-->
				            <!-- End Atribute Navigation -->

				            <!-- Start Header Navigation -->
				            <div class="navbar-header">
				                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
				                    <i class="fa fa-bars"></i>
				                </button>
				                <a class="navbar-brand" href="/homepage" style="color:#32CD32;">Cacti Succulent KCH</a>

				            </div><!--/.navbar-header-->
				            <!-- End Header Navigation -->

				            <!-- Collect the nav links, forms, and other content for toggling -->
				            <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
								<ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
									<li><a href = "/homepage">Home</a></li>
									<li><a href = "/product">Products</a></li>
									<li><a href = "/aboutUs">About Us</a></li>
									<li><a href = "/contactUs">Contact Us</a></li>
								</ul><!--/.nav -->
				            </div><!-- /.navbar-collapse -->
				        </div><!--/.container-->
				    </nav><!--/nav-->
				    <!-- End Navigation -->
				</div><!--/.header-area-->
			    <div class="clearfix"></div>

			</div><!-- /.top-area-->
            <main class="py-4">
            @yield('content')
        </main>
            </body>

		