<?php use Illuminate\Support\Facades\Auth;
	$user=Auth::check();
?>
<!doctype html>
<?php
use App\Models\Order;
$orders=Order::all();
?>

<?php
use App\Models\OrderItem;
$orderItems=OrderItem::all();
?>

<?php
use App\Models\Product;
$products=Product::all();
?>

<?php
$order = Order::where([ 'order_Id' => auth()->id() ]);
?>

<style>
.card-order {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  padding: 20px 20px 20px 20px;
  width: 100%;
}

.card-order:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container-order {
  padding: 5px 16px 0px;

}

.button {
  border: none;
  color: white;
  padding: 1px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 2px 970px 0px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: red; 
  border: 2px solid red;
}

.button1:hover {
  background-color: red;
  color: white;
}

}
</style>

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
        <title>Cacti Succulent KCH Orders</title>

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
        <link rel="stylesheet" href="css/style.css">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="css/responsive.css">
        

    </head>
	
	<body>
  <!--new-arrivals start -->
  <section id="new-arrivals" class="new-arrivals">
			<div class="container">
				<div class="section-header">
					<br>
					<br>

					<h2>All Orders</h2>

				</div><!--/.section-header-->
                @if($orders !=='')

				<div class="new-arrivals-content">
					<div class="Row">
                    @foreach($orders as $order)
                    @if(auth()->id() == $order->user_Id)

                    <div class="card-order">
                            <div class="container-order">
                                <h4><b style="color:#32CD32;">Order Number: {{$order->orderNumber}}</b></h4> 
                                <p style="color:black;">Order Date: <a>{{$order->orderMadeDate}}</a></p> 
                                <p style="color:black;">Items Ordered: <a>
                                     @foreach($orderItems as $orderItem)
                                     @if($orderItem->order_Id == $order->order_Id)
                                     @foreach($products as $product)

                                     @if($orderItem->product_Id == $product->Product_ID)
                                     ({{$orderItem->quantity}}x) {{$product->Product_Name}}@if($order->item_count>=2) |@endif
                                     @endif

                                     @endforeach 
                                     @endif 
                                    @endforeach</a></p>  
                                <p style="color:black;">Grand Total: RM <a>{{$order->grand_total}}</a></p> 
                                <p style="color:black;">Delivery Type: <a>{{$order->delivery_type}}</a></p> 
                                @if($order->status == "pending")
                                <p style="color:black;">Order Status: <a style="color:#FED000;">{{$order->status}}</a></p>
                                @elseif($order->status == "cancelled")
                                <p style="color:black;">Order Status: <a style="color:red;">{{$order->status}}</a></p>
								@elseif($order->status == "processing")
                                <p style="color:black;">Order Status: <a style="color:blue;">{{$order->status}}</a></p>
								@elseif($order->status == "completed")
                                <p style="color:black;">Order Status: <a style="color:#32CD32;">{{$order->status}}</a></p>
								@else
                                <p style="color:black;">Order Status: <a style="color:red;">{{$order->status}}</a></p>
                                @endif
                            </div>
                            <form action="/updateStatus/{{$order->order_Id}}" method="POST">
                            {{ csrf_field() }}
                            @if($order->status == "pending")
                            <button type ="submit" class="button button1" >Cancel</button>
                            @endif
                            </form>
                            </div>
                            @endif
                        @endforeach
                        <script type="text/javascript">
							function cancel()
							{
								var link= "/cancel/"+document.getElementById("searchBar2").value;
								document.addEventListener("keyup", function(event) {
									if (event.keyCode === 13) {
										location.replace(link);
									}
								});
							}
						</script>
                         @else
                        <div>
                            <h1 class="text-center" style="font-size:30px;color:#808080">You Have Placed No Orders!</h1>
                        </div>
                    @endif

    <!-- <script type="text/javascript">
        $(".add-to-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            ele.siblings('.btn-loading').show();

            $.ajax({
                url: '{{ url('cart') }}' + '/' + ele.attr("data-id"),
                method: "get",
                data: {_token: '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {

                    ele.siblings('.btn-loading').hide();

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                    $("#header-bar").html(response.data);
                }
            });
        });
    </script> -->
						
					</div>
				</div>		
			</div><!--/.container-->
		
		</section><!--/.new-arrivals-->
		<!--new-arrivals end -->

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
		
        
        <!--Custom JS-->
        <script src="js/custom.js"></script>
	</body>

	@include('footer')
	<!--<a>@foreach($orderItems as $orderItem)
                                     @if($order->order_Id == $orderItem->order_Id)@foreach($products as $product)@if($orderItem->order_Id == $product->Product_ID){{$product->Product_Name}}@endif 
                                     @endforeach @endif @endforeach</a></p> -->
</html>