@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Detail Paket</h2>
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
    <form action="{{ route('detail_pakets.update', $detail_paket->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Paket:</strong>
                    <select name="id_paket" class="form-control">
                        <option selected disabled>Pilih Paket</option>
                        @foreach ($pakets as $paket)
                            <option value="{{ $paket['id'] }}" {{ $paket->id == $paket->id_paket ? 'selected' : '' }}>
                                {{ $paket['nama'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jam Mulai:</strong>
                    <input type="text" name="jam_mulai" value="{{ $detail_paket->jam_mulai }}" class="form-control"
                        placeholder="jam_mulai">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jam Selesai:</strong>
                    <input type="text" name="jam_selesai" value="{{ $detail_paket->jam_selesai }}" class="form-control"
                        placeholder="jam_selesai">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Destinasi:</strong><br>
                    @foreach ($destinasis as $destinasi)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="id_destinasi[]"
                                value="{{ $destinasi->id }}" id="destinasi{{ $destinasi->id }}"
                                {{ isset($destinasi->id_paket) && $destinasi->id == $destinasi->id_paket ? 'checked' : '' }}>
                            <label class="form-check-label" for="destinasi{{ $destinasi->id }}">
                                {{ $destinasi->nama }}
                            </label>
                        </div>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Transportasi:</strong>
                    <select name="id_transportasi" class="form-control">
                        <option selected disabled>Pilih Transportasi</option>
                        @foreach ($trasnportasis as $transportasi)
                            <option value="{{ $transportasi['id'] }}"
                                {{ $transportasi->id == $transportasi->id_paket ? 'selected' : '' }}>
                                {{ $transportasi['nama'] }}</option>
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
