@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Paket</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('pakets.index') }}"> Back</a>
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
    <form action="{{ route('pakets.update', $paket->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama:</strong>
                    <input type="text" name="nama" value="{{ $paket->nama }}" class="form-control"
                        placeholder="nama">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deskripsi:</strong>
                    <input type="text" name="deskripsi" value="{{ $paket->deskripsi }}" class="form-control"
                        placeholder="deskripsi">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah Orang:</strong>
                    <input type="text" name="jumalh_orang" value="{{ $paket->jumlah_orang }}" class="form-control"
                        placeholder="jumlah_orang">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Harga:</strong>
                    <input type="text" name="harga" value="{{ $paket->harga }}" class="form-control"
                        placeholder="harga">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Durasi:</strong>
                    <input type="text" name="durasi" value="{{ $paket->durasi }}" class="form-control"
                        placeholder="durasi">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Gambar:</strong>
                    <input type="file" name="gambar" value="{{ $paket->gambar }}" class="form-control"
                        placeholder="gambar">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>IS AI:</strong>
                    <input type="text" name="is_ai" value="{{ $paket->is_ai }}" class="form-control"
                        placeholder="is_ai">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Hotel:</strong>
                    <input type="text" name="is_ai" value="{{ $paket->id_hotel }}" class="form-control"
                        placeholder="id_hotel">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Transportasi:</strong>
                    <input type="text" name="id_transportasi" value="{{ $paket->is_ai }}" class="form-control"
                        placeholder="id_transportasi">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Mulai:</strong>
                    <input type="text" name="tanggal_mulai" value="{{ $paket->tanggal_mulai }}" class="form-control"
                        placeholder="tanggal_mulai">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Selesai:</strong>
                    <input type="text" name="tanggal_selesai" value="{{ $paket->tanggal_selesai }}" class="form-control"
                        placeholder="tanggal_selesai">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
