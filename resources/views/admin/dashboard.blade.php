<?php
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;


$orders = DB::table('orders')
                    ->where('status', 'pending')
                    ->orWhere('status', 'processing')
                    ->get();
$notifications=Notification::all();
$products=Product::all();
$prodNames=[];
$quantities=[];
$ordersCompleted=Order::all()->where('status','completed');
$max_quantity=0;
$max_name="";

foreach($products as $product)
{
  array_push($prodNames,$product->Product_Name);
  $sum1=0;
  foreach($ordersCompleted as $order)
  {
    $x = DB::table('order_items')
                    ->where('order_Id', $order->order_Id)
                    ->where('product_Id', $product->Product_ID)
                    ->first();
    
    if($x!=null)
    {
      $sum1+=$x->quantity;
    }
  }
  array_push($quantities,$sum1);
  if($max_quantity<$sum1)
  {
    $max_quantity=$sum1;
    $max_name=$product->Product_Name;
  }
}
$sum=0;
$sumMonths=[0,0,0,0,0,0,0,0,0,0,0,0];
foreach($ordersCompleted as $order)
{
  $sum+=$order->grand_total;
  if(date("y",strtotime($order->orderMadeDate))==(date("Y")-2000))
  {
    $sumMonths[intval(date("m",strtotime($order->orderMadeDate)))-1]+=$order->grand_total;
  }
  
}


$admins=User::all()->where('user_type','admin');

?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cacti Succulent Admin</title>

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
<body onload="saleschart();">
    

 <!-- jQuery CDN - Slim version (=without AJAX) -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <link href="{{ asset('sass/test.css') }}" rel="stylesheet">


@include('admin/adminheader')

