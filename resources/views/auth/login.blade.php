@extends('auth.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->

                <form class="md-float-material form-material" action="{{ route('login.post') }}" method="POST">
                    @csrf
                    {{-- <div class="text-center">
                        <img src="assets/images/logo.png" alt="logo.png">
                    </div> --}}
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center">Sign In</h3>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <input type="text" name="email" class="form-control" required="">
                                <span class="form-bar"></span>
                                <label class="float-label">Your Email Address</label>
                            </div>
                            <div class="form-group form-primary">
                                <input type="password" name="password" class="form-control" required="">
                                <span class="form-bar"></span>
                                <label class="float-label">Password</label>
                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-12">
                                    {{-- <div class="checkbox-fade fade-in-primary d-">
                                        <label>
                                            <input type="checkbox" value="">
                                            <span class="cr"><i
                                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Remember me</span>
                                        </label>
                                    </div> --}}
                                    {{-- <div class="forgot-phone text-right f-right">
                                        <a href="#" class="text-right f-w-600"> Forgot Password?</a>
                                    </div> --}}
                                </div>
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
                                <div class="col-md-10">
                                <p class="text-inverse text-left m-b-0">Dont Have An Account ?.</p>
                                    <p class="text-inverse text-left"><a href="{{ route('register') }}"><b>Register here</b></a></p>
                                </div>
                                {{-- <div class="col-md-2">
                                    <img src="assets/images/auth/Logo-small-bottom.png" alt="small-logo.png">
                                </div> --}}
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
@endsection
