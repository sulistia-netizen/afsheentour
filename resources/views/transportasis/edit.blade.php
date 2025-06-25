@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit transportasi</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('transportasis.index') }}"> Back</a>
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
    <form action="{{ route('transportasis.update', $transportasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama :</strong>
                    <input type="text" name="nama" value="{{ $transportasi->nama }}"class="form-control" placeholder="nama">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah Penumpang:</strong>
                    <input type="text" name="jumlah_penumpang" value="{{ $transportasi->jumlah_penumpang }}" class="form-control" placeholder="id_paket">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Menit per KM Luar Kota:</strong>
                    <input type="text" name="menit_per_km_luar_kota" value="{{ $transportasi->menit_per_km_luar_kota }}" class="form-control" placeholder="menit_per_km_luar_kota">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Menit per KM Dalam Kota:</strong>
                    <input type="text" name="menit_per_km_dalam_kota" value="{{ $transportasi->menit_per_km_dalam_kota }}" class="form-control" placeholder="menit_per_km_dalam_kota">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Biaya Per KM:</strong>
                    <input type="text" name="biaya_per_km" value="{{ $transportasi->biaya_per_km }}" class="form-control" placeholder="biaya_per_km">
                </div>
            </div>
           
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
