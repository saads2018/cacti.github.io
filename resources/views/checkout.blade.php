<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="css/checkout.css"> -->
    <link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <title>Checkout : Cacti Succulent KCH</title>
  </head>
  <body>

    <?php 
        use Illuminate\Support\Facades\Auth;
        
        if (Auth::check()) {
            $user = Auth::user();
        }
    ?>
 
   
       <link href="{{ asset('css/modal.css') }}" rel="stylesheet">

    <div class="pos-f-t">
        <nav class="navbar navbar-dark bg-success">
        <a href="cart">
            <button class="navbar-toggler" type="button" >
                <span class="navbar-toggler-icon"></span>
            </button>
        </a>
        </nav>
    </div>

    <div class="row m-5">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Order Summary</span>
            @if(count((array) session('cart')) != 0)
                <span class="badge badge-success badge-pill">{{ count((array) session('cart')) }}</span>
            @endif
          </h4>
            @if(session('cart'))
                <ul class="list-group mb-3">
                @foreach(session('cart') as $id=>$details)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{$details['Product_Name']}}</h6>
                            <small class="text-muted">Quantity : {{$details['Product_Quantity']}}</small>
                        </div>
                        <span class="text-muted">RM {{$details['Product_Price']}}</span>
                    </li>
                @endforeach

                    <?php $total = 0 ?>
                        @foreach((array) session('cart') as $id => $details)
                            <?php $total += $details['Product_Price'] * $details['Product_Quantity'] ?>
                        @endforeach

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong>RM {{$total}}</strong>
                    </li>
                </ul>
                

            @else
                <div>
                    <h1 class="text-center" style="font-size:30px;color:#808080">Your Cart is Empty!</h1>
                </div>
            @endif

            </div>
            <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" id="myForm" target="_blank"  novalidate action="/checkout" method="POST" >
                @csrf    
                <div class="row">
                    <div class="col-12 md-6 mb-3">
                        <label for="fullName">Full name</label>
                            @if (Auth::check())
                                <input type="text" class="form-control" id="fullName" placeholder="" value="{{$user->name}}" name="fullName" required>
                            @else
                                <input type="text" class="form-control" id="fullName" placeholder="John Doe" value="" name="fullName" required>
                            @endif
                        
                        <div class="invalid-feedback">
                        Valid full name is required.
                        </div>
                    </div>
                    {{-- <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                        Valid last name is required.
                        </div>
                    </div> --}}
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    @if (Auth::check())
                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="you@example.com" required>
                    @else
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                    @endif
                    
                    <div class="invalid-feedback">
                        Please enter a valid email address for delivery updates.
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="homeDelivery" checked="checked" onclick="javascript:yesnoCheck();">
                        <label class="form-check-label" for="inlineRadio1">Home delivery</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="pickUp" onclick="javascript:yesnoCheck();">
                        <label class="form-check-label" for="inlineRadio2">Pick up</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="remotePickUp" onclick="javascript:yesnoCheck();">
                        <label class="form-check-label" for="inlineRadio3">Remote Pick up</label>
                    </div>
                    
                    <div class="invalid-feedback">
                        Please select your delivery type
                    </div>
                </div>    

                <div class="mb-3" id="ifYes"> 
                    <div class="mb-3">
                        <label for="address">Address</label>
                        @if (Auth::check() && $user->cust_address != null)
                            <input type="text" class="form-control" id="address" name="address" value="{{$user->cust_address}}" placeholder="1234 Main St" required>
                        @else
                            <input type="text" class="form-control" id="address" name="address" placeholder="Apartment or suite" required>
                        @endif
                        
                        <div class="invalid-feedback">
                            Please enter your home address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="phonenumber">Phone Number</label>
                    @if (Auth::check() && $user->cust_phone_number != null)
                        <input type="number" class="form-control" id="phonenumber" name="phonenumber" value="{{$user->cust_phone_number}}" placeholder="+06-111-111-111" pattern="^(?:\d{2}-\d{3}-\d{3}-\d{3}|\d{11})$" required>
                    @else
                        <input type="number" class="form-control" id="phonenumber" name="phonenumber" placeholder="+06-111-111-111" pattern="^(?:\d{2}-\d{3}-\d{3}-\d{3}|\d{11})$" required>
                    @endif
                    
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" id="country" required>
                        <option value="">Choose...</option>
                        <option selected="selected" value="Malaysia">Malaysia</option>
                        </select>
                        <div class="invalid-feedback">
                        Please select a valid country.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100" id="state" required>
                        <option value="">Choose...</option>
                        <option selected="selected" value="Sarawak">Sarawak</option>
                        </select>
                        <div class="invalid-feedback">
                        Please provide a valid state.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="" required>
                        <div class="invalid-feedback">
                        Zip code required.
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <!-- <a class="btn btn-success btn-lg btn-block" href="{{ url('checkout/proceedtocheckout') }}" role="button" onclick="return confirm('Confirm Checkout?')">Place Order</a> -->
                <button id="submitButton" class="btn btn-success btn-lg btn-block" type="submit" >Place Order</button>
                <button id="myCheck" hidden="hidden" data-toggle="modal" data-target="#mediaModal" class="btn btn-success btn-lg btn-block" type="button" >Place Order</button>
                <input type="hidden" type="text" id="copyTextInBox"> 

                <!-- return confirm('Order request sent. Redirect to home?') -->
            
                <script type="text/javascript">

                    function mediaSelect(m){
                       document.getElementById('contactMedia').value=m;
                       document.getElementById('close1').click();
                      
                       if(m=="email")
                       {
                            document.getElementById('emailButton').click();
                       }else
                       {
                            document.getElementById('copyButton').click();
                            var name=document.getElementById('fullName').value;
                            var email=document.getElementById('email').value;
                            var address=document.getElementById('address').value;
                            var phonenumber=document.getElementById('phonenumber').value;

                            var random1=Math.floor(Math.random() * name.length-1)+2;
                            var random2=Math.floor(Math.random() * name.length-1)+2;
                            var random3=Math.floor(Math.random() * phonenumber.length-1)+2;
                            var random4=Math.floor(Math.random() * phonenumber.length-1)+2;
                            var random5=Math.floor(Math.random() * phonenumber.length-1)+2;
                            var random6=Math.floor(Math.random() * phonenumber.length-1)+2;

                            var name1 = name.replace(/\s/g, '');
                            name1=name1.toUpperCase();
                            var orderNumber=Math.floor(Math.random() * 100000)+name1.substring(random1-1,random1)+name1.substring(random2-1,random2)+phonenumber.substring(random3-1,random3)+phonenumber.substring(random4-1,random4)+phonenumber.substring(random5-1,random5)+phonenumber.substring(random6-1,random6);
                            document.getElementById('orderNumber').value=orderNumber;
                            
                            if(address.length<=3)
                            {
                                address="None";
                            }
                            var deliveryType=delivery;
                            var text='Hi, I have just placed an order with the following details:\nOrder Number: ' + orderNumber + '\nCustomer Name: ' + name + '\nEmail: ' + email + '\nAddress: ' + address + '\nDelivery Type: ' + deliveryType ;
                            $("#copyText").html(text);
                       }
                      
                    }

                    function finalSubmit() {

                        media=1;
                        document.getElementById('submitButton').click();
                        window.location.href = "/";
                    }

                    function emailSent()
                    {
                        var name=document.getElementById('fullName').value;
                        var email=document.getElementById('email').value;
                        var address=document.getElementById('address').value;
                        var phonenumber=document.getElementById('phonenumber').value;

                        var random1=Math.floor(Math.random() * name.length-1)+2;
                        var random2=Math.floor(Math.random() * name.length-1)+2;
                        var random3=Math.floor(Math.random() * phonenumber.length-1)+2;
                        var random4=Math.floor(Math.random() * phonenumber.length-1)+2;
                        var random5=Math.floor(Math.random() * phonenumber.length-1)+2;
                        var random6=Math.floor(Math.random() * phonenumber.length-1)+2;

                        var name1 = name.replace(/\s/g, '');
                        name1=name1.toUpperCase();
                        var orderNumber=Math.floor(Math.random() * 100000)+name1.substring(random1-1,random1)+name1.substring(random2-1,random2)+phonenumber.substring(random3-1,random3)+phonenumber.substring(random4-1,random4)+phonenumber.substring(random5-1,random5)+phonenumber.substring(random6-1,random6);
                        document.getElementById('orderNumber').value=orderNumber;
                        media=1;
                        document.getElementById('submitButton').click();
                    }

        
                </script>

              <!-- Social Media Modal -->
              <div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div  class="modal-content col-12">
                        <div class="modal-header">
                            <h6 style="font-size:17px; padding-left:40px; color:#25D366" class="modal-title">Choose Your Preferred Way Of Communication</h6> <button id="close1" type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <div class="modal-body">
                            <div class="icon-container1 d-flex">
                                <div class="smd"> <button type="button" style="background-color:white; border:none;" onclick="mediaSelect('whatsapp')"><i class="img-thumbnail fab fa-whatsapp fa-2x" style="color: #25D366;background-color: #cef5dc;"></i> </button>
                                    <p>Whatsapp</p>
                                </div>
                                <div class="smd"> <button type="button" style="background-color:white; border:none;" onclick="mediaSelect('messenger')"><i class="img-thumbnail fab fa-facebook-messenger fa-2x" style="color: #3b5998;background-color: #eceff5;"></i> </button>
                                    <p>Messenger</p>
                                </div>
                                <div class="smd"> <button type="button" style="background-color:white; border:none;" onclick="mediaSelect('email')"><i class="img-thumbnail fa fa-envelope-o fa-2x" style="padding-top:15px; color: red;background-color:rgb(255, 195, 195);"></i> </button>
                                    <p>Email</p>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" type="text" class="form-control" id="contactMedia" name="contactMedia"> 
                        <input type="hidden" type="text" class="form-control" id="orderNumber" name="orderNumber"> 

                        <div class="modal-footer">
                        
                        </div>
                    </div>
                </div>
            </div>
            <!-- Social Media Modal End -->
            <button  hidden="hidden" type="button" id="copyButton" data-toggle="modal" data-target="#copyModal"></button>
            <!-- Click To Copy Modal-->
            <div class="modal fade" id="copyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div  class="modal-content col-12">
                        <div class="modal-header">
                            <h6 style="font-size:17px; padding-left:170px; color:#25D366" class="modal-title">IMPORTANT!</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <div class="modal-body">
                            <p>Please Copy Your Order Details Below And Click Continue To Complete Checkout. Paste The Details In Your Chosen Social Media Platform To Immediately Notify The Client!</p>
                            <textarea style="margin-left:2px; max-width: 100%;" rows="4" cols="56" id="copyText"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="finalSubmit()" class="btn btn-success btn-sm btn-block">Continue</button> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Click To Copy Modal End-->

             <button  hidden="hidden" type="button" id="emailButton" data-toggle="modal" data-target="#emailModal"></button>
             <!-- Click To Copy Modal-->
             <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                     <div  class="modal-content col-12">
                         <div class="modal-header">
                             <h6 style="font-size:17px; padding-left:180px; color:#25D366" class="modal-title">Email Sent</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                         </div>
                         <div class="modal-body">
                             <p>An Email Will Be Sent To Cacti Succulent. Please Click Below To Complete Checkout And Send The Email.</p>
                         </div>
                         <div class="modal-footer">
                             <button type="button" onclick="emailSent()" class="btn btn-success btn-sm btn-block">Proceed</button> </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Click To Copy Modal End-->
            
          
            
            </form>
        </div>
      </div>    

    </div>

   
    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
        var media=0;
        var delivery="Home Delivery";
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
        

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }else if(media==0){
                event.preventDefault();
                event.stopPropagation();
                document.getElementById("myCheck").click();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>

    <script type="text/javascript">

        function yesnoCheck() {
            if (document.getElementById('inlineRadio2').checked) {
                document.getElementById('ifYes').style.display = 'none';
                document.getElementById('address').required = false;
                delivery="Pick up";
            } else if(document.getElementById('inlineRadio1').checked){
                document.getElementById('ifYes').style.display = 'block';
                delivery="Home Delivery";
            } else if(document.getElementById('inlineRadio3').checked){
                document.getElementById('ifYes').style.display = 'block';
                delivery="Remote Pick up";
            }

           
            

        // function checkDelivery(){
        //     if ((document.getElementById('inlineRadio1').checked || document.getElementById('inlineRadio2').checked) && (document.getElementById('ifYes').style.visibility = 'hidden')) {
        //         document.getElementById('ifYes').style.visibility = 'visible';
        //     }
        // }

    }


    </script>

    <script>
        function redirectTo(){
            var ask = window.confirm('Order request sent. Redirect to home?');
            if (ask) {
                window.alert("redirecting to product page!");

                //window.location.href = "{{ url('checkout/proceedtocheckout') }}";
            }
        }


    </script>
    
  </body>
</html>