@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit ulasan</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('ulasans.index') }}"> Back</a>
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
    <form action="{{ route('ulasans.update', $ulasan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID User:</strong>
                    <input type="text" name="id_user" value="{{ $ulasan->id_user }}" class="form-control" placeholder="id_user">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Paket:</strong>
                    <select name="id_paket" class="form-control">
                        <option selected disabled>Pilih Paket</option>
                        @foreach ($pakets as $paket)
                            <option value="{{ $paket['id'] }}" {{ $paket->id == $booking->id_paket ? 'selected' : '' }}>{{ $paket['nama'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Rating:</strong>
                    <input type="text" name="rating" value="{{ $ulasan->rating }}" class="form-control" placeholder="rating">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Komentar:</strong>
                    <input type="text" name="komentar" value="{{ $ulasan->komentar }}" class="form-control" placeholder="komentar">
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
