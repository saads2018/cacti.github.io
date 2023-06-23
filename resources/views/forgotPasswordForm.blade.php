<?php use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
	$user=Auth::check();
?>
<html lang="en">
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
        <link rel="stylesheet" href="/css/style.css">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="css/responsive.css">

		<link rel="stylesheet" href="css/viewProductsAdmin.css">
    </head>
	<body>
    @if($user)
<br><br><br><br><br>
                        <div>
                            <h1 class="text-center" style="font-size:30px;color:#808080">You are already logged In</h1>
                        </div>
    @else
                <div class="container">
                    <div class="section-header">
                        <h2><br>Reset Password</h2>
                                            <br>
                                            <h3 style="color: #32CD32;"> Enter your Email </h3>
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
                                    <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                                        <br>
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div>
                                            <div class="col-md-4">
                                                <h6 id="email-address-forget-linked" class="mb-0">E-Mail Address</h6>
                                            </div>
                                            <div class="col-md-6">
                                            <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                            @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <br style="line-height: 50px;">
                                        <div> 
                                            <div class="col-md-4">
                                                <h6 id="email-address-password-linked" class="mb-0">Password</h6>
                                            </div>
                                            <div class="col-md-6">
                                            <input type="password" id="password" class="form-control" name="password" required autofocus>
                                            @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <br style="line-height: 50px;">
                                        <div>
                                            <div class="col-md-4">
                                                <h6 id="password-confirmed-linked" class="mb-0">Confirm Password</h6>
                                            </div>
                                            <div class="col-md-6">
                                            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                            @if ($errors->has('password_confirmation'))
                                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <br><br><br>
                                        <div class="col-md-6 col-md-offset-4">
                                            <button id="reset-password-confirm" style="border-color:#32CD32; background:#32CD32;" type="submit" class="btn btn-primary">
                                                Reset Password
                                            </button>
                                        </div>
                                        <br>
                                    </form>
                                    
                                </div>
                            
                        </div>
                    </div>
                </div>
</div>

                    @endif
		
		<!-- Include all js compiled plugins (below), or include individual files as needed -->
        
		<script src="js/jquery.js">
			function Function(){
				window.location.href = "http://127.0.0.1:8000/product"
			}

		</script>
        @include('footer')
</body>
        


