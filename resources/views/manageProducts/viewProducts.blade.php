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

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

    <div class="con">
    <div id="app">
        <nav style="position:fixed; top:0; left:0; z-index:9999; width: 100%; background: #000000; height: 80px; padding-left: 20px;" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div    class="container">
                <a style="color:#32CD32;" class="navbar-brand" href="{{ url('/') }}">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        
    </div>
</div>

 <!-- jQuery CDN - Slim version (=without AJAX) -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <link href="{{ asset('sass/test.css') }}" rel="stylesheet">


<div class="wrapper">

<!-- Sidebar -->

@include('admin/adminheader')


<!-- Page Content -->


<?php
use App\Models\Product;
use App\Models\Supplier;

$products=null;

$left="260px";

if($sort=="None"){
    $order="Product_ID";
    $x='asc';
}
else if($sort=="Alphabetical"){
    $order="Product_Name";
    $x='asc';
}
else if($sort=="PriceL"){
    $order="Product_Price";
    $x='asc';
}
else if($sort=="PriceH"){
    $order="Product_Price";
    $x='desc';
}
else if($sort=="QuantityL"){
    $order="Product_Quantity";
    $x='asc';
}
else if($sort=="QuantityH"){
    $order="Product_Quantity";
    $x='desc';
}

if($code==0)
{
    $products=Product::orderBy($order,$x)->get();
}
else if($code==1)
{
    $products=Product::where('Product_Type', 'Plant')->orderBy($order,$x)->get();    
}
else if($code==2)
{
    $products=Product::where('Product_Type', 'Soil')->orderBy($order,$x)->get();    
}
else if($code==3)
{
    $products=Product::where('Product_Type', 'Pot')->orderBy($order,$x)->get();    
}
else if($code==12)
{
    $products=Product::where('Product_Type', 'Plant')
    ->orWhere('Product_Type', 'Soil')
    ->orderBy($order,$x)->get();    
}
else if($code==13)
{
    $products=Product::where('Product_Type', 'Plant')
    ->orWhere('Product_Type', 'Pot')
    ->orderBy($order,$x)->get();    
}
else if($code==23)
{
    $products=Product::where('Product_Type', 'Soil')
    ->orWhere('Product_Type', 'Pot')
    ->orderBy($order,$x)->get();    
}
else if($code==123)
{
    $products=Product::where('Product_Type', 'Plant')
    ->orWhere('Product_Type', 'Soil')
    ->orWhere('Product_Type', 'Pot')
    ->orderBy($order,$x)->get();    
}


if($supp!="None")
{
    $prod=[];
    foreach($products as $product)
    {
        if($product->Product_Supplier==$supp)
        {
            array_push($prod,$product);
        }
    }
        $products=$prod;
}


if($search== "None")
    $displaysearch="";
else
{
    $displaysearch=$search;
    $newProducts=[];
    foreach($products as $product)
    {
        if(str_starts_with(strtolower($product->Product_Name),strtolower($search)))
            array_push($newProducts,$product);
    }
    $products=$newProducts;
}

if($products==null||count($products)==0)
{
    $left="261px";
}

$suppliers=Supplier::all();
$count=0;
?>

<div style="margin-left:{{$left}};" class="combine">
<br><br> 

<div class="d-flex justify-content-center h-100">
    <div class="search"> <input  onchange="searchProduct('{{$code}}','{{$supp}}','{{$sort}}')" id="searchBar" style="padding-left:10px; padding-right:590px; padding-bottom:6px; padding-top:4px;" type="text" class="search-input" placeholder="Enter Product Name...." value="{{$displaysearch}}"></a> <button onclick="location.href='{{ url('addProductForm') }}'" style="margin-left:10px; border-color:#32CD32; color:#32CD32;" type="button" onmouseover="this.style.background='#32CD32'; this.style.color='white';"  onmouseout="this.style.background='white'; this.style.color='#32CD32';" class="btn btn-outline-primary">Add New Product</button> </div>
</div>

