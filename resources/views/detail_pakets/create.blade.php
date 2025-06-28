@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Detail Paket</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('detail_pakets.index') }}"> Back</a>
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

    <form action="{{ route('detail_pakets.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nomor:</strong>
                    <input type="text" name="nomor" class="form-control" placeholder="Nomor">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
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
                    <strong>Jam Mulai:</strong>
                    <input type="text" name="jam_mulai" class="form-control" placeholder="jam_mulai">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jam Selesai:</strong>
                    <input type="text" name="jam_selesai" class="form-control" placeholder="jam_selesai">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Destinasi:</strong>
                    <select name="id_destinasi" class="form-control">
                        <option selected disabled>Pilih Destinasi</option>
                        @foreach ($destinasis as $destinasi)
                            <option value="{{ $destinasi['id'] }}">{{ $destinasi['nama'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Transportasi:</strong>
                    <select name="id_transportasi" class="form-control">
                        <option selected disabled>Pilih Transportasi</option>
                        @foreach ($transportasis as $transportasi)
                            <option value="{{ $transportasi['id'] }}">{{ $transportasi['jenis'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
