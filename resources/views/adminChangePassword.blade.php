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
               
        <div class="col-md-12 col-md-offset-2" >
            <div class="panel panel-default">
                <div class="panel-body" style="box-shadow:2px 2px 4px;padding:20px 10px 10px 10px;">
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
                    <form class="form-horizontal" method="POST" action="{{ route('changeAdminPassword') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <div class="row">
                            <label for="new-password" class="col-md-3 control-label" style="color:#696969;font:sans-serif;margin-left:10px">Current Password</label>
                            <div class="col-md-6">
                                <input id="current-password" type="password" class="form-control" name="current-password" required>
                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <div class="row">
                            <label for="new-password" class="col-md-3 control-label" style="color:#696969;font:sans-serif;margin-left:10px">New Password</label>
                            <div class="col-md-6">
                                <input id="new-password" type="password" class="form-control" name="new-password" required>

                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="row">
                            <label for="new-password-confirm" class="col-md-3 control-label" style="color:#696969;font:sans-serif;margin-left:10px">Confirm New Password</label>
                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                            </div>
                        </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-4">
                            <a href="/editUserProfile">
                                <button style="border-color:#32CD32; background:#32CD32;" class="btn btn-primary btn-block text-uppercase">Change Password</button>
                            </a>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>



            </body>
            </html>