<?php use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
	  $user=Auth::check();
    $id=Auth::id();
	  $userprofilepic=Auth::user()->profilepicture;
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
        <!-- <link rel="stylesheet" href="css/style.css"> -->
        <link rel="stylesheet" href="css/profilepage.css">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="css/responsive.css">
        

    </head>
	
	<body>
	<section>
<div class="container">
<div class="section-header">
                    <h2><br>Change Password</h2>
                    <br>
                    <h3 style="color: #32CD32;"> Enter your current and new Password! </h3>
                </div><!--/.section-header-->
    <div class="row">
        <br>
        <br>
        <div class="col-md-8 col-md-offset-2" >
            <div class="panel panel-default">
                <div class="panel-body" style="box-shadow:2px 2px 4px;">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <div class="col-md-3">
                            <h6 id="current-password-label" class="mb-0">Current Password</h6>
                            </div>
                            <div class="col-md-7">
                                <input id="current-password" type="password" class="form-control" name="current-password">

                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-3">
                                <h6 id="password-label" class="mb-0">New Password</h6>
                            </div>
                            <div class="col-md-6">
                                <input id="new-password" type="password" class="form-control" name="new-password">

                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3">
                                <h6 id="confirm-new-password-label" class="mb-0">Confirm New Password</h6>
                            </div>
                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                            <button type="button" data-toggle="modal" data-target="#exampleModalCenter" id="edit-user-password-confirm" class="btn btn-primary" style="background-color:#32CD32;border:none;">CHANGE PASSWORD</button>
                            <!-- modal here -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="margin-top:10%;">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header" style="text-align:center;">
                                                                    <h1 class="modal-title" id="exampleModalLongTitle" style="color:#32CD32;">IMPORTANT!</h1>
                                                                </div>
                                                                <div class="modal-body" style="text-align:center">
                                                                    <h4 autocapitalize="off" style="margin-top:5%;margin-bottom:5%;">Are you sure you want to save this password?</h4>
                                                                </div>
                                                                <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary" style="background-color:#32CD32;border:none;">Confirm</button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!-- modal end -->
                            </div>
                        </div>
                    </form>
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
		
        @include('footer')
        <!--Custom JS-->
        <script src="js/custom.js"></script>
	</body>
</html>