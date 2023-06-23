<?php 

use App\Models\Notification;
?>
<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cacti Succulent Admin') }}</title>
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/linearicons.css">
    <link rel="stylesheet" href="/css/adminHeader.css" >	
    <link rel="stylesheet" href="/css/styleScroll.css" >	


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/viewProductsAdmin.css') }}" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

</head>
<body >
    

 <!-- jQuery CDN - Slim version (=without AJAX) -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <link href="{{ asset('sass/test.css') }}" rel="stylesheet">

<div class="con">
    <div id="app">
        <nav style="position:fixed; top:0; left:0; z-index:9999; width: 100%; background: #000000; height: 80px; padding-left: 0px;" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a style="color:#32CD32;" class="navbar-brand" href="{{ url('/dashboard') }}">
                    Cacti Succulent KCH
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-success mr-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-success" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        <!-- Notification Starts Here -->

                                    <?php
									$notifications=Notification::all();

									$count=0;
                                    $not=[];

									foreach($notifications as $n)
									{
										if($n->status=="unseen" && $n->type=="admin" && str_contains($n->admins, Auth::user()->id.','))
										{
											$count+=1;
                                            array_push($not,$n);
										}
									}

									?>

                                    <!-- Notification Counter -->

                                    <li class="dropdown">
									<a href="#"  class="data-toggle" data-toggle="dropdown" data-target="#cartdrop" style="font-size:18px;"><span class="lnr lnr-alarm"></span>
										@if($count != 0)
											<span class="badge badge-bg-1" aria-hidden="true" style="color:white;background-color:#32CD32;">{{ $count }}</span>
										@endif
									</a>

									@if($count != 0)
										<ul id="cartdrop" class="dropdown-menu cart-list s-cate" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
											@foreach($not as $notification)
                                            @if($notification['type']=="admin")
												@php
													$img="images/homepage/".$notification['photo'].".png"
												@endphp
												<li class="single-cart-list">

                                                <!-- <a href="#" class="photo"><img src="images/homepage/processing.png" class="cart-thumb" alt="image" /></a> -->
													<div class="cart-list-txt">
                                                        
														<h2 style="font-size:15px;padding:10px 5px 0px 5px;">{{$notification['title']}}</h6>
														<h6 style="font-size:12px;padding:10px 5px 0px 5px;">{{$notification['message']}}</h6>
                                                        <a href="{{ url('/deleteNotificationAdmin'.'/'.$notification['id'].'/'.Auth::user()->id) }}" class="lnr lnr-cross" role="button" style="  font-weight: bold;color:white;"></a>
													</div>
                                                    <hr>
												</li><!--/.single-cart-list -->
												@endif
											@endforeach
                                            <li class="total">
												<button class="btn-cart pull-right" style="border-radius:25px; width:100%;border:none;"><a href="{{ url('/deleteNotificationAllAdmin'.'/'.Auth::user()->id) }}" >Clear All Notifications</a></button>
                                                <br>
                                            </li>
									@endif
                                    </ul>
								</li>
                                <!-- notification end here -->
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

 

<div class="wrapper">

<!-- Sidebar -->
<nav id="sidebar">
        <div class="sidebar-header">
            <h4>Admin Management</h4>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                @if(Auth::check())
                <h2 style="margin-left:10px;font-size:15px">Name: {{ Auth::user()->name }}</h2>
                @else
                <h2 style="margin-left:10px;font-size:15px">Your Are Not Logged In</h2>
                @endif
                <hr>
                @if(Auth::user()->user_type=="admin")
                <h2 style="margin-left:10px;font-size:15px">Role : Admin</h2>
                @elseif(Auth::user()->user_type=="super_admin")
                <h2 style="margin-left:10px;font-size:15px">Role : Super Admin</h2>
                @endif
            </div>
        </div>
        <div>
        <ul class="list-unstyled components">
            <li>
                <a href="/admin"> <span class="material-icons md-48" style="vertical-align: middle;">dashboard</span>  Dashboard</a>
            </li>
            <li>
                <a href="/manageAdmin"> <span class="material-icons md-48" style="vertical-align: middle;">people_alt</span>  Manage Admin</a>
            </li>
            <li>
                <a href="/manageProducts/0/None/None/None"> <span class="material-icons md-48" style="vertical-align: middle;">shopping_bag</span>  Manage Products</a>
            </li>
            <li>
                <a href="/manageSuppliers/0/None/None/None"> <span class="material-icons md-48" style="vertical-align: middle;">factory</span>  Manage Suppliers</a>
            </li>
            <li>
                <a href="/manageOrders/0/None/None/None/0"> <span class="material-icons md-48" style="vertical-align: middle;">directions_car_filled</span>  Manage Orders</a>
            </li>
            @if(Auth::check())
            <li>
                <a href="/adminProfile"> <span class="material-icons md-48" style="vertical-align: middle;">manage_accounts</span>  Profile Page</a>
            </li>
            @endif
            <div class="sidebar-footer">
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
															document.getElementById('logout-form').submit();"><span class="material-icons md-48" style="vertical-align: middle;">logout</span>
												{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
												@csrf
											</form></a>
            </li>
            </div>
        </ul>
        </div>
</nav>

</body>
</html>
