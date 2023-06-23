<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cacti Succulent KCH') }}</title>

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
    
@include('admin/adminheader')

<?php 
    use Illuminate\Support\Facades\Auth;
    
    if (Auth::check()) {
        $userType = Auth::user()->user_type;
    }
?>


<!-- Page Content -->
<div style="margin-left:300px; padding-top:50px;" class="mr container mt-5 mb-5">
    <!-- <div class="d-flex justify-content-center row"> -->
        <div class="col-md-10">
            <div>
                <h2><br> Manage Administrator Accounts </h2>
            </div><!--/.section-header-->
            <hr>
            <br>
        </div>
        
        <table class="table table-hover table-bordered" id="datatable">
            <caption>All administrator users</caption>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>User type</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($admin as $admin_obj)
                <tr>
                    <td>{{ $admin_obj->id }}</td>
                    <td>{{ $admin_obj->user_type }}</td>
                    <td>{{ $admin_obj->name }}</td>
                    <td>{{ $admin_obj->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @if ($userType != 'admin')
            <button style="background:#32CD32" type="button" class="btn btn-success" id="addNewAdminBtn" onclick="showForm()">Add new admin</button>

            <button type="button" class="btn btn-danger ml-3" id="deleteAdminBtn" onclick="showDeleteForm()">Remove admin</button>
        @endif

        {{-- remove add admin account form --}}
        {{-- onsubmit="return confirm('Are you sure you want to delete this admin account?');" --}}
        
        <form class="needs-validation" onkeydown="return event.key != 'Enter';" action="/deleteAdmin" id="removeAdminForm" novalidate style="display: none;">
            <div class="mt-4 mb-3 col-5">
                <input type="text" class="form-control" name="adminId" id="adminId" placeholder="Enter Admin Id" required>
            </div>

            {{-- button calls the modal below to execute --}}
            <button type="button" onclick="deleteForm1()" style="background:#32CD32;" class="btn btn-success mt-3" >Remove Admin</button>
        </form>

        {{-- double check to confirm if user wanted to remove admin account --}}
        {{-- If confirm button is clicked in the modal, it runs a jQuery function(which at the bottom of this file) to submit the removeAdminForm above --}}

        <div style="background-color:rgba(0, 0, 0, 0.908);" class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div  class="modal-content col-12">
                    <div class="modal-header">
                        <h6 style="font-size:17px; padding-left:170px; color:#25D366" class="modal-title">IMPORTANT!</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to remove this account?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="rmvAdmin" data-dismiss="modal">Confirm</button>
                        <button type="button" style="border:red; background-color:red;" class="btn btn-success" data-dismiss="modal">Deny</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pop up message for successfully removing admin account --}}

        <div  style="background-color:rgba(0, 0, 0, 0.908);"  class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div  class="modal-content col-12">
                    <div class="modal-header">
                        <h6 style="font-size:17px; padding-left:170px; color:#25D366" class="modal-title">IMPORTANT!</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <p>Administrator account has been successfully removed</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pop up message for being unable to delete admin account --}}

        <div  style="background-color:rgba(0, 0, 0, 0.908);"  class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div  class="modal-content col-12">
                    <div class="modal-header">
                        <h6 style="font-size:17px; padding-left:170px; color:#25D366" class="modal-title">IMPORTANT!</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <p>This admin account cannot be deleted!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- add a new admin account form --}}

        <form class="needs-validation" action="/addNewAdmin" id="adminRegisterForm" novalidate style="display: none;">
            <div class="mt-4 mb-3">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter Name"
                    required>
                <div class="invalid-feedback">
                    Please enter a name
                </div>
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                <div class="invalid-feedback">
                    Please enter a valid email address.
                </div>
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control"
                aria-describedby="passwordHelpInline" required>
                <small id="passwordHelpInline" class="text-muted">
                Must be 8-20 characters long.
                </small>
                <div class="invalid-feedback">
                    Please enter a password.
                </div>
            </div>

            <button class="btn btn-success btn" type="submit">Submit</button>
        </form>

        {{-- Pop up message for successfully adding new admin account --}}
        
        <div  style="background-color:rgba(0, 0, 0, 0.908);"  class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div  class="modal-content col-12">
                    <div class="modal-header">
                        <h6 style="font-size:17px; padding-left:170px; color:#25D366" class="modal-title">IMPORTANT!</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <p>New administrator account has been successfully added</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div  style="background-color:rgba(0, 0, 0, 0.908);"  class="modal fade" id="exampleModalCenter5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div  class="modal-content col-12">
                    <div class="modal-header">
                        <h6 style="font-size:17px; padding-left:170px; color:#25D366" class="modal-title">IMPORTANT!</h6> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <p>This super admin account cannot be deleted!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
            <script>
                $(function() {
                    $('#exampleModalCenter').modal('show');
                });
            </script>
        @endif

        @if(!empty(Session::get('error_code')) && Session::get('error_code') == 6)
            <script>
                $(function() {
                    $('#exampleModalCenter2').modal('show');
                });
            </script>
        @endif

        @if(!empty(Session::get('error_code')) && Session::get('error_code') == 11)
            <script>
                $(function() {
                    $('#exampleModalCenter4').modal('show');
                });
            </script>
        @endif

        @if(!empty(Session::get('error_code')) && Session::get('error_code') == 12)
            <script>
                $(function() {
                    $('#exampleModalCenter5').modal('show');
                });
            </script>
        @endif

</div>


<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

<link href="{{ asset('sass/test.css') }}" rel="stylesheet">

<script>
    (function () {
        'use strict';
        window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
            }, false);
        });
        }, false);
    })();
</script>

<script type="text/javascript">

$(document).on("keydown", "removeAdminForm", function(event) { 
    return event.key != "Enter";
});

    function showForm() {
        var form = document.getElementById('adminRegisterForm');
        
        if (form.style.display === "none") {
            form.style.display = "block";
        }else {
            form.style.display = "none";
        }
    }

    function showDeleteForm() {
        var deleteForm = document.getElementById('removeAdminForm');

        if (deleteForm.style.display === "none") {
            deleteForm.style.display = "block";
        }else {
            deleteForm.style.display = "none";
        }
    }


    function deleteForm1() {
        $("#exampleModalCenter3").modal();
    }

    // if confirm button is clicked the remove admin form is submmited 
    $('#rmvAdmin').click(function() {
        $('#removeAdminForm').submit();
    });

</script>

</body>
</html>
