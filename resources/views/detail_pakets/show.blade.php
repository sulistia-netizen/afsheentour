@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show detail_paket</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('detail_pakets.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>ID Paket:</strong>
            {{ $detail_paket->id_paket }}
            </div>
        </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jam Mulai:</strong>
                {{ $detail_paket->jam_mulai }}
            </div>
        </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jam Selesai:</strong>
                {{ $detail_paket->jam_selesai }}
            </div>
        </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID Destinasi:</strong>
                {{ $detail_paket->id_destinasi }}
            </div>
        </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID Transportasi:</strong>
                {{ $detail_paket->id_destinasi }}
            </div>
        </div>
    </div>
@endsection