<div class="container-scroller">
   
               <?php
									$notifications=Notification::all();

									$count=0;

									foreach($notifications as $n)
									{
										if($n->status=="unseen" && $n->type=="admin" && str_contains($n->admins, Auth::user()->id.','))
										{
											$count+=1;
										}
									}
									?>

     
      <div style="margin-left:167.5px; margin-top:100px;" class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div style="margin-top:40px; margin-left:140px;" class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 style="color:#32CD32;">Welcome {{ Auth::user()->name }}</h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">{{$count}} unread notification(s)!</span></h6>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  
                 </div>
                </div>
              </div>
            </div>
          </div>
          <div style="margin-left:142px; margin-top:50px;" class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-sbg" style="border-radius:15px; width:94.7%;">
                <div class="card-people mt-auto">
                  <img style="border-radius:15px; width:555px; height:298px;" src="images/dashboard/cactus.jpg" alt="people">
                  <div class="weather-info">
                    <div style="position:absolute; top:20px; right:20px;" class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal" style="color:#32CD32;"  ><i class="icon-sun mr-2"></i>31<sup style="font-size:17px;">C</sup></h2>
                      </div>
                      <div class="ml-2">
                        <h4 style="color:#32CD32;" class="location font-weight-normal">Kuching <br><span style="font-size:15px;">Malaysia</span> </h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale" style="border-radius:15px; background-color:white; height:70%; width:90%">
                    <div style="margin-top:-5px;" class="card-body">
                      <p style="font-size:15px; color:#32CD32;" class="mb-4">Total Sales</p>
                    </div>
                    <div style="margin-top:10px; margin-left:20px;">
                        <p style="font-size:30px; color:#32CD32;" class="fs-30 mb-2">RM {{$sum}}</p>
                        <p style="margin-top:-18px; font-size:13px; color:#32CD32;">made in total</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale" style="border-radius:15px; background-color:#32CD32; height:70%; width:90%">
                    <div style="margin-top:-5px;" class="card-body">
                      <p style="font-size:15px; color:white;" class="mb-4">Incomplete Orders</p>
                    </div>
                    <div style="margin-top:10px; margin-left:20px;">
                        <p style="font-size:30px; color:white;" class="fs-30 mb-2">{{count($orders)}}</p>
                        <p style="margin-top:-18px; font-size:13px; color:white;">order(s) left</p>
                    </div>
                  </div>
                </div>
              </div>
              <div style="margin-top:-25px;" class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue" style="border-radius:15px; background-color:#4fbb4f; height:62%; width:90%">
                    <div style="margin-top:-5px;" class="card-body">
                      <p style="font-size:15px; color:white;" class="mb-4">Admin Users</p>
                    </div>
                    <div style="margin-top:11px; margin-left:20px;">
                        <p style="font-size:30px; color:white;" class="fs-30 mb-2">{{count($admins)}}</p>
                        <p style="margin-top:-18px; font-size:13px; color:white;">user(s) in total</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale" style="border-radius:15px; background-color:#2a812a; height:70%; width:90%">
                    <div style="margin-top:-5px;" class="card-body">
                      <p style="font-size:15px; color:white;" class="mb-4">Number of Products</p>
                    </div>
                    <div style="margin-top:10px; margin-left:20px;">
                        <p style="font-size:30px; color:white;" class="fs-30 mb-2">{{count($products)}}</p>
                        <p style="margin-top:-18px; font-size:13px; color:white;">products being sold</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div style="margin-left:130px;" class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card" style="border-radius:15px;">
                <div class="card-body">
                  <p style="font-weight:500; color:#32CD32; font-size:18.5px;" class="card-title">Best Selling Products</p>
                  <p style="color:#32CD32; font-size:13.5px;">The line graph shows the amount of times each product has been sold thus indicating which products are the most popular.</p>
                  <div style="color:#32CD32; font-size:12.5px;" class="d-flex flex-wrap mb-5">
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Best-Selling Product</p>
                      <h3 style=" white-space: nowrap;  overflow: hidden; width:150px; text-overflow: ellipsis; font-size:15px;">{{$max_name}}</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Quantity Sold</p>
                      <h3 style="text-align:center; font-size:15px;">{{$max_quantity}}</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Total Completed Orders</p>
                      <h3 style="text-align:center; font-size:15px;">{{count($ordersCompleted)}}</h3>
                    </div>
                  </div>
                  <canvas id="myChart1" style="max-width:600px"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card" style="height:100%; width:96%; border-radius:15px;">
                <div class="card-body">
                 <div class="d-flex justify-content-between">
                  <p  style="font-weight:500; color:#32CD32; font-size:18.5px;" class="card-title">Sales Report</p>
                 </div>
                  <p style="color:#32CD32; font-size:13.5px;" class="font-weight-500">The bar graph below represents the total number of sales in each month that have taken place in the current year.</p>
                  <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                  <canvas id="myChart" style=" width:100%; height:70px;"></canvas>
                </div>
              </div>
            </div>
          </div>

          <script>
           
            function saleschart()
            {
              var xValues = ["January", "February", "March", "April", "May", "June","July","August","September","October","November","December"];
              var yValues = ['<?=$sumMonths[0]?>','<?=$sumMonths[1]?>','<?=$sumMonths[2]?>','<?=$sumMonths[3]?>','<?=$sumMonths[4]?>','<?=$sumMonths[5]?>','<?=$sumMonths[6]?>','<?=$sumMonths[7]?>','<?=$sumMonths[8]?>','<?=$sumMonths[9]?>','<?=$sumMonths[10]?>','<?=$sumMonths[11]?>'];
              var barColors = ["green", "green","green","green","green","green","green","green","green","green","green","green"];
            
              new Chart("myChart", {
                type: "bar",
                data: {
                  labels: xValues,
                  datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                  }]
                },
                options: {
                  legend: {display: false},
                  title: {
                    display: true,
                  },
                  scales: {
                    x: {
                    grid: {
                      display: false
                    }
                  }
                  }
                }
              });
            }

            var p='<?=count($products)?>';
            i=0;
            var products= <?php echo json_encode($prodNames); ?>;
            var quantity= <?php echo json_encode($quantities); ?>;
            new Chart("myChart1", {
              type: "line",
              data: {
                labels: products,
                size: 34,
                datasets: [{
                  fill: false,
                  lineTension: 0,
                  backgroundColor: "rgba(0,0,255,1.0)",
                  borderColor: "rgba(0,0,255,0.1)",
                  data: quantity
                }]
              },
              options: {
                legend: {display: false},
              }
            });

            </script>
            <br>
            <br>
</body>
</html>
