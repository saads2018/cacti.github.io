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


<?php
use App\Models\Product;
use App\Models\Supplier;

$suppliers=[];
$products=Product::all();
$allSupp=[];

$left="260px";

if($sort=="None"){
     $allSupp=Supplier::orderBy("Supplier_ID","asc")->get();
     $displaysort="None";
}
else if($sort=="Alphabetical"){
    $allSupp=Supplier::orderBy("Supplier_Name","asc")->get();
    $displaysort="Alphabetical";
}
else if($sort=="PrSL"){
    $allSupp=Supplier::orderBy("Products_Supplied","asc")->get();
    $displaysort="Products Supplied - Low";
}
else if($sort=="PrSH"){
    $allSupp=Supplier::orderBy("Products_Supplied","desc")->get();
    $displaysort="Products Supplied - High";
}

if($code==0)
{
    $suppliers=$allSupp;
}
else if($code==1)
{
    foreach($allSupp as $supplier)
    {
        foreach($products as $product)
        {
            if($product->Product_Type=="Plant" and $supplier->Supplier_Name==$product->Product_Supplier)
            {
                array_push($suppliers,$supplier);
                break;
            }
        } 
    } 
}
else if($code==2)
{
    foreach($allSupp as $supplier)
    {
        foreach($products as $product)
        {
            if($product->Product_Type=="Soil" and $supplier->Supplier_Name==$product->Product_Supplier)
            {
                array_push($suppliers,$supplier);
                break;
            }
        } 
    } 
}
else if($code==3)
{
    foreach($allSupp as $supplier)
    {
        foreach($products as $product)
        {
            if($product->Product_Type=="Pot" and $supplier->Supplier_Name==$product->Product_Supplier)
            {
                array_push($suppliers,$supplier);
                break;
            }
        } 
    } 
}
else if($code==12)
{
    foreach($allSupp as $supplier)
    {
        foreach($products as $product)
        {
            if(($product->Product_Type=="Plant" or $product->Product_Type=="Soil") and $supplier->Supplier_Name==$product->Product_Supplier)
            {
                array_push($suppliers,$supplier);
                break;
            }
        } 
    }     
}
else if($code==13)
{
    foreach($allSupp as $supplier)
    {
        foreach($products as $product)
        {
            if(($product->Product_Type=="Plant" or $product->Product_Type=="Pot") and $supplier->Supplier_Name==$product->Product_Supplier)
            {
                array_push($suppliers,$supplier);
                break;
            }
        } 
    }        
}
else if($code==23)
{
    foreach($allSupp as $supplier)
    {
        foreach($products as $product)
        {
            if(($product->Product_Type=="Pot" or $product->Product_Type=="Soil") and $supplier->Supplier_Name==$product->Product_Supplier)
            {
                array_push($suppliers,$supplier);
                break;
            }
        } 
    }       
}
else if($code==123)
{
    foreach($allSupp as $supplier)
    {
        foreach($products as $product)
        {
            if(($product->Product_Type=="Plant" or $product->Product_Type=="Pot" or $product->Product_Type=="Soil") and $supplier->Supplier_Name==$product->Product_Supplier)
            {
                array_push($suppliers,$supplier);
                break;
            }
        } 
    }   
}

if($search== "None")
    $displaysearch="";
else
{
    $displaysearch=$search;
    $newSuppliers=[];
    foreach($suppliers as $supplier)
    {
        if(str_starts_with(strtolower($supplier->Supplier_Name),strtolower($search)))
            array_push($newSuppliers,$supplier);
    }
    $suppliers=$newSuppliers;
}



if($suppliers==null||count($suppliers)==0)
{
    $left="261px";
}

$count=0;
?>

<div class="combine">
<br><br> 

<div class="d-flex justify-content-center h-100">
    <div class="search"> <input  onchange="searchSupplier('{{$code}}','{{$supp}}','{{$sort}}')" id="searchBar" style="margin-left:95px; padding-left:10px; padding-right:590px; padding-bottom:6px; padding-top:4px;" type="text" class="search-input" placeholder="Enter Supplier Name...." value="{{$displaysearch}}"></a> <button onclick="location.href='{{ url('addSupplierForm') }}'" style="margin-left:10px; border-color:#32CD32; color:#32CD32;" type="button" onmouseover="this.style.background='#32CD32'; this.style.color='white';"  onmouseout="this.style.background='white'; this.style.color='#32CD32';" class="btn btn-outline-primary">Add New Supplier</button> </div>
</div>

<br>

<div style="margin-left:95px; padding-top:5px; height:40px; width:950px; background-color:#ebeaea;" class="container ">
    <div style="margin-left:-250px;" class="d-flex justify-content-center h-100">
        <p style="font-size:15px; color:#636262;">Filter Types of Products Supplied: </p>
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
        
        <p style="margin-left:100px; font-size:15px; color:#636262;">Sort Supplier By: </p>
          <div style="font-size:15px; color:#636262; margin-left:10px;" class="dropdown">
            <button class="dropbtn1" style="text-overflow: ellipsis; white-space: nowrap; overflow:hidden; width:250px; height:24px;  padding-left:30px; padding-right:30px; margin-top:3px; border:none; position:absolute; padding-top:1px; padding-bottom:1px; font-size:13px; background-color:white; color:#636262;" type="button" id="dropdownMenuButton"  onclick="suppdrop1()">
                {{$displaysort}}
            </button>
            <div id="suppDropdown1" class="dropdown-content1"  style="height:120px; overflow:auto; z-index:3; text-align:center; font-size:13px; margin-top:26.3px; display:none; position: absolute; background-color: white; width:250px;">
                <div class="dropdown-divider"></div>
                <a href="/manageSuppliers/{{$code}}/{{$supp}}/None/{{$search}}">None</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageSuppliers/{{$code}}/{{$supp}}/Alphabetical/{{$search}}">Alphabetical</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageSuppliers/{{$code}}/{{$supp}}/PrSL/{{$search}}">Products Supplied - Low</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageSuppliers/{{$code}}/{{$supp}}/PrSH/{{$search}}">Products Supplied - High</a><br>
                <div class="dropdown-divider"></div>
        </div>
          </div>
    </div>
  </div>


