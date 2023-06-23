
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
	
	<body>
		
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">{{ __('Reset Password') }}</div>
                  <div class="card-body">
  
                  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
  
                      <form action="{{ route('password.email') }}" method="POST">
                          @csrf
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                          </div>
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Send Password Reset Link!!
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
                                            

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
        
    </body>
	
</html>



