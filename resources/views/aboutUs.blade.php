<?php use Illuminate\Support\Facades\Auth;
	$user=Auth::check();
?>

<!doctype html>

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
        <title>About Us</title>

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
    <section id="about-us" class="about-us" style="background-color: #f8f9fd;">
        <div class="container">
            <div class="abouttop">
                <div class="section-header">
                    <h2><br>About Us</h2>
                </div><!--/.section-header-->
                <div class="carousel-inner" role="listbox">
                    <div class = "about-paragraph">
                        <br>
                        <br>
                        <br>
                        <p>Cacti Succulent KCH is a home-based business with 30 years of experience in Kuching.</p>
                        <p>We are passionate about growing succulents!</p>
                        <br>
                        <br>
                        <br>							
                    </div>
                </div>
            </div>	
        </div>
        <div class="container">
            <div class="row">
                <div class="description-area section-padding-100-0">
                        <!-- Description Benefits Area -->
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="description-benefits-area text-center mb-100">
                                <img src="images/about/b1.png">
                                <h5><br>Quality Product</h5>
                                <p>We provided the best quality pots, plants, and soils in Kuching.<p>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="description-benefits-area text-center mb-100">
                                <img src="images/about/b2.png">
                                <h5><br>Prefect Service</h5>
                                <p>Our specialties lie in the natural setting, and we are primarily experts in selling luscious cacti, various succulent plants, and other plant-like products.<p>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="description-benefits-area text-center mb-100">
                                <img src="images/about/b3.png">
                                <h5><br>100% Natural</h5>
                                <p>We occupy a beautiful natural nursery and garden center, offering extravagant cacti and other such succulents.<p>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="description-benefits-area text-center mb-100">
                                    <img src="images/about/b4.png">
                                    <h5><br>Environmentally Friendly</h5>
                                    <p>Our residence feeds visuals of mass and size as it covers quite a large piece of land which leaves customers engaged, lingering around the location for hours on end, all in the spectacle of awe.<p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- ##### Service Area Start ##### -->
        <section class="our-story-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading-about text-center">
                        <br>
                        <br>
                        <h2><u>OUR STORY</u></h2>
                        <p>"Healthy Plants, Good Packaging & Fast Delivery"</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-between">
                <div class="col-12 col-lg-5">
                    <div class="story-area mb-100">

                        <!-- Single Service Area -->
                        <div class="single-story-area d-flex align-items-center">
                            <!-- Content -->
                            <div class="story-content">
                                <p>The family business started in the early 80s with selling various types of Bougainvillea (a.k.a Paper Flower) and Adenium (a.k.a Desert Rose) on every weekend, "Sunday Market" at Satok. In 1992 we started to sell various types of cactuses. We began to sell gardening products such as soil, pots, fertilizers, and stones.</p>
                            </div> 
                        </div>

                        <!-- Single Service Area -->
                        <div class="single-story-area d-flex align-items-center">
                            <!-- Content -->
                            <div class="story-content">
                                <p>In 2020, due to COVID 19, physical shopping was restricted, we started to sell our products through Facebook. We also deliver products within Kuching areas (if purchased online) or ship outside Kuching areas (in Sarawak like Sibu, Bintulu, and Miri).</p>
                            </div>
                        </div>

                         <!-- Single Service Area -->
                         <div class="single-story-area d-flex align-items-center">
                            <!-- Content -->
                            <div class="story-content">
                                <p>A few years later, we started to sell succulents and expanded our weekend market business to a home-based business. We now focused on cactus and succulents.</p>
                            </div>
                        </div>

                        <!-- Single Service Area -->
                        <div class="single-story-area d-flex align-items-center">
                            <!-- Content -->
                            <div class="story-content">
                                <p>"Healthy Plants, Good Packaging & Fast Delivery." It is our motto and standard. From customers become friends where we are sharing gardening knowledge, advice on plants cares as we are opening to customers' feedbacks, new and exciting experience.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="story-image">
                        <img src="images/about/story1.jpg" alt="story pic">
                    </div>
                </div>

            </div>
        </div>
        <br>
        <br>
    </section>
    <!-- ##### Service Area End ##### --> 

    <section>
        <div class="container">
            <div class = "about-us-button">
                <button class="our-product" onclick="window.location.href='/product'">Our Product</button>
                <button class="about-contact" onclick="window.location.href='/contactUs'">Contact Us</button>
            </div>
        </div>
    </section>

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

    <!--footer start -->
    @include('footer')
	<!--footer end -->

	</body>
	
</html>