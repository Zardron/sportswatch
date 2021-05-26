<!DOCTYPE html>
<html>

<head>
    <title>BOGO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</head>

<body>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerModal">
        REGISTER
    </button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
        LOGIN
    </button>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="fupForm" name="form1" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="fname" placeholder="Firstname" name="fname">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="lname" placeholder="Lastname" name="lname">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone">
                        </div>
                        <center>
                            <button type="button" name="save" class="btn btn-primary w-100" id="butsave">Request OTP</button>
                        </center>
                </div>
            </div>
        </div>
    </div>

    <!-- Verify Modal -->
    <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalLabel">ACCOUNT VERIFICATION</h5>
                </div>
                <div class="modal-body">
                    <form id="fupForm" name="form1" method="post">
                        <div class="form-group">
                            We have sent OTP Code to the mobile number provided.
                            <label for="pwd">Please Verify your Account</label>
                            <input type="text" class="form-control" id="otp" placeholder="OTP PIN" name="phone">
                        </div>
                </div>

                <div class="modal-footer">
                    <!-- <button id="btnCounter" class="btn btn-success" disabled><span id="count"></span> Resend OTP</button> -->
                    <button type="button" name="save" class="btn btn-primary" id="verify">Verify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Request OTP Modal -->
    <?php include '../sportswatch/scenes/modules/modals/sessions/loginModal.php' ?>

    <script>
        $(document).ready(function() {
            $('#verify').on('click', function() {
                var otp = $('#otp').val();
                if (otp != "") {
                    $.ajax({
                        url: "verify.php",
                        method: "POST",
                        data: {
                            otp: otp,
                        },
                        cache: false,
                        success: function(dataResult) {
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                Swal.fire({
                                    toast: true,
                                    icon: 'success',
                                    title: 'Account successfully verified!',
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })
                                $('#verifyModal').modal('hide');
                                $('#otp').val("");
                                $('#name').val("");
                                $('#phone').val("");
                            } else if (dataResult.statusCode == 201) {
                                Swal.fire({
                                    toast: true,
                                    icon: 'error',
                                    title: 'Invalid OTP Pin!',
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })
                            }

                        }
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: 'OTP Pin is Required!',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#butsave').on('click', function() {
                var lname = $('#lname').val();
                var fname = $('#fname').val();
                var username = $('#username').val();
                var phone = $('#phone').val();
                if (fname != "" && lname != "" && username != "" && phone != "") {
                    $.ajax({
                        url: "save.php",
                        method: "POST",
                        data: {
                            fname: fname,
                            lname: lname,
                            username: username,
                            phone: phone,
                        },
                        cache: false,
                        success: function(dataResult) {
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                $('#registerModal').modal('hide');
                                Swal.fire({
                                    toast: true,
                                    icon: 'success',
                                    title: 'Please verify your account!',
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })
                                $('#verifyModal').modal({
                                    backdrop: 'static',
                                    keyboard: false
                                })
                                $('#verifyModal').modal('show');


                                // var spn = document.getElementById("count");
                                // var btn = document.getElementById("btnCounter");

                                // var count = 15; // Set count
                                // var timer = null; // For referencing the timer

                                // (function countDown() {
                                //     // Display counter and start counting down
                                //     spn.textContent = count;

                                //     // Run the function again every second if the count is not zero
                                //     if (count !== 0) {
                                //         timer = setTimeout(countDown, 1000);
                                //         count--; // decrease the timer
                                //     } else {
                                //         // Enable the button
                                //         btn.removeAttribute("disabled");
                                //         document.getElementById('count').style.display = "none";
                                //     }
                                // }());
                            } else if (dataResult.statusCode == 201) {
                                alert("Error occured !");
                            }

                        }
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: 'Please fill up all fields!',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#otp_request').on('click', function() {
                var phone = $('#phones').val();
                if (phone != "") {
                    $.ajax({
                        url: "request-otp.php",
                        method: "POST",
                        data: {
                            phone: phone,
                        },
                        cache: false,
                        success: function(dataResult) {
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                Swal.fire({
                                    toast: true,
                                    icon: 'success',
                                    title: "We sent your OTP Pin on this phone number:" + dataResult.phone,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                }).then(function() {
                                    window.location = "aw.php";
                                });
                            } else if (dataResult.statusCode == 401) {
                                Swal.fire({
                                    toast: true,
                                    icon: 'error',
                                    title: 'Your phone number is not yet verified, Please register your phone number and verify!',
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 5000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })
                            } else if (dataResult.statusCode == 404) {
                                Swal.fire({
                                    toast: true,
                                    icon: 'error',
                                    title: 'Phone number not found!',
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })
                            } else if (dataResult.statusCode == 201) {
                                alert("Error occured !");
                            }

                        }
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: 'Phone number is required!',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                }
            });
        });
    </script>
</body>

</html>