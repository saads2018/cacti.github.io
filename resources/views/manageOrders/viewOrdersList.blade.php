<?php
$count=1;
$dateCount=1;
$currentdateCount=1;
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cacti Manage Orders') }}</title>
    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/viewProductsAdmin.css') }}" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    

</head>
<body onload="showModal({{$modal}})">
   @include('admin/adminheader')

 <!-- jQuery CDN - Slim version (=without AJAX) -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
   
    <link href="{{ asset('sass/test.css') }}" rel="stylesheet">




    <?php
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Supplier;


$users=User::all();
$suppliers=Supplier::all();
$o1=Order::all();


$orders=[];
date_default_timezone_set("Asia/Kuching");

$left="260px";

if($sort=="None"){
    $orderBy="order_Id";
    $x='desc';
}
else if($sort=="Latest Orders"){
    $orderBy="orderMadeDate";
    $x='desc';
}
else if($sort=="Upcoming Due Date"){
    $orderBy="shippingEndDate";
    $x='desc';
}
else if($sort=="Order Total - Low"){
    $orderBy="grand_total";
    $x='asc';
}
else if($sort=="Order Total - High"){
    $orderBy="grand_total";
    $x='desc';
}
else if($sort=="No. of Items - Low"){
    $orderBy="item_count";
    $x='asc';
}
else if($sort=="No. of Items - High"){
    $orderBy="item_count";
    $x='desc';
}

if($code==0)
{
    $orders=Order::orderBy($orderBy,$x)->get();
}
else if($code==1)
{
    $orders=Order::where('delivery_type', 'homeDelivery')->orderBy($orderBy,$x)->get();    
}
else if($code==2)
{
    $orders=Order::where('delivery_type', 'pickUp')->orderBy($orderBy,$x)->get();    
}
else if($code==3)
{
    $orders=Order::where('delivery_type', 'remotePickUp')->orderBy($orderBy,$x)->get();    
}
else if($code==12)
{
    $orders=Order::where('delivery_type', 'homeDelivery')
    ->orWhere('delivery_type', 'pickUp')
    ->orderBy($orderBy,$x)->get();    
}
else if($code==13)
{
    $orders=Order::where('delivery_type', 'homeDelivery')
    ->orWhere('delivery_type', 'remotePickUp')
    ->orderBy($orderBy,$x)->get();    
}
else if($code==23)
{
    $orders=Order::where('delivery_type', 'pickUp')
    ->orWhere('delivery_type', 'remotePickUp')
    ->orderBy($orderBy,$x)->get();    
}
else if($code==123)
{
    $orders=Order::where('delivery_type', 'homeDelivery')
    ->orWhere('delivery_type', 'pickUp')
    ->orWhere('delivery_type', 'remotePickUp')
    ->orderBy($orderBy,$x)->get();    
}

$displaysupp="None";

if($supp!="None")
{
    $ord=[];
    foreach($orders as $o)
    {
        if($o->status==$supp)
        {
            array_push($ord,$o);
        }
    }

    $orders=$ord;

    if($supp=="pending")
    {
        $displaysupp="Pending";
    }else if($supp=="processing")
    {
        $displaysupp="Processing";
    }else if($supp=="cancelled")
    {
        $displaysupp="Denied";
    }else if($supp=="completed")
    {
        $displaysupp="Completed";
    }
}


if($search== "None")
    $displaysearch="";
else
{
    $displaysearch=$search;
    $newOrders=[];
    foreach($orders as $o)
    {
        $user=DB::table('users')->where('id', $o->user_Id)->first();
        if(str_starts_with(strtolower($user->name),strtolower($search)))
            array_push($newOrders,$o);
    }
    $orders=$newOrders;
}

if($orders==null||count($orders)==0)
{
    $left="354px";
}

?>

<div style="margin-left:{{$left}};" class="combine">
    <br><br> 

<div class="d-flex justify-content-center h-100">
    <div class="search"> <input  onchange="searchOrder('{{$code}}','{{$supp}}','{{$sort}}')" id="searchBar" style="padding-left:10px; padding-right:755px; padding-bottom:6px; padding-top:4px;" type="text" class="search-input" placeholder="Enter Customer Name...." value="{{$displaysearch}}"></a></div>
</div>

