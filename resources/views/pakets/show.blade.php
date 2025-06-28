@extends('layouts.main')
@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Show Paket</h2>
        </div>
        <div class="col-md-6 text-end">
            <a class="btn btn-primary" href="{{ route('pakets.index') }}">Back</a>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6"><strong>Nama:</strong> {{ $paket->nama }}</div>
        <div class="col-md-6"><strong>Deskripsi:</strong> {{ $paket->deskripsi }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6"><strong>Jumlah Orang:</strong> {{ $paket->jumlah_orang }}</div>
        <div class="col-md-6"><strong>Harga:</strong> {{ $paket->harga }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6"><strong>Durasi:</strong> {{ $paket->durasi }}</div>
        <div class="col-md-6"><strong>Gambar:</strong> {{ $paket->gambar }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6"><strong>Is AI:</strong> {{ $paket->is_ai }}</div>
        <div class="col-md-6"><strong>ID Hotel:</strong> {{ $paket->id_hotel }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6"><strong>ID Transportasi:</strong> {{ $paket->id_transportasi }}</div>
        <div class="col-md-6"><strong>Tanggal Mulai:</strong> {{ $paket->tanggal_mulai }}</div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6"><strong>Tanggal Selesai:</strong> {{ $paket->tanggal_selesai }}</div>
    </div>
</div>
@endsection
