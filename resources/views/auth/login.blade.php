<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AFSHEENTOUR - Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="/free_travel/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/free_travel/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/free_travel/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/free_travel/css/style.css" rel="stylesheet">

    <style>
        /* Custom styles for the login page to center the form and apply theme colors */
        body {
            background-color: #F0F0F0; /* Light background similar to the theme */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Full viewport height */
            margin: 0;
            padding: 20px; /* Add some padding for smaller screens */
            box-sizing: border-box;
        }

        .auth-box.card {
            background-color: #ffffff; /* White card background */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1); /* Soft shadow */
            padding: 30px;
            max-width: 450px; /* Max width for the form card */
            width: 100%;
            text-align: center;
        }

        .auth-box .card-block {
            padding: 0; /* Remove default card-block padding if any */
        }

        .auth-box h3.text-center {
            color: #007bff; /* Primary color for heading */
            margin-bottom: 25px;
            font-weight: 700;
        }

        .form-group.form-primary {
            position: relative;
            margin-bottom: 30px;
        }

        .form-group.form-primary input.form-control {
            border: none;
            border-bottom: 2px solid #ced4da; /* Light gray border for input */
            border-radius: 0;
            padding: 10px 0;
            background-color: transparent;
            font-size: 16px;
            color: #495057;
            transition: border-color 0.3s ease-in-out;
        }

        .form-group.form-primary input.form-control:focus {
            border-color: #007bff; /* Primary color on focus */
            box-shadow: none;
        }

        .form-group.form-primary label.float-label {
            position: absolute;
            top: 12px;
            left: 0;
            color: #6c757d;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
            pointer-events: none; /* Make label unclickable */
        }

        .form-group.form-primary input.form-control:focus ~ label.float-label,
        .form-group.form-primary input.form-control:not(:placeholder-shown) ~ label.float-label {
            top: -10px;
            font-size: 12px;
            color: #007bff; /* Primary color when active */
        }

        .form-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #007bff; /* Primary color for form bar */
            transform: scaleX(0);
            transition: transform 0.3s ease-in-out;
        }

        .form-group.form-primary input.form-control:focus ~ .form-bar {
            transform: scaleX(1);
        }

        .btn-primary {
            background-color: #007bff; /* Primary button color */
            border-color: #007bff;
            border-radius: 5px;
            padding: 12px 25px;
            font-size: 18px;
            font-weight: 600;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker primary on hover */
            border-color: #0056b3;
        }

        hr {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .text-inverse {
            color: #343a40 !important; /* Dark text for inverse */
        }

        .text-left {
            text-align: left !important;
        }

        .m-b-0 { margin-bottom: 0 !important; }
        .m-b-20 { margin-bottom: 20px !important; }
        .m-t-25 { margin-top: 25px !important; }
        .m-t-30 { margin-top: 30px !important; }

        a {
            color: #007bff; /* Primary color for links */
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3; /* Darker primary on link hover */
            text-decoration: underline;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .auth-box.card {
                padding: 20px;
                margin: 10px;
            }
            .auth-box h3.text-center {
                font-size: 24px;
            }
            .form-group.form-primary input.form-control,
            .form-group.form-primary label.float-label {
                font-size: 14px;
            }
            .btn-primary {
                font-size: 16px;
                padding: 10px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8 col-lg-6">
                <!-- Authentication card start -->
                <form class="md-float-material form-material" action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center">Sign In</h3>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <input type="text" name="email" class="form-control" required="" placeholder=" ">
                                <span class="form-bar"></span>
                                <label class="float-label">Your Email Address</label>
                            </div>
                            <div class="form-group form-primary">
                                <input type="password" name="password" class="form-control" required="" placeholder=" ">
                                <span class="form-bar"></span>
                                <label class="float-label">Password</label>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign
                                        in</button>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <p class="text-inverse m-b-0">Dont Have An Account ?.</p>
                                    <p class="text-inverse"><a href="{{ route('register') }}"><b>Register here</b></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- end of form -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/free_travel/lib/easing/easing.min.js"></script>
    <script src="/free_travel/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/free_travel/lib/tempusdominus/js/moment.min.js"></script>
    <script src="/free_travel/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="/free_travel/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/free_travel/mail/jqBootstrapValidation.min.js"></script>
    <script src="/free_travel/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="/free_travel/js/main.js"></script>
</body>

</html>