<br>
<div style="padding-top:5px; height:40px; width:950px; background-color:#ebeaea;" class="container ">
    <div style="margin-left:-120px;" class="d-flex justify-content-center h-100">
        <p style="font-size:15px; color:#636262;">Filter Product Type: </p>
        @if(str_contains($code,'1'))
            <input style="margin-left:10px; margin-top:-3px;" type="checkbox" onchange="check('{{$supp}}','{{$sort}}','{{$search}}')" id="plant" name="age" value="30" checked>
            <label style="font-size:15px; color:#636262; margin-left:10px; margin-top:3px;" for="age1">Plant</label>
        @else
            <input style="margin-left:10px; margin-top:-3px;" type="checkbox"  onchange="check('{{$supp}}','{{$sort}}','{{$search}}')" id="plant" name="age" value="30">
            <label style="font-size:15px; color:#636262; margin-left:10px; margin-top:3px;" for="age1">Plant</label>
        @endif
        @if(str_contains($code,'2'))
            <input style="margin-left:10px; margin-top:-3px;" type="checkbox" onchange="check('{{$supp}}','{{$sort}}','{{$search}}')" id="soil" name="age" value="30" checked>
            <label style="font-size:15px; color:#636262; margin-left:10px; margin-top:3px;" for="age2">Soil</label>
        @else
            <input style="margin-left:10px; margin-top:-3px;" type="checkbox" onchange="check('{{$supp}}','{{$sort}}','{{$search}}')" id="soil" name="age" value="30">
            <label style="font-size:15px; color:#636262; margin-left:10px; margin-top:3px;" for="age2">Soil</label>
        @endif
        @if(str_contains($code,'3'))
            <input style="margin-left:10px; margin-top:-3px;" type="checkbox" onchange="check('{{$supp}}','{{$sort}}','{{$search}}')" id="pot" name="age" value="30" checked>
            <label style="font-size:15px; color:#636262; margin-left:10px; margin-top:3px;" for="age2">Pot</label>
        @else
            <input style="margin-left:10px; margin-top:-3px;" type="checkbox" onchange="check('{{$supp}}','{{$sort}}','{{$search}}')" id="pot" name="age" value="30">
            <label style="font-size:15px; color:#636262; margin-left:10px; margin-top:3px;" for="age2">Pot</label>
        @endif
        <p style="margin-left:50px; font-size:15px; color:#636262;">Filter Supplier: </p>
        <div style="font-size:15px; color:#636262; margin-left:10px;" class="dropdown">
            <button class="dropbtn123" style="text-overflow: ellipsis; white-space: nowrap; overflow:hidden; width:210px; height:24px;  padding-left:30px; padding-right:30px; margin-top:3px; border:none; position:absolute; padding-top:1px; padding-bottom:1px; font-size:13px; background-color:white; color:#636262;" type="button" id="dropdownMenuButton"  onclick="suppdrop()">
                {{$supp}}
            </button>
            <div id="suppDropdown" class="dropdown-content"  style="max-height:120px; overflow:auto; z-index:1; text-align:center; font-size:13px; margin-top:26.3px; display:none; position: absolute; background-color: white; width:210px;">
                    <div class="dropdown-divider"></div>
                    <a href="/manageProducts/{{$code}}/None/{{$sort}}/{{$search}}">None</a><br>
                @foreach ($suppliers as $supplier)
                    <div class="dropdown-divider"></div>
                    <a href="/manageProducts/{{$code}}/{{$supplier->Supplier_Name}}/{{$sort}}/{{$search}}">{{$supplier->Supplier_Name}}</a><br>
                @endforeach
                <div class="dropdown-divider"></div>
        </div>
          </div>
        <p style="margin-left:230px; font-size:15px; color:#636262;">Sort By: </p>
          <div style="font-size:15px; color:#636262; margin-left:10px;" class="dropdown">
            <button class="dropbtn1" style="text-overflow: ellipsis; white-space: nowrap; overflow:hidden; width:130px; height:24px;  padding-left:30px; padding-right:30px; margin-top:3px; border:none; position:absolute; padding-top:1px; padding-bottom:1px; font-size:13px; background-color:white; color:#636262;" type="button" id="dropdownMenuButton"  onclick="suppdrop1()">
                {{$sort}}
            </button>
            <div id="suppDropdown1" class="dropdown-content1"  style="height:120px; overflow:auto; z-index:3; text-align:center; font-size:13px; margin-top:26.3px; display:none; position: absolute; background-color: white; width:130px;">
                <div class="dropdown-divider"></div>
                <a href="/manageProducts/{{$code}}/{{$supp}}/None/{{$search}}">None</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageProducts/{{$code}}/{{$supp}}/Alphabetical/{{$search}}">Alphabetical</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageProducts/{{$code}}/{{$supp}}/PriceL/{{$search}}">Price - Low</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageProducts/{{$code}}/{{$supp}}/PriceH/{{$search}}">Price - High</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageProducts/{{$code}}/{{$supp}}/QuantityL/{{$search}}">Quantity - Low</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageProducts/{{$code}}/{{$supp}}/QuantityH/{{$search}}">Quantity - High</a><br>
                <div class="dropdown-divider"></div>
        </div>
          </div>
    </div>
  </div>