<script type="text/javascript">
    window.scrollTo(0, 0);
function searchSupplier(code,supp,sort)
{
    if((document.getElementById("searchBar").value).trim()=="")
    {
        var link= "/manageSuppliers/"+code+"/"+supp+"/"+sort+"/None";
    }else{
        var link= "/manageSuppliers/"+code+"/"+supp+"/"+sort+"/"+document.getElementById("searchBar").value;
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
    location.replace('/manageSuppliers/'+checked+'/'+supp+'/'+sort+'/'+search);
}

window.onclick = function(event) {
    var display1= document.getElementById("suppDropdown1").style.display;

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



<div style="margin-left=-120px;" class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            @foreach($suppliers as $supplier)
            <div style="margin-left:-5px; width:960px;" class="row p-2 bg-white border rounded">
                <div class="col-md-3 mt-1"><img  style="width:300px; height: 150px;" class="img-fluid img-responsive rounded product-image" src="{{URL::asset('storage/images/suppliers/'.$supplier->Supplier_Image)}}"></div>
                <div class="col-md-6 mt-1">
                    <h4>{{$supplier->Supplier_Name}}</h4>
                    <div class="mt-1 mb-1 spec-1"><span style="font-size:17px;">Email: {{$supplier->Supplier_Email}}</span><span style="background:#32CD32" class="dot"></span><span style="font-size:17px;">Mobile: {{$supplier->Supplier_PhoneNo}}
                    <span style="background:#32CD32" class="dot"></span><span style="font-size:17px;">Number of Products Being Supplied: {{$supplier->Products_Supplied}}</div>
                    <p style="color:black;" class="text-justify text-truncate para mb-0">Address: {{$supplier->Supplier_Address}}<br><br></p>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <br/>    
                    <div class="d-flex flex-column mt-4"><a style="border-color:#32CD32; background:#32CD32"  class="btn btn-primary btn-sm" href="/editSupplier/{{ $supplier->Supplier_ID }}">Edit</a><a onmouseover="this.style.background='#32CD32'; this.style.color='white';"  onmouseout="this.style.background='white'; this.style.color='#32CD32';" style="border-color:#32CD32; color:#32CD32;" class="btn btn-outline-primary btn-sm mt-2" data-toggle="modal" data-target="#Sreason1{{$count}}">Delete</a></div>
                </div>
            </div>
                <script type="text/javascript">
                function myFunction() 
                {
                    if (confirm("All products sold by this supplier will be deleted as well. Are you sure you want to continue?")) {

                    return true;

                    } else {

                        return false;
                    }

                }
             </script>
            <br>


            <div class="container d-flex justify-content-center mt-100">
                <div style="background-color:rgba(0, 0, 0, 0.5);" class="modal fade" id="Sreason1{{$count}}">
                    <div style="width:500px; margin-top:280px; margin-left:570px;" class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h6 style="font-size:17px; padding-left:170px; color:#25D366" class="modal-title">IMPORTANT!</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div> <!-- Modal body -->
                            <div style="font-size:13px;" class="modal-body">
                                <p style="color:dimgray; font-size:15px;">Are You Sure You Want To Remove This Supplier? The Following Products Will Be Deleted As Well:</p>
                                @foreach($products as $product)
                                    @if($product->Product_Supplier==$supplier->Supplier_Name)
                                        <p style=" display: inline; text-align:center; color:dimgray; font-size:15px;">{{$product->Product_Name}}</p><br>
                                    @endif
                                @endforeach
                            </div>
                                <p id="itemID" hidden></p>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" onClick="location.href='/deleteSupplier/{{ $supplier->Supplier_ID }}'" id="rmvAdmin" data-dismiss="modal">Confirm</button>
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

            <?php $p=Supplier::all();?>
            @if(count($p)==0)
            <div style="left:45%" class="col-md-3 mt-1"><img  style="" class="img-fluid img-responsive rounded product-image" src="{{URL::asset('storage/images/supplier.png')}}"></div>
            <br/> <br/>
            <h1 style="margin-left: 20%">No Suppliers Exist In The Database!</h1>
            @elseif (count($suppliers)==0)
            <div style="left:40%" class="col-md-3 mt-1"><img  style="" class="img-fluid img-responsive rounded product-image" src="{{URL::asset('storage/images/magGlass.png')}}"></div>
            <br/> <br/>
            <h1 style="margin-left: 30%">No Results Were Found</h1>
            @endif
        </div>
    </div>
</div>
<div>
</div>  

            </body>
            </html>