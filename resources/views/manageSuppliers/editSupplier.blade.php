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

<?php
use App\Models\Supplier;
$supplier = Supplier::where([ 'Supplier_ID' => $id ]);
?>

@include('admin/adminheader')


<div style="margin-top:130px; margin-left:260px;" class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12">
                <h2 class="tm-block-title d-inline-block">Edit Supplier</h2>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form action="/updateSupplier/{{$supplier->value('Supplier_ID')}}" method="POST" enctype="multipart/form-data">
                  <div class="form-group mb-3">
                    <label
                      for="name"
                      >Name
                    </label>
                    <input
                      id="name"
                      name="name"
                      type="text"
                      value="{{$supplier->value('Supplier_Name')}}"
                      class="form-control validate"
                      required
                      placeholder="Enter Name"
                    />
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="Address"
                      >Address</label
                    >
                    <textarea
                      id="Address"
                      name="Address"
                      class="form-control validate"
                      rows="3"
                      placeholder="Enter Address"
                      required
                    >{{$supplier->value('Supplier_Address')}}</textarea>
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="email"
                      >Email
                    </label>
                    <input
                      id="email"
                      name="email"
                      type="email"
                      placeholder="Enter Email"
                      class="form-control validate"
                      value="{{$supplier->value('Supplier_Email')}}"
                      required
                    />
                    </div>
                    <div class="form-group mb-3">
                    <label
                      for="phoneno"
                      >Mobile Number
                    </label>
                    <input
                      id="phoneno"
                      name="phoneno"
                      type="phoneno"
                      placeholder="Enter Mobile Number"
                      class="form-control validate"
                      value="{{$supplier->value('Supplier_PhoneNo')}}"
                      required
                    />
                   
                  </div>
                  
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                <div class="tm-product-img-dummy mx-auto">
                <img src="{{URL::asset('storage/images/suppliers/'.$supplier->value('Supplier_Image'))}}" id="imgTag" height="330px" width="400px" />
                </div>
                <div class="custom-file mt-3 mb-3">
                  <input onchange="readURL(this);" id="fileInput" type="file" style="display:none;" name="file">
                  <input  hidden id="img_Text" type="img_Text" value="0" name="img_Text">
                  <input
                    type="button"
                    class="btn btn-primary btn-block mx-auto"
                    style="border-color:#32CD32; background:#32CD32;"
                    value="UPLOAD SUPPLIER IMAGE"
                    onclick="document.getElementById('fileInput').click();"
                  />
                </div>
                </div>
                {{ csrf_field() }}
              <div class="col-12">
                <button type="submit" style="border-color:#32CD32; background:#32CD32;" class="btn btn-primary btn-block text-uppercase">Update Supplier</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
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
                                    </body>
                                    </html>