<script type="text/javascript">
    window.scrollTo(0, 0);
function searchProduct(code,supp,sort)
{
    if((document.getElementById("searchBar").value).trim()=="")
    {
        var link= "/manageProducts/"+code+"/"+supp+"/"+sort+"/None";
    }else{
        var link= "/manageProducts/"+code+"/"+supp+"/"+sort+"/"+document.getElementById("searchBar").value;
    }
    document.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            location.replace(link);
        }
    });
}

const checkbox1 = document.getElementById('plant');
const checkbox2 = document.getElementById('soil');
const checkbox3 = document.getElementById('pot');


function check(supp,sort,search)
{
    var checked="";
    if(checkbox1.checked==true)
    {
        checked=checked+"1";
    }
    if(checkbox2.checked==true)
    {
        checked=checked+"2";
    }
    if(checkbox3.checked==true)
    {
        checked=checked+"3";
    }

    if(checked=="")
    {
        checked="0";
    }
    location.replace('/manageProducts/'+checked+'/'+supp+'/'+sort+'/'+search);
}


function suppdrop()
{
    var display= document.getElementById("suppDropdown").style.display;
    if(display=="none")
    {
        document.getElementById("suppDropdown").style.display = "block";
    }else{
        document.getElementById("suppDropdown").style.display = "none";
    }
}

window.onclick = function(event) {
    var display= document.getElementById("suppDropdown").style.display;
    var display1= document.getElementById("suppDropdown1").style.display;
  if (!event.target.matches('.dropbtn123')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (display=="block") {
        document.getElementById("suppDropdown").style.display = "none";
      }
    }
  }

  if (!event.target.matches('.dropbtn1')) {
    var dropdowns = document.getElementsByClassName("dropdown-content1");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (display1=="block") {
        document.getElementById("suppDropdown1").style.display = "none";
      }
    }
  }

}

function suppdrop1()
{
    var display= document.getElementById("suppDropdown1").style.display;
    if(display=="none")
    {
        document.getElementById("suppDropdown1").style.display = "block";
    }else{
        document.getElementById("suppDropdown1").style.display = "none";
    }
}


</script>


