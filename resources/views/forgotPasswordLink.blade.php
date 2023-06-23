
<?php use Illuminate\Support\Facades\Auth;
	$user=Auth::check();
?>

<?php 
use App\Models\Product;
$products=Product::all();
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
	
	<body style="min-height:100%">

    <section style="background:white;min-height:fill;">
<div class="container">
<div class="section-header">
                    <h2><br>{{ __('Reset Password') }}</h2>
                    <br>
                    <h3 style="color: #32CD32;"> Enter your Email! </h3>
                </div><!--/.section-header-->
    <div class="row">
        <br>
        <br>
        <div class="col-md-8 col-md-offset-2" >
            <div class="panel panel-default">

                <div class="panel-body" style="box-shadow:2px 2px 4px;">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        <br>
                        {{ csrf_field() }}

                        <div>
                            <div class="col-md-4">
                                <h6 id="email-address-forget" class="mb-0">{{ __('E-Mail Address') }}:</h6>
                            </div>
                            <div class="col-md-6">
                            <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br><br>
                        <div class="col-md-6 col-md-offset-4">
                              <button id="send-reset-link-button" style="border-color:#32CD32; background:#32CD32;" type="submit" class="btn btn-primary">
                                  Send Password Reset Link
                              </button>
                          </div>
                          <br>
                    </form>
                    
                </div>
            
        </div>
    </div>
</div>
</section>
		
		<!-- Include all js compiled plugins (below), or include individual files as needed -->

		<script src="js/jquery.js">
			function Function(){
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
		
		<!--footer end -->
        @include('footer')
    </body>
	
</html>



