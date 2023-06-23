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
                    <h2><br>Edit Admin Profile </h2>
                    
                    <!-- <h3 style="color: #32CD32;"> Manage and secure your account! </h3> -->
                    
                </div><!--/.section-header-->
                <br>
                <hr>
                <br>
        <form action="updateAdmin/{{Auth::id()}}" method="POST" enctype="multipart/form-data">
            <div class="col-md-12" style="margin-top:25px ;">
              <div class="card mb-3">
                <div class="card-body" style="margin-left:15px; margin-top:20px;">
                  <br>
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
					          <input id="cust_phone_number" name="customer_phone_number" type="text" class="form-control" value="{{Auth::user()->cust_phone_number}}">
                      @if($errors->has('cust_phone_number'))
                      <div class="error">{{ $errors->first('cust_phone_number') }}</div>
                      @endif
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Business Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
					          <input id="cust_address" name="cust_address" type="text" class="form-control" value="{{Auth::user()->cust_address}}">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                        
                            <button type="button" data-toggle="modal" data-target="#exampleModalCenter" style="border-color:#32CD32; background:#32CD32;" class="btn btn-primary btn-block text-uppercase">Save Edit</button>
                        
                        <!-- modal here -->
                      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="margin-top:1%;">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header" style="text-align:center;">
                                                                    <h1 class="modal-title" id="exampleModalLongTitle" style="color:#32CD32;margin-left:28%">IMPORTANT!</h1>
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
                </div>
              </div>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
    </div>
</div>


            </body>
            </html>