<div style="width:1600px; margin-left=-120px;" class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            
            @foreach($products as $product)

            @php
                $img=Str::substr($product->Product_Image, 0, 44);   
            @endphp

            <div class="row p-2 bg-white border rounded">
                <div class="col-md-3 mt-1"><img  style="width:300px; height: 190px;" class="img-fluid img-responsive rounded product-image" src="{{URL::asset('storage/images/products/'.$img)}}"></div>
                <div class="col-md-6 mt-1">
                <h4>{{$product->Product_Name}}</h4>
                    <div class="mt-1 mb-1 spec-1"><span style="font-size:17px;">Type Of {{$product->Product_Type}}</span><span style="background:#32CD32" class="dot"></span><span style="font-size:17px;">RM {{$product->Product_Price}}</div>
                    <div class="mt-1 mb-1 spec-1"><span style="font-size:17px;">Supplied By {{$product->Product_Supplier}}</span></div>
                    <p style="color:black;" class="text-justify text-truncate para mb-0">{{$product->Product_Desc}}<br><br></p>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    
                <div style="text-align:center"><h4 style="color:red;"><span style="color:#32CD32;">In Stock: </span>{{$product->Product_Quantity}} </h4></div>

                {{-- <div class="d-flex flex-row align-items-center">
                    </div> --}}
                    {{-- <a style="padding-left:44px; padding-right:44px; border-color:#32CD32; background:#32CD32" href="/increaseQuantity/{{ $product->Product_ID }}" class="btn btn-primary btn-sm" >+</a> --}}
                    {{-- <a style="padding-left:44px; padding-right:44px; border-color:#32CD32; background:#32CD32" href="/decreaseQuantity/{{ $product->Product_ID }}"  class="btn btn-primary btn-sm" >-</a> --}}
                    <div class="container py-4">
                        <div class="row">
                            <div>
                                <div style="bottom:15%" class="input-group">
                                    <span class="input-group-prepend">
                                        <button type="button" onmouseover="this.style.background='#32CD32'; this.style.color='white';" onmouseout="this.style.background='white'; this.style.color='#32CD32';" style="  padding-left:12px; padding-right:12px; bottom:17%; height:38px; border-color:#32CD32; color:#32CD32;" class="btn btn-outline-primary btn-sm mt-2" onclick="decreaseFunction('{{$product->Product_ID}}')" data-type="minus" data-field="quant[1]">
                                            <span class="fa fa-minus"> </span>
                                        </button>
                                        <input onchange="changeQuantity('{{$product->Product_ID}}',{{$count}})" id="inputBar{{$count}}" style="border-radius:0px; text-align: center;" type="text" name="quant[1]" class="form-control input-number" value="{{$product->Product_Quantity}}">
                                        <button type="button" onmouseover="this.style.background='#32CD32'; this.style.color='white';" onmouseout="this.style.background='white'; this.style.color='#32CD32';" style="  padding-left:12px; padding-right:12px; bottom:17%; border-color:#32CD32; color:#32CD32;" class="btn btn-outline-primary btn-sm mt-2" onclick="increaseFunction('{{$product->Product_ID}}')" data-type="minus" data-field="quant[1]">
                                            <span class="fa fa-plus"> </span>
                                        </button>
                                    </span>
                                    
                                    {{-- <a  id="confirm" hidden style="padding-left:80px; padding-right:80px; border-color:red; background:red"  class="btn btn-primary btn-sm" href="">Confirm</a> --}}
                                </div>
                              <a style="padding-left:93px; padding-right:93px; border-color:#32CD32; background:#32CD32"  class="btn btn-primary btn-sm" href="/editProduct/{{ $product->Product_ID }}">Edit</a> 
                              <br><a onmouseover="this.style.background='#32CD32'; this.style.color='white';"  onmouseout="this.style.background='white'; this.style.color='#32CD32';" style="padding-left:84px; padding-right:84px; border-color:#32CD32; color:#32CD32;" class="btn btn-outline-primary btn-sm mt-2" data-target="#Sreason1{{$count}}" data-toggle="modal" >Delete</a>

                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <script type="text/javascript">
            function myFunction() 
                {
                    if (confirm("Are you sure you want to continue?")) {

                    return true;

                    } else {

                        return false;
                    }

                }

                function increaseFunction(z)
                {
                    // var x=document.getElementById("inputBar").value;
                    // y=parseInt(x)+1;
                    // document.getElementById("inputBar").value=y;
                    // document.getElementById("confirm").removeAttribute("hidden");
                    location.replace("/increaseQuantity/"+z);
                }

                function decreaseFunction(z)
                {
                    // var x=document.getElementById("inputBar").value;
                    // y=parseInt(x)-1;
                    // document.getElementById("inputBar").value=y;
                    location.replace("/decreaseQuantity/"+z);
                }

                function changeQuantity(z,count)
                {
                    var x=document.getElementById("inputBar"+count).value;
                    if (confirm("Are you sure you want to continue?")) {

                        location.replace("/changeQuantity/"+z+"/"+x);

                            } else {

                                return false;
                            }

                }

               
                
               

             </script>
            <br>

            



          
<div class="container d-flex justify-content-center mt-100">
    <div style="background-color:rgba(0, 0, 0, 0.5);" class="modal fade" id="Sreason1{{$count}}">
        <div style="width:500px; margin-top:300px; margin-left:570px;" class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h6 style="font-size:17px; padding-left:170px; color:#25D366" class="modal-title">IMPORTANT!</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div> <!-- Modal body -->
                <div style="font-size:13px;" class="modal-body">
                    <p style="color:dimgray; font-size:15px;">Are You Sure You Want To Remove This Product?</p>
                </div>
                    <p id="itemID" hidden></p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onClick="location.href='/deleteProduct/{{ $product->Product_ID }}'" id="rmvAdmin" data-dismiss="modal">Confirm</button>
                    <button type="button" style="border:red; background-color:red;" class="btn btn-success" data-dismiss="modal">Deny</button>
                </div>
            </div>
        </div>
    </div>
</div>

@php
$count+=1;
@endphp


            @endforeach

            <?php $p=Product::all();?>
            @if(count($p)==0)
            <div style="left:40%" class="col-md-3 mt-1"><img  style="" class="img-fluid img-responsive rounded product-image" src="{{URL::asset('storage/images/product.png')}}"></div>
            <br/> <br/>
            <h1 style="margin-left: 20%">No Products Exist In The Database!</h1>
            @elseif (count($products)==0)
            <div style="left:35%" class="col-md-3 mt-1"><img  style="" class="img-fluid img-responsive rounded product-image" src="{{URL::asset('storage/images/magGlass.png')}}"></div>
            <br/> <br/>
            <h1 style="margin-left: 25%">No Results Were Found!</h1>
            @endif

        </div>
    </div>
</div>
<div>
</div>  





            </body>
            </html>