<br>
<div style="padding-top:5px; height:40px; width:950px; background-color:#ebeaea;" class="container ">
    <div style="margin-left:-120px;" class="d-flex justify-content-center h-100">
        <p style="margin-top:1px; font-size:15px; color:#636262;">Filter Delivery Type: </p>
        @if(str_contains($code,'1'))
            <input style="margin-left:10px; margin-top:8px;" type="checkbox" onchange="check('{{$supp}}','{{$sort}}','{{$search}}')" id="plant" name="age" value="30" checked>
            <label style="font-size:15px; color:#636262; margin-left:10px; margin-top:3px;" for="age1">Home</label>
        @else
            <input style="margin-left:10px; margin-top:8px;" type="checkbox"  onchange="check('{{$supp}}','{{$sort}}','{{$search}}')" id="plant" name="age" value="30">
            <label style="font-size:15px; color:#636262; margin-left:10px; margin-top:3px;" for="age1">Home</label>
        @endif
        @if(str_contains($code,'2'))
            <input style="margin-left:10px; margin-top:8px;" type="checkbox" onchange="check('{{$supp}}','{{$sort}}','{{$search}}')" id="soil" name="age" value="30" checked>
            <label style="font-size:15px; color:#636262; margin-left:10px; margin-top:3px;" for="age2">PickUp</label>
        @else
            <input style="margin-left:10px; margin-top:8px;" type="checkbox" onchange="check('{{$supp}}','{{$sort}}','{{$search}}')" id="soil" name="age" value="30">
            <label style="font-size:15px; color:#636262; margin-left:10px; margin-top:3px;" for="age2">PickUp</label>
        @endif
        @if(str_contains($code,'3'))
            <input style="margin-left:10px; margin-top:8px;" type="checkbox" onchange="check('{{$supp}}','{{$sort}}','{{$search}}')" id="pot" name="age" value="30" checked>
            <label style="font-size:15px; color:#636262; margin-left:10px; margin-top:3px;" for="age2">Remote</label>
        @else
            <input style="margin-left:10px; margin-top:8px;" type="checkbox" onchange="check('{{$supp}}','{{$sort}}','{{$search}}')" id="pot" name="age" value="30">
            <label style="font-size:15px; color:#636262; margin-left:10px; margin-top:3px;" for="age2">Remote</label>
        @endif
        <p style="margin-top:1px; margin-left:20px; font-size:15px; color:#636262;">Filter Order Status: </p>
        <div style="font-size:15px; color:#636262; margin-left:10px;" class="dropdown">
            <button class="dropbtn123" style="text-overflow: ellipsis; white-space: nowrap; overflow:hidden; width:130px; height:24px;  padding-left:30px; padding-right:30px; margin-top:3px; border:none; position:absolute; padding-top:1px; padding-bottom:1px; font-size:13px; background-color:white; color:#636262;" type="button" id="dropdownMenuButton"  onclick="suppdrop()">
                {{$displaysupp}}
            </button>
            <div id="suppDropdown" class="dropdown-content"  style="max-height:120px; overflow:auto; z-index:1; text-align:center; font-size:13px; margin-top:26.3px; display:none; position: absolute; background-color: white; width:130px;">
                    <div class="dropdown-divider"></div>
                    <a href="/manageOrders/{{$code}}/None/{{$sort}}/{{$search}}/0">None</a><br>
                    <div class="dropdown-divider"></div>
                    <a href="/manageOrders/{{$code}}/pending/{{$sort}}/{{$search}}/0">Pending</a><br>
                    <div class="dropdown-divider"></div>
                    <a href="/manageOrders/{{$code}}/processing/{{$sort}}/{{$search}}/0">Processing</a><br>
                    <div class="dropdown-divider"></div>
                    <a href="/manageOrders/{{$code}}/cancelled/{{$sort}}/{{$search}}/0">Denied</a><br>
                    <div class="dropdown-divider"></div>
                    <a href="/manageOrders/{{$code}}/completed/{{$sort}}/{{$search}}/0">Completed</a><br>
                    <div class="dropdown-divider"></div>
        </div>
          </div>
        <p style="margin-top:2px; margin-left:150px; font-size:15px; color:#636262;">Sort By: </p>
          <div style="font-size:15px; color:#636262; margin-left:10px;" class="dropdown">
            <button class="dropbtn1" style="text-overflow: ellipsis; white-space: nowrap; overflow:hidden; width:130px; height:24px;  padding-left:30px; padding-right:30px; margin-top:3px; border:none; position:absolute; padding-top:1px; padding-bottom:1px; font-size:13px; background-color:white; color:#636262;" type="button" id="dropdownMenuButton"  onclick="suppdrop1()">
                {{$sort}}
            </button>
            <div id="suppDropdown1" class="dropdown-content1"  style="height:120px; overflow:auto; z-index:3; text-align:center; font-size:13px; margin-top:26.3px; display:none; position: absolute; background-color: white; width:130px;">
                <div class="dropdown-divider"></div>
                <a href="/manageOrders/{{$code}}/{{$supp}}/None/{{$search}}/0">None</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageOrders/{{$code}}/{{$supp}}/Latest Orders/{{$search}}/0">Latest Orders</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageOrders/{{$code}}/{{$supp}}/Upcoming Due Date/{{$search}}/0">Upcoming Due Date</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageOrders/{{$code}}/{{$supp}}/Order Total - Low/{{$search}}/0">Order Total - Low</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageOrders/{{$code}}/{{$supp}}/Order Total - High/{{$search}}/0">Order Total - High</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageOrders/{{$code}}/{{$supp}}/No. of Items - Low/{{$search}}/0">No. of Items - Low</a><br>
                <div class="dropdown-divider"></div>
                <a href="/manageOrders/{{$code}}/{{$supp}}/No. of Items - High/{{$search}}/0">No. of Items - High</a><br>
                <div class="dropdown-divider"></div>
        </div>
          </div>
    </div>
  </div>

