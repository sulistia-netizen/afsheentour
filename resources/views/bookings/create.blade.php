@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Booking</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('bookings.index') }}"> Back</a>
            </div>
        </div>
    </div>
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

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Pelanggan:</strong>
                    <select name="id_user" class="form-control">
                        <option selected>Pilih Pelanggan</option>
                        @foreach ($users as $user)
                            <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <div class="form-group">
                        <strong>ID Paket:</strong>
                        <select name="id_paket" class="form-control">
                            <option selected disabled>Pilih Paket</option>
                            @foreach ($pakets as $paket)
                                <option value="{{ $paket['id'] }}">{{ $paket['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Jumlah Orang:</strong>
                        <input type="text" name="jumlah_orang" class="form-control" placeholder="jumlah_orang">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Tanggal Mulai:</strong>
                        <input type="text" name="tanggal_mulai" class="form-control" placeholder="tanggal_mulai">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Jumlah Biaya:</strong>
                        <input type="text" name="jumlah_biaya" class="form-control" placeholder="jumlah_biaya">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Status:</strong>
                        <input type="text" name="status" class="form-control" placeholder="status">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </div>
    </form>
@endsection
