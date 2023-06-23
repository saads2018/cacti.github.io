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

        <script src="{{ asset('js/app.js') }}" defer></script>
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
	<section id="user-profile" class="user-profile">
            <div class="container">
                <div class="section-header">
                    <h2><br>My Profile</h2>
                    <br>
                    <h3 style="color: #32CD32;"> Manage and secure your account! </h3>
                </div><!--/.section-header-->
                <br>
                <br>
                <br>
                <div class="row gutters-sm">
                      <div id="profileContainer" class="col-md-4 mb-3">
                          <div class="card" style="margin-top:25px">
                        <form action="updateUser/{{Auth::id()}}" method="POST" enctype="multipart/form-data">
                          <div>
                              <div class="d-flex flex-column align-items-center text-center">
                              <img src="{{URL::asset('storage/images/profilepic/'.$userprofilepic)}}" id="imgTag" alt="UserProfile" class="rounded-circle" style="max-width:200px;max-height:200px;float:center;border-radius:100%">
                              </div>
                              <br>

                            <div class="custom-file mt-3 mb-3">
                                <input onchange="readURL(this);" id="fileInput" type="file" style="display:none;" name="profilepicture">
                                <input  hidden id="img_Text" type="img_Text" value="0" name="img_Text">
                                <div class="col-sm-12">
                                <input
                                    type="button"
                                    class="btn btn-primary btn-block mx-auto"
                                    style="border-color:#32CD32; background:#32CD32;"
                                    value="Choose Profile Photo"
                                    onclick="document.getElementById('fileInput').click();"
                                />
                                @if($errors->has('profilepicture'))
                                    <div class="error">{{ $errors->first('profilepicture') }}</div>
                                @endif
                                </div>
                              </div>
                                <!-- <div class="col-4">
                                  <button type="submit" style="border-color:#32CD32; background:#32CD32;">Update Picture</button>
                                </div> -->
                  </div>
                </div>
              <br>
            </div>
            <script type="text/javascript">
                                    function readURL(input) {
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();
                                                
                                                reader.onload = function (e) {
                                                    $('#imgTag').attr('src', e.target.result);
                                                }
                                                reader.readAsDataURL(input.files[0]);
                                            }
                                            var img_File_text=document.getElementById("img_Text");
                                            img_File_text.value="1";
                                        }
                                        $("#fileInput").change(function(){
                                            readURL(this);
                                        });
                                    </script>

            <div class="col-md-8" style="margin-top:25px ;box-shadow:2px 2px 4px; border-radius:3%;">
              <div class="card mb-3">
                <div class="card-body" style="margin-left:15px; margin-top:20px">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
					            <input id="name" name="name" type="text" class="form-control" value="{{Auth::user()->name}}">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
					          <input id="email" name="email" type="email" class="form-control" value="{{Auth::user()->email}}">
                    @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone Number</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
					          <input id="cust_phone_number" name="cust_phone_number" type="number" class="form-control" value="{{Auth::user()->cust_phone_number}}">
                      @if($errors->has('cust_phone_number'))
                        <div class="error">{{ $errors->first('cust_phone_number') }}</div>
                      @endif
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Home Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
					            <input id="cust_address" name="cust_address" type="text" class="form-control" value="{{Auth::user()->cust_address}}">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <button type="button" style="border-color:#32CD32; background:#32CD32;" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary">Save</button>
                      <!-- modal here -->
                      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="margin-top:10%;">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header" style="text-align:center;">
                                                                    <h1 class="modal-title" id="exampleModalLongTitle" style="color:#32CD32;">IMPORTANT!</h1>
                                                                </div>
                                                                <div class="modal-body" style="text-align:center">
                                                                    <h4 autocapitalize="off" style="margin-top:5%;margin-bottom:5%;">Are you sure you want to save?</h4>
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
                    <br><br>
                  </div>
                </div>
              </div>
              {{ csrf_field() }}
              </form>
              <br>
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