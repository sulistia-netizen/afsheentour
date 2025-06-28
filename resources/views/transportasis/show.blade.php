@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show transportasi</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('transportasis.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama:</strong>
                {{ $transportasi->nama }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jumlah Penumpang:</strong>
                {{ $transportasi->jumlah_penumpang }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Menit per KM Luar Kota:</strong>
                {{ $transportasi->menit_per_km_luar_kota }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Menit per KM Dalam Kota:</strong>
                {{ $transportasi->menit_per_km_dalam_kota }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Biaya Per KM:</strong>
                {{ $transportasi->biaya_per_km }}
            </div>
        </div>
    </div>
@endsection
