@extends('auth.layout')
@section('content')
    <div class="container-fluid">


        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your
                input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <form class="md-float-material form-material" action="{{ route('register.post') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="text-center">
                        <img src="/admin/assets/images/logo.png" alt="logo.png">
                    </div> --}}
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center txt-primary">Sign up</h3>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <input type="text" name="nama" class="form-control" required>
                                <span class="form-bar"></span>
                                <label class="float-label">Nama</label>
                            </div>
                            <div class="form-group form-primary">
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group form-primary">
                                <input type="number" name="nomor_hp" class="form-control" required>
                                <span class="form-bar"></span>
                                <label class="float-label">Nomor HP</label>
                            </div>

                            <div class="form-group form-primary">
                                <input type="email" name="alamat_email" class="form-control" required>
                                <span class="form-bar"></span>
                                <label class="float-label">Alamat Email</label>
                            </div>
                            <div class="form-group form-primary">
                                <input type="password" name="password" class="form-control" required>
                                <span class="form-bar"></span>
                                <label class="float-label">Password</label>
                            </div>
                            <div class="form-group form-primary">
                                <input type="password" name="confirm_password" class="form-control" required>
                                <span class="form-bar"></span>
                                <label class="float-label">Confirm Password</label>
                            </div>
                            <div class="row m-t-25 text-left">
                                {{-- <div class="col-md-12">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" value>
                                            <span class="cr"><i
                                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">I read and accept <a href="#">Terms &amp;
                                                    Conditions.</a></span>
                                        </label>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-12">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" value>
                                            <span class="cr"><i
                                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Send me the <a href="#!">Newsletter</a>
                                                weekly.</span>
                                        </label>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign up
                                        now</button>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="text-inverse text-left m-b-0">Already Acccount ?.</p>
                                    <p class="text-inverse text-left"><a href="{{ route('login') }}"><b>click here</b></a>
                                    </p>
                                </div>
                                {{-- <div class="col-md-2">
                                    <img src="/admin/assets/images/auth/Logo-small-bottom.png" alt="small-logo.png">
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
@endsection
