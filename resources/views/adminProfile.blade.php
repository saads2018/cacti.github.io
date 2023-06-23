<?php use Illuminate\Support\Facades\Auth;
	$user=Auth::check();
    $userphonenumber = Auth::user()->cust_phone_number;
    $userhomeaddress = Auth::user()->cust_address;
    $userprofilepicture = Auth::user()->profilepicture;
    // $userProfile=User::where(['id'=>$id]);
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/viewProductsAdmin.css') }}" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
   
 <!-- jQuery CDN - Slim version (=without AJAX) -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <link href="{{ asset('sass/test.css') }}" rel="stylesheet">


    @include('admin/adminheader')


<!-- Page Content -->
<div style="margin-left=-120px;" class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
                <div>
                  <br><br>
                    <h2><br> Admin Profile </h2>
                   
                    <!-- <h3 style="color: #32CD32;"> Manage and secure your account! </h3> -->
                    
                </div><!--/.section-header-->
                <br>
                <hr>
                <br>
            <div class="col-md-12" style="margin-top:25px ;">
              <div class="card mb-3">
                <div class="card-body" style="margin-left:15px; margin-top:20px;">
                  
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"> Full Name </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <h7 style="display:inline; color: #32CD32;font:sans-serif">{{ Auth::user()->name }}</h7>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <h7 style="display:inline; color: #32CD32;font:sans-serif">{{ Auth::user()->email }}</h7>
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
                      <h6 class="mb-0">Business Address</h6>
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
                  <div class="row">
                    <div class="col-sm-3">
                        <a href="/adminProfileEdit">
                            <button style="border-color:#32CD32; background:#32CD32;" class="btn btn-primary btn-block text-uppercase">Edit Profile</button>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a href="/adminChangePassword">
                            <button style="border-color:#32CD32; background:#32CD32;" class="btn btn-primary btn-block text-uppercase">Change Password</button>
                        </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</div>
</div>



            </body>
            </html>