<script type="text/javascript">
    window.scrollTo(0, 0);

    function showModal(modal)
    {
        if(modal!=0)
            $("#"+modal).modal('show');   
    }

    function searchOrder(code,supp,sort)
{
    if((document.getElementById("searchBar").value).trim()=="")
    {
        var link= "/manageOrders/"+code+"/"+supp+"/"+sort+"/None/0";
    }else{
        var link= "/manageOrders/"+code+"/"+supp+"/"+sort+"/"+document.getElementById("searchBar").value + "/0";
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
                            location.replace('/manageOrders/'+checked+'/'+supp+'/'+sort+'/'+search+"/0");
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


<div style="margin-left=-120px;" class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            @php
            $inputId=100;
            @endphp

            @if(count($orders)>0)
            @foreach($orders as $order)
            <?php      
                $user=DB::table('users')->where('id', $order->user_Id)->first();
                if($order->status=='pending'){
                    $img="pending.png";
                    $color="#F2DE1E";
                    $display1="visibility";
                    $display2="block";
                    $display3="none";
                    $display4="none";
                    $display5="none";
                    $display7="none";
                    $margin="0px";
                }else if($order->status=='cancelled'){
                    $img="cancelled.png";
                    $color="red";
                    $display1="none";
                    $display2="none";
                    $display3="none";
                    $display4="visibility";
                    $display5="none";
                    $display7="block";
                    $margin="17px";
                }else if($order->status=='processing'){
                    $img="processing.png";
                    $color="#2132E0";
                    $display1="none";
                    $display2="block";
                    $display3="visibility";
                    $display4="none";
                    $display5="none";
                    $display7="none";
                    $margin="0px";
                }else if($order->status=='completed'){
                    $img="completed.png";
                    $color="#32CD32";
                    $display1="none";
                    $display2="none";
                    $display3="none";
                    $display4="none";
                    $display5="visibility";
                    $display7="block";
                    $margin="17px";
                }

                if($order->delivery_type=="homeDelivery")
                {
                    $display6="none";
                    $title="Pick Date & Time";
                    $locM=200;
                    $deliveryS="Estimated Delivery Start Date";
                    $deliveryE="Estimated Delivery End Date";
                    $deliverytime="Estimated Delivery Time";

                }else if($order->delivery_type=="pickUp")
                {
                    $display6="none";
                    $title="Pick Date & Time";
                    $locM=200;
                    $deliveryS="Estimated Pick Up Start Date";
                    $deliveryE="Estimated Pick Up End Date";
                    $deliverytime="Estimated Pick Up Time";

                }else if($order->delivery_type=="remotePickUp")
                {
                    $display6="visibility";
                    $title="Pick Date/Time & Meetup Location";
                    $locM=120;
                    $deliveryS="Estimated Remote Pick Up Start Date";
                    $deliveryE="Estimated Remote Pick Up End Date";
                    $deliverytime="Estimated Remote Pick Up Time";
                }

                $date="To Be Decided"; 
                $timeDet="To Be Decided";

                if($order->contactMedia=="whatsapp")
                {
                    $orderType="copy";
                    $orderContact="img-thumbnail fab fa-whatsapp fa-1x";
                }else if($order->contactMedia=="messenger")
                {
                    $orderType="copy";
                    $orderContact="img-thumbnail fab fa-facebook-messenger fa-1x";
                }else
                {
                    $orderType="email";
                    $orderContact="img-thumbnail fa fa-envelope-o fa-1x";
                }

            ?>
            <div class="row p-2 bg-white border rounded">
                <div class="col-md-3 mt-1"><img  style="width:200px; height: 170px;" class="img-fluid img-responsive rounded product-image" src="{{URL::asset('storage/images/'.$img)}}"></div>
                <div class="col-md-6 mt-1">
                    <h4>Order Number: {{$order->orderNumber}}</h4>
                    <div class="mt-1 mb-1 spec-1"><span style="font-size:17px;">Name: {{$user->name}}</span><span style="background:{{$color}}" class="dot"></span><span style="font-size:17px;">Email: {{$user->email}}<span style="background:{{$color}}" class="dot"></span><span style="font-size:17px;">Type of Delivery: {{$order->delivery_type}}</span><span style="background:{{$color}}" class="dot"></span><span style="font-size:17px;">Order Total: RM {{sprintf('%.2f', ($order->grand_total))}}
                    <span style="background:{{$color}}" class="dot"></span><span style="color:{{$color}}; font-size:17px;">{{$order->status}}</span><span style="background:{{$color}}" class="dot"></span><span><i class="{{$orderContact}}" style="border-style:none; background-color:white;"></i></span></div>
                    <p style="color:black;" class="text-justify text-truncate para mb-0"><br><br></p>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <br/> 
                    <div style="position:relative; padding-bottom:40px;" class="d-flex flex-column mt-4">
                        <a style="display:{{$display1}}; margin-bottom:10px; border-color:#32CD32; background:#32CD32;" onclick="dateMinSet({{$dateCount}})" data-toggle="modal" data-target="#datetimeModal{{$dateCount}}" class="btn btn-primary btn-sm" href="">Accept</a>
                        
                      
                        
                        <script type="text/javascript">
                            function dateMinSet(count)
                            {
                                var today = new Date().toISOString().split('T')[0];
                                document.getElementsByName("dateS"+count)[0].setAttribute('min', today);
                            }
                            </script>
                      
                        <div class="container d-flex justify-content-center mt-100">
                            <div class="modal fade" id="datetimeModal{{$dateCount}}">
                                <div style="width:500px; margin-top:{{$locM}}px; margin-left:570px;" class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{$title}}</h4>
                                        </div> <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="container">   
                                                <h6>Delivery Type: {{$order->delivery_type}}</h6>
                                                <br>
                                                <h6>Start Date:</h6>
                                                  @if($display6=="visibility")
                                                  <input onkeydown="return false" onchange="dateSet(1,{{$dateCount}})" id="dateS{{$dateCount}}" type = "date" name ="dateS{{$dateCount}}"> 
                                                  @elseif($display6=="none")
                                                  <input onkeydown="return false" onchange="dateSet(0,{{$dateCount}})" id="dateS{{$dateCount}}" type = "date" name ="dateS{{$dateCount}}">
                                                  @endif
                                                  <br>
                                                  <br>
 
                                                  <h6>End Date:</h6>
                                                  <input onkeydown="return false" disabled id="dateE{{$dateCount}}" type = "date" name ="dateE{{$dateCount}}"> 
                                                  <br>
                                                  <br>

                                                  <h6>Time:</h6>
                                                  <select name="time" id="timeCount{{$dateCount}}">
                                                    @php
                                                      $time=1;  
                                                    @endphp
                                                    @while ($time!=13)
                                                    <option value="{{$time}}">{{$time}}</option>
                                                    @php
                                                      $time+=1;  
                                                    @endphp
                                                    @endwhile
                                                  </select>
                                                  <select id="time{{$dateCount}}">
                                                    <option value="AM">AM</option>
                                                    <option value="PM">PM</option>
                                                  </select>

                                                  <br>
                                                  <br>

                                                  <div style="display:{{$display6}};">
                                                  <h6>Meetup Location</h6>
                                                  <textarea placeholder="Enter Address..." oninput="allowSubmit({{$dateCount}})" disabled id="location{{$dateCount}}" rows="5" cols="40"></textarea> 
                                                  </div>
                                            </div>
                                        </div> 
                        
                                        
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            @if($display6=="visibility")
                                            <button  type="button" id="btndateTime{{$dateCount}}" disabled class="btn" onclick="ToCopyLoc({{$dateCount}},'{{$user->name}}','{{$order->orderNumber}}','{{$order->order_Id}}',document.getElementById('dateS{{$dateCount}}').value,document.getElementById('dateE{{$dateCount}}').value,document.getElementById('timeCount{{$dateCount}}').value,document.getElementById('time{{$dateCount}}').value,document.getElementById('location{{$dateCount}}').value)" data-toggle="modal" data-dismiss="modal" data-target="#copyModal{{$orderType}}{{$dateCount}}">Submit</button> 
                                            @elseif($display6=="none")
                                            <button  type="button" id="btndateTime{{$dateCount}}" disabled class="btn" onclick="ToCopy({{$dateCount}},'{{$user->name}}','{{$order->orderNumber}}','{{$order->order_Id}}',document.getElementById('dateS{{$dateCount}}').value,document.getElementById('dateE{{$dateCount}}').value,document.getElementById('timeCount{{$dateCount}}').value,document.getElementById('time{{$dateCount}}').value)" data-toggle="modal" data-dismiss="modal" data-target="#copyModal{{$orderType}}{{$dateCount}}">Submit</button> 
                                            @endif
                                            <button type="button" class="btn" data-dismiss="modal">Close</button> </div>
                                        </div>                                    
                                </div>
                            </div>
                        </div>

                        <script type="text/javascript">

                            function dateSet(loc,count)
                            {
                                document.getElementById("dateE"+count).disabled = false;
                                document.getElementById("location"+count).disabled = false;

                                if(loc==0)
                                    document.getElementById("btndateTime"+count).disabled = false;

                                document.getElementsByName("dateE"+count)[0].setAttribute('min', document.getElementById("dateS"+count).value);
                                if(document.getElementById("dateS"+count).value > document.getElementById("dateE"+count).value)
                                    document.getElementById("dateE"+count).value=document.getElementById("dateS"+count).value; 
                            }

                            function allowSubmit(count)
                            {
                                if((document.getElementById("location"+count).value).trim()!="")
                                    document.getElementById("btndateTime"+count).disabled = false;
                                else if((document.getElementById("location"+count).value).trim()=="")
                                    document.getElementById("btndateTime"+count).disabled = true;                                
                            }

                            function allowSubmit1(count)
                            {
                                if((document.getElementById("textArea"+count).value).trim()!="")
                                    document.getElementById("denybtn"+count).disabled = false;
                                else if((document.getElementById("textArea"+count).value).trim()=="")
                                    document.getElementById("denybtn"+count).disabled = true;                                
                            }

                            function ToCopyLoc(count,name,number,id,dateSt,dateEn,timeCount,time,loc)
                            {
                                var text= 'Hi '+ name + ', the order you placed with Order Number: ' + number + ' has been accepted and will be delivered within the following timeframe:\nDate Range: '+ dateSt +' to '+ dateEn +'\nTime: '+ timeCount +' '+ time +'\nMeetup Location: '+ loc;
                                $("#copyText"+count).html(text);
                            }

                            function ToCopy(count,name,number,id,dateSt,dateEn,timeCount,time)
                            {
                                var text= 'Hi '+ name + ', the order you placed with Order Number: ' + number + ' has been accepted and will be delivered within the following timeframe:\nDate Range: '+ dateSt +' to '+ dateEn +'\nTime: '+ timeCount +' '+ time;
                                $("#copyText"+count).html(text);
                            }
                        </script>

                        <!-- Click To Copy Modal-->
                        <div class="modal fade" id="copyModalcopy{{$dateCount}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div style="margin-left:550px; margin-top:230px;" class="modal-dialog" role="document">
                                <div  class="modal-content col-12">
                                    <div class="modal-header">
                                        <h6 style="font-size:17px; padding-left:170px; color:#32CD32;" class="modal-title">IMPORTANT!</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    </div>
                                    <div class="modal-body">
                                        <p style="color:dimgray; font-size:15px;">Please Copy The Delivery Details Below. Paste The Details In The Customer's Chosen Social Media Platform To Immediately Notify Them!</p>
                                        <textarea style="margin-left:2px; max-width: 100%;" rows="4" cols="56" id="copyText{{$dateCount}}"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" style="background-color:#32CD32" onclick="copyDeliveryDetails(0,'{{$user->name}}','{{$order->orderNumber}}','{{$order->order_Id}}',document.getElementById('dateS{{$dateCount}}').value,document.getElementById('dateE{{$dateCount}}').value,document.getElementById('timeCount{{$dateCount}}').value,document.getElementById('time{{$dateCount}}').value,document.getElementById('location{{$dateCount}}').value)" class="btn btn-success btn-sm btn-block">Continue</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                          <!-- Email Modal-->
             <div class="modal fade" id="copyModalemail{{$dateCount}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div style="margin-left:550px; margin-top:250px;" class="modal-dialog" role="document">
                    <div  class="modal-content col-12">
                         <div class="modal-header">
                             <h6 style="font-size:17px; padding-left:170px; color:#32CD32;" class="modal-title">Email Request</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                         </div>
                         <div class="modal-body">
                             <p style="color:dimgray; font-size:15px;">An Email Will Be Sent To The Customer. Please Click Below To Proceed.</p>
                         </div>
                         <div class="modal-footer">
                             <button type="button" onclick="copyDeliveryDetails(1,'{{$user->name}}','{{$order->orderNumber}}','{{$order->order_Id}}',document.getElementById('dateS{{$dateCount}}').value,document.getElementById('dateE{{$dateCount}}').value,document.getElementById('timeCount{{$dateCount}}').value,document.getElementById('time{{$dateCount}}').value,document.getElementById('location{{$dateCount}}').value)" style="background-color:#32CD32"  data-dismiss="modal"  class="btn btn-success btn-sm btn-block">Proceed</button> 
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Click To Copy Modal End-->

             
                       
                        <script type="text/javascript">
                        function copyDeliveryDetails(x,name,number,id,dateSt,dateEn,timeCount,time,loc) 
                        {   
                            if(loc=="")
                                loc="None";

                            if(x==0)
                            {
                                window.open("/acceptOrderNotification/"+id+"/"+dateSt+"/"+dateEn+"/"+timeCount+" "+time+"/"+loc); 
                                setTimeout(function(){
                                window.location.reload();
                                }, 500);
                            }else{
                                location.replace("/acceptOrderNotification/"+id+"/"+dateSt+"/"+dateEn+"/"+timeCount+" "+time+"/"+loc); 
                            }
                        }

                       
                    </script>
                       
                       
                        <!-- Click To Copy Modal End-->
                                   

                        <a style="display:{{$display3}}; margin-bottom:10px; border-color:#32CD32; background:#32CD32"  class="btn btn-primary btn-sm" data-target="#SreasonC{{$count}}" data-toggle="modal">Order Completed</a>
                        <a style="margin-top:{{$margin}}; border-color:#32CD32; background:#32CD32;"  class="btn btn-primary btn-sm" href="/editSupplier/"  data-toggle="modal" data-target="#{{$count}}">View Details</a>
                        
                        <div class="container d-flex justify-content-center mt-100">
                            <div style="background-color:rgba(0, 0, 0, 0.726);" class="modal fade" id="{{$count}}">
                                <div style="margin-top:200px; margin-left:450px;" class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Order Id: {{$order->order_Id}}
                                        </div> <!-- Modal body -->
                                        <div style="height:300px; overflow-y:scroll;" class="modal-body">
                                            <div class="container">                                                
                                                <h6>Customer Details</h6>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <ul type="none">
                                                            <li class="left">Order Id</li>
                                                            <li class="left">Order Number</li>
                                                            <li class="left">Name</li>
                                                            <li class="left">Email</li>
                                                            <li class="left">Phone Number</li>
                                                            <li class="left">Address</li>

                                                        </ul>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <ul class="right" type="none">
                                                            <li class="right">{{$order->order_Id}}</li>
                                                            <li class="right">{{$order->orderNumber}}</li>
                                                            <li class="right">{{$user->name}}</li>
                                                            <li class="right">{{$user->email}}</li>
                                                            <li class="right">{{$user->cust_phone_number}}</li>
                                                            <li class="right">{{$user->cust_address}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6>Item Details 
                                                </h6>
                                                <div class="row" style="border-bottom: none">
                                                    <div class="col-xs-6">
                                                        <ul type="none">
                                                            <?php
                                                             $orderItems=OrderItem::all()->where('order_Id',$order->order_Id);
                                                            ?>
                                                            @php
                                                             $m=0;
                                                            @endphp
                                                            @foreach ($orderItems as $item)
                                                                    <li style="margin-top:{{$m}}px;" class="left">{{Product::where('Product_ID', $item->product_Id)->value('Product_Name')}}</li>
                                                            
                                                                    @php
                                                                    $m=0;
                                                                    @endphp
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <ul style="top:100px;" class="right" type="none">
                                                           
                                                                @php
                                                                    $m=0;
                                                                @endphp

                                                            @foreach ($orderItems as $item)

                                                                    @php
                                                                        $name=Product::where('Product_ID', $item->product_Id)->value('Product_Name');
                                                                        $no=Order::where('order_Id', $item->order_Id)->value('orderNumber');
                                                                    @endphp
                                
                                                                    <li class="right">
                                                                        <label style="margin-top:{{$m}}px; float: left; margin-right:10px;" for="test">Quantity: </label>
                                                                        <span style="display: block; overflow: hidden;"><input id="{{$inputId}}" onchange="changeQuantityAdmin('{{$name}}','{{$no}}',{{$item->quantity}},{{$item->id}},document.getElementById({{$inputId}}).value,{{$count}})" style="margin-top:3px; height:20px; width:50px; border-radius:0px; text-align: center;" type="text" class="form-control input-number" value="{{$item->quantity}}"></span>

                                                                        @php
                                                                        $m=-8;
                                                                        @endphp

                                                           


                                                            <script type="text/javascript">

                                                                itemID=0;
                                                                itemVal=0;
                                                                countID=0;
                                                                function changeQuantityAdmin(name,ordN,prev,y,x,count)
                                                                        {
                                                                            itemID=y;
                                                                            itemVal=x;
                                                                            countID=count;
                                                                            document.getElementById("itm"+count).click();
                                                                            $("#Sreason1").modal('show');
                                                                            $("#itemName").html(name);
                                                                            $("#OrderID").html(ordN);
                                                                            $("#prevQuan").html(prev);
                                                                            $("#newQuan").html(x);
                                                                        }

                                                                    
                                                            </script>

                                                            @php
                                                                $inputId+=1;
                                                            @endphp

                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6>Delivery Details</h6>
                                                <div class="row" style="border-bottom: none">
                                                    <div class="col-xs-6">
                                                        <ul type="none">
                                                            <li class="left">Type of Delivery</li>
                                                            <li class="left">Order Made On</li>
                                                            <li class="left">{{$deliveryS}}</li>
                                                            <li class="left">{{$deliveryE}}</li>
                                                            <li class="left">{{$deliverytime}}</li>      
                                                        </ul>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <ul class="right" type="none">
                                                            <li class="left">{{$order->delivery_type}}</li>
                                                            <li class="right">{{$order->orderMadeDate}}</li> 
                                                            <li class="right">{{$order->shippingStartDate}}</li> 
                                                            <li class="right">{{$order->shippingEndDate}}</li> 
                                                            <li class="right">{{$order->shippingTime}}</li>   
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6>Grand Total</h6>
                                                <div class="row" style="border-bottom: none">
                                                    <div class="col-xs-6">
                                                        <ul type="none">                                                                                                                   
                                                            <li class="left">Total Price</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <ul  class="right" type="none">                                                        
                                                            <li class="right">RM {{round($order->grand_total)}}</li> 
                                                        </ul>
                                                    </div>
                                                </div>
                                            <div style="display:{{$display4}};">
                                                <h6>Order Denied Details</h6>
                                                <div class="row" style="border-bottom: none">
                                                    <div class="col-xs-6">
                                                        <ul type="none">     
                                                            <li class="left">Order Denied By</li>                                                                                                              
                                                            <li class="left">Reason For Denial</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <ul  class="right" type="none">  
                                                            <li class="right">{{substr($order->denyReason,0,strpos($order->denyReason,":"))}}</li>                                                       
                                                            <li class="right">{{substr($order->denyReason,strpos($order->denyReason,":")+1)}}</li> 
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="display:{{$display5}};">
                                                <h6>Order Confirmation Details</h6>
                                                <div class="row" style="border-bottom: none">
                                                    <div class="col-xs-6">
                                                        <ul type="none">     
                                                            <li class="left">Order Confirmed By</li>                                                                                                              
                                                            <li class="left">Order Confirm Date</li>
                                                            <li class="left">Order Confirm Time</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <ul  class="right" type="none"> 
                                                            <li class="right">{{substr($order->denyReason,0,strpos($order->denyReason,":"))}}</li>                                                        
                                                            <li class="right">{{substr($order->denyReason,strpos($order->denyReason,":")+1,strpos($order->denyReason,":")-1)}}</li> 
                                                            <li class="right">{{substr($order->denyReason,strpos($order->denyReason,"*")+1)}}</li> 
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div> <!-- Modal footer -->
                                        <div class="modal-footer"> 
                                            <button type="button" id="itm{{$count}}" class="btn" data-dismiss="modal">Close</button> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @if($display7=="none")
                    <a onmouseover="this.style.background='#32CD32'; this.style.color='white';"  onmouseout="this.style.background='white'; this.style.color='#32CD32';" style="display:{{$display2}}; border-color:#32CD32; color:#32CD32;"data-toggle="modal" data-target="#reason{{$dateCount}}"  class="btn btn-outline-primary btn-sm mt-2">Deny</a></div>                      
                    @elseif($display7=="block")
                    <a onmouseover="this.style.background='#32CD32'; this.style.color='white';"  onmouseout="this.style.background='white'; this.style.color='#32CD32';" style="display:{{$display7}}; border-color:#32CD32; color:#32CD32;" class="btn btn-outline-primary btn-sm mt-2" data-toggle="modal" data-target="#SreasonR{{$dateCount}}">Remove</a></div>                    
                    @endif

                    <div class="container d-flex justify-content-center mt-100">
                        <div class="modal fade" id="reason{{$dateCount}}">
                            <div style="width:500px; margin-top:230px; margin-left:570px;" class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Order Cancellation
                                    </div> <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="container">   
                                    
                                            <h6>Reason:</h6>
                                            <textarea placeholder="Enter Reason Here..." oninput="allowSubmit1({{$dateCount}})" id="textArea{{$dateCount}}" rows="4" cols="55" name="comment" form="usrform"></textarea>
                                            <br>
                                            <br>
                                            
                                        </div>
                                    </div> <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button id="denybtn{{$dateCount}}" disabled onclick="ToCopy1('{{$user->name}}','{{$order->orderNumber}}','{{$user->cust_phone_number}}',{{$dateCount}},document.getElementById('textArea{{$dateCount}}').value)" data-toggle="modal" data-dismiss="modal" data-target="#copyModal{{$orderType}}1{{$dateCount}}" type="button" class="btn" >Submit</button> 
                                         <button type="button" class="btn" data-dismiss="modal">Close</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        function ToCopy1(name,number,phoneno,count,reason)
                        {
                            var text="Sorry " + name+ ", the order you placed with Order Number: "+ number+' has been denied due to the following reason(s):\n'+reason;
                            $("#copyText1"+count).html(text);
                        }
                    </script>

                </div>

                <div class="modal fade" id="copyModalcopy1{{$dateCount}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div style="margin-left:550px; margin-top:230px;" class="modal-dialog" role="document">
                        <div  class="modal-content col-12">
                            <div class="modal-header">
                                <h6 style="font-size:17px; padding-left:170px; color:#32CD32;" class="modal-title">IMPORTANT!</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div>
                            <div class="modal-body">
                                <p style="color:dimgray; font-size:15px;">Please Copy The Delivery Details Below. Paste The Details In The Customer's Chosen Social Media Platform To Immediately Notify Them!</p>
                                <textarea style="margin-left:2px; max-width: 100%;" rows="4" cols="56" id="copyText1{{$dateCount}}"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" style="background-color:#32CD32" onclick="myFunction2(0,'{{ Auth::user()->name }}','{{$order->order_Id}}',document.getElementById('textArea{{$dateCount}}').value)" class="btn btn-success btn-sm btn-block">Continue</button>
                            </div>
                        </div>
                    </div>
                </div>



                  <!-- Email Modal-->
     <div class="modal fade" id="copyModalemail1{{$dateCount}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div style="margin-left:550px; margin-top:250px;" class="modal-dialog" role="document">
            <div  class="modal-content col-12">
                 <div class="modal-header">
                     <h6 style="font-size:17px; padding-left:170px; color:#32CD32;" class="modal-title">Email Request</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                 </div>
                 <div class="modal-body">
                     <p style="color:dimgray; font-size:15px;">An Email Will Be Sent To The Customer. Please Click Below To Proceed.</p>
                 </div>
                 <div class="modal-footer">
                    <button type="button" style="background-color:#32CD32" onclick="myFunction2(1,'{{ Auth::user()->name }}','{{$order->order_Id}}',document.getElementById('textArea{{$dateCount}}').value)" class="btn btn-success btn-sm btn-block">Continue</button>
                </div>
             </div>
         </div>
     </div>
     <!-- Click To Copy Modal End-->
                     
              
            </div>

            <div class="container d-flex justify-content-center mt-100">
                <div class="modal fade" id="Sreason1">
                    <div style="width:500px; margin-top:230px; margin-left:570px;" class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h6 style="font-size:17px; padding-left:170px; color:#25D366" class="modal-title">IMPORTANT!</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div> <!-- Modal body -->
                            <div style="font-size:13px;" class="modal-body">
                                <p style="color:dimgray; font-size:15px;">The Quantity Of The Item: <span id="itemName"></span> Belonging To Order Number: <span id="OrderID"></span> Will Be Changed From (<span id="prevQuan"></span>) To (<span id="newQuan"></span>). Are You Sure You Want To Continue?</p>
                            </div>
                                <p id="itemID" hidden></p>
                            <div class="modal-footer">
                                <button  onclick="changeQuan()" type="button" class="btn" data-dismiss="modal">Confirm</button> 
                                 <button type="button" class="btn" data-dismiss="modal">Close</button> </div>
                        </div>
                    </div>
                </div>
            </div>
        
                <script type="text/javascript">



                function changeQuan()
                        {
                            var link="/changeQuantityAdmin/"+itemID+"/"+itemVal+"/"+countID;
                            location.replace(link);
                        }

                function myFunction() 
                {
                    if (confirm("Are you sure you want to continue?")) {

                    return true;

                    } else {

                        return false;
                    }

                }

                     

                            function myFunction2(x,name,id,reason) 
                            { 
                                if(x==0)
                                {
                                    window.open("/denyOrderNotification/"+id+"/"+name+":"+reason);
                                    setTimeout(function(){
                                    window.location.reload();
                                    }, 500);
                                }else if(x==1)
                                {
                                    location.replace("/denyOrderNotification/"+id+"/"+name+":"+reason);
                                } 
                            }               

            
             </script>
            <br>

            <div class="container d-flex justify-content-center mt-100">
                <div style="background-color:rgba(0, 0, 0, 0.5);" class="modal fade" id="SreasonC{{$count}}">
                    <div style="width:500px; margin-top:300px; margin-left:570px;" class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h6 style="font-size:17px; padding-left:170px; color:#25D366" class="modal-title">IMPORTANT!</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div> <!-- Modal body -->
                            <div style="font-size:13px;" class="modal-body">
                                <p style="color:dimgray; font-size:15px;">The Status Of This Order Will Be Changed To Completed. Are You Sure You Want To Proceed?</p>
                            </div>
                                <p id="itemID" hidden></p>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" onClick="location.href='/completeOrderNotification/{{$order->order_Id}}/{{Auth::user()->name}}:{{date('d:m:Y')}}*{{date("h:i:sa")}}'" id="rmvAdmin" data-dismiss="modal">Confirm</button>
                                <button type="button" style="border:red; background-color:red;" class="btn btn-success" data-dismiss="modal">Deny</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container d-flex justify-content-center mt-100">
                <div style="background-color:rgba(0, 0, 0, 0.5);" class="modal fade" id="SreasonR{{$dateCount}}">
                    <div style="width:500px; margin-top:300px; margin-left:570px;" class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h6 style="font-size:17px; padding-left:170px; color:#25D366" class="modal-title">IMPORTANT!</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div> <!-- Modal body -->
                            <div style="font-size:13px;" class="modal-body">
                                <p style="color:dimgray; font-size:15px;">The Order Will Be Completely Removed From The Database. Are You Sure You Want To Proceed?</p>
                            </div>
                                <p id="itemID" hidden></p>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" onClick="location.href='/removeOrder/{{$order->order_Id}}'" id="rmvAdmin" data-dismiss="modal">Confirm</button>
                                <button type="button" style="border:red; background-color:red;" class="btn btn-success" data-dismiss="modal">Deny</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @php
                $dateCount+=1;
                $count+=1;    
            @endphp
            @endforeach
            

            @elseif(count($o1)==0)

            <div style="left:40%" class="col-md-3 mt-1"><img  style="" class="img-fluid img-responsive rounded product-image" src="{{URL::asset('storage/images/order.png')}}"></div>
            <br/> <br/>
            <h1 style="margin-left: 15%">No Orders Exist In The Database!</h1>
            @elseif (count($orders)==0)
            <div style="left:35%" class="col-md-3 mt-1"><img  style="" class="img-fluid img-responsive rounded product-image" src="{{URL::asset('storage/images/magGlass.png')}}"></div>
            <br/> <br/>
            <h1 style="margin-left: 25%">No Results Were Found</h1>
            @endif
        </div>
    </div>
</div>
<div>
</div>  



            </body>
            </html>