<?php use Illuminate\Support\Facades\Auth;
	$user=Auth::check();
  $userphonenumber = Auth::user()->cust_phone_number;
  $userhomeaddress = Auth::user()->cust_address;
  $userprofilepicture = Auth::user()->profilepicture;
  // $userProfile=User::where(['id'=>$id]);
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

        <link rel="stylesheet" href="css/profilepage.css">

        <!-- For favicon png -->
		<link rel="shortcut icon" type="image/icon" href="logo/favicon.png"/>
       
        <!--font-awesome.min.css-->
        <link rel="stylesheet" href="css/profilepage.css">
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
        
        <!--responsive.css-->
        <link rel="stylesheet" href="css/responsive.css">
    </head>
	
	<body>
    <section id="user-profile" class="user-profile">
            <div class="container">
                <div class="section-header">
                    <h2><br> My Profile </h2>
                    <br>
                    <h3 style="color: #32CD32;"> Manage and secure your account! </h3>
                    
                </div><!--/.section-header-->
                <br>
                <hr>
                
                <br>
                <div class="row gutters-sm">
                      <div id="profileContainer" class="col-md-4 mb-3">
                          <div class="card" style="margin-top:25px">
                      <form action="updateUser/{{Auth::id()}}" method="POST" enctype="multipart/form-data">
                          <div class="card-body">
                              <div class="d-flex flex-column align-items-center text-center">
                                <div class="profileimage">
                                @if($userprofilepicture!=null)
                                <img src="{{URL::asset('storage/images/profilepic/'.$userprofilepicture)}}" alt="Admin" class="rounded-circle">
                                @else
                                <img src="{{url('/images/collection/profilepic.png')}}" alt="Admin" class="rounded-circle" style="max-width:100%;height:auto;border-radius:30%;float:center">
                                @endif
                              </div>
                              </div>
                                <!-- <div class="col-4">
                                  <button type="submit" style="border-color:#32CD32; background:#32CD32;">Update Picture</button>
                                </div> -->
                            {{ csrf_field() }}
                      </form>
                  </div>
                </div>
              <br>
              <div class="card mt-5">
              <ul id="profilepagelist">
                    <hr>
                    <li><a href="/order"> My Orders </a></li>
                    <hr>
                    <li><a href="cart"> My Cart </a></li>
                    <hr>
                    <li>
                        <a href="{{ route('logout') }}" data-toggle="modal" data-target="#exampleModalCenter">
												{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        <!-- modal here -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="margin-top:10%;">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header" style="text-align:center;">
                                                                    <h1 class="modal-title" id="exampleModalLongTitle" style="color:#32CD32;">IMPORTANT!</h1>
                                                                </div>
                                                                <div class="modal-body" style="text-align:center">
                                                                    <h4 autocapitalize="off" style="margin-top:5%;margin-bottom:5%;">Are you sure you want to logout?</h4>
                                                                </div>
                                                                <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary" style="background-color:#32CD32;border:none;">Confirm</button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                        <!-- modal end -->
                        @csrf
											  </form>
                    </li>
                    <hr>
              </ul>
              </div>
            </div>

            <div class="col-md-8" style="margin-top:25px ;box-shadow:2px 2px 4px; border-radius:3%;">
              <div class="card mb-3">
                <div class="card-body" style="margin-left:15px; margin-top:20px">
                  <br>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"> Full Name </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <h7 style="display:inline; color: #32CD32;font:sans-serif">{{Auth::user()->name}}</h7>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <h7 style="display:inline; color: #32CD32;font:sans-serif">{{Auth::user()->email}}</h7>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone Number</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        @if($userphonenumber!=null)
                        <h7 id="phone-number" style="display:inline; color: #32CD32;font:sans-serif">{{Auth::user()->cust_phone_number}}</h7>
                        @else
                        <h7 style="display:inline; color: #b9b9b9;font:sans-serif; font-style:italic;">Fill in your phone number!</h7>
                        @endif
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Home Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        @if($userhomeaddress!=null)
                        <h7 style="display:inline; color: #32CD32;font:sans-serif">{{Auth::user()->cust_address}}</h7>
                        @else
                        <h7 style="display:inline; color: #b9b9b9;font:sans-serif; font-style:italic;">Fill in your home address!</h7>
                        @endif
                    </div>
                  </div>
                  <hr>
                  <div id="user-profile-button" class="row">
                    <div class="col-sm-2">
                        <a href="/editUserProfile">
                            <button id="edit-profile-button" class="btn btn-primary btn-block text-uppercase">Edit Profile</button>
                        </a>
                    </div>
                    
                    <div class="col-sm-2">
                    <a href="/editPassword">
                            <button id="edit-password-button" class="btn btn-primary btn-block text-uppercase">Change Password</button>
                        </a>
                    </div>
                    <br><br><br><br>
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
	</body>
    <footer>
    @include('footer')
    </footer>
</html>