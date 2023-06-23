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
    <section id="contact-us" class="contact-us">
            <div class="container">
                <div class="section-header">
                    <h2><br>Contact Us</h2>
                </div><!--/.section-header-->
                
                    <div class="carousel-inner" role="listbox">
                        <br>
                        <br>
                        <br>
                        <!-- Contact Area Information Start -->
                        <div class="contact-area-info section-padding-0-100">
                            <div class="container">
                                <div class="row align-items-center justify-content-between">
                                    <!-- Contact Thumbnail -->
                                    <div class="col-12 col-md-6">
                                        <div class="contact-thumbnail">
                                            <img src="images/contact/contact1.jpg" alt="contact thumbnail pic">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-5">
                                        <div class="contact-info-area">
                                            <!-- Section Heading -->
                                            <div class="section-heading">
                                                <br>
                                                <br>
                                                <h2>CONTACT US</h2>
                                                <p>Any questions? Feel free to contact us. We will provide our best services to solve your concerns!</p>
                                            </div>
                                            <!-- Contact Information -->
                                            <div class="contact-information">
                                                <p style ="font-family: 'Roboto', sans-serif;"><span>Phone:</span> <a href="tel:+60198182384">(+60)19-818-2384</a></p>
                                                <p><span style="font-family: 'Roboto', sans-serif;">Location:</span><a>95, Lor Bayan 6, 93250 Kuching, Sarawak, Malaysia.</a></p>
                                                <p style="font-family: 'Roboto', sans-serif;  "><span style>Email:</span> <a href="mailto:anniepeksf@gmail.com">anniepeksf@gmail.com</a></p>
                                                <p><span>Open Hours:</span> <a>Mon - Sun: 8am - 5am</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Contact Area Information End -->
                    </div>
                </div>	
            </div>
        </section>

        <!-- Contact Area Start -->
        <section class="contact-area">
            <div class="carousel-inner" role="listbox">
                <div class="contact-area-group section-padding-0-100">
                    <div class="container">
            
                        <div class="row align-items-center justify-content-between">
                            <div class="col-12 col-lg-5">
                                <!-- Section Heading -->
                                <div class="section-heading-touch">
                                    <h2>GET IN TOUCH</h2>
                                    <p>Send us a message, we will call back later</p>
                                </div>
                                
                                <!-- Contact Form Area -->
                                <div class="contact-form-area mb-100">
                                    <form autocomplete="off" name="contactForm">
                                    <div class="row">
                                        <div class="col-12 col-md-7">
                                            <div class="form-group-1">
                                                <input type="name" name="Name" class="form-control" id="name" placeholder="Your Name" style="font-family: 'Roboto', sans-serif; font-color: 'black';" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <div class="form-group-2">
                                                <input type="phone" class="form-control" id="contact-phone" placeholder="Your Phone" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group-3">
                                                <input type="email" class="form-control" id="contact-email" placeholder="Your Email" required>
                                            </div>
                                        </div>
                                        <div class="col-12" required>
                                            <div class="form-group-4">
                                                <textarea class="form-control" name="message" id="contact-message" cols="30" rows="10" placeholder="Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="send-message">
                                            <button type="submit" name="submit" onclick="gotowhatsapp()" class="btn mt-15" onclick="gotowhatsapp()" value="Send message">Send message</button>                            
                                        </div>
                                        <div class="appointment-visit">
                                            <br>
                                            <p>* Please make a appointment via Get in Touch message if you wish to visit us. *</p>    
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>    
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <section class = "map-google">
            <div class="contact-area-group section-padding-0-100">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-12 col-lg-6">
                        <!-- Google Maps -->
                            <div class="map-area mb-100">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.448798736178!2d110.31955021475427!3d1.5012669989051661!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31fb09f9ab2206eb%3A0x840ff960f044ec76!2s95%2C%20Lor%20Bayan%206%2C%2093250%20Kuching%2C%20Sarawak!5e0!3m2!1sen!2smy!4v1647838409264!5m2!1sen!2smy" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div> 
                    </div>
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

        <!-- Contactus.js-->
        <script src="js/contactus.js"></script>
	</body>

	<!--footer start -->
    @include('footer')
	<!--footer end -->
	
</html>