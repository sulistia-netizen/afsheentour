@extends('bookings.layout')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <h2 class="mb-4 text-center text-primary fw-bold">
            {{ optional($paket->paket)->nama ?? 'Nama Paket Tidak Tersedia' }}
        </h2>

        <div class="row align-items-center">
            <div class="col-md-6 mb-4">
                @if(optional($paket->paket)->gambar)
                    <img src="{{ asset('storage/' . $paket->paket->gambar) }}" class="img-fluid rounded-4 border border-2 shadow-sm" alt="gambar paket">
                @else
                    <div class="bg-secondary text-white p-5 text-center rounded-4">Gambar Tidak Tersedia</div>
                @endif
            </div>

            <div class="col-md-6">
                <div class="bg-light p-4 rounded-4 shadow-sm">
                    <h4 class="mb-3">
                        <i class="bi bi-geo-alt-fill text-danger me-2"></i>Destinasi: {{ optional($paket->paket)->nama ?? '-' }}
                    </h4>
                    <p><strong>📝 Deskripsi:</strong><br>{{ optional($paket->paket)->deskripsi ?? '-' }}</p>
                    <p><strong>✈️ Transportasi:</strong> {{ optional(optional($paket->paket)->transportasi)->nama ?? '-' }}</p>
                    <p><strong>🗓 Durasi:</strong> {{ optional($paket->paket)->durasi ?? '-' }}</p>
                    <p><strong>💰 Harga:</strong> 
                        <span class="text-success fw-bold">
                            IDR {{ number_format(optional($paket->paket)->harga ?? 0, 0, ',', '.') }}
                        </span>
                    </p>
                    <p><strong>🧍 Jumlah Orang:</strong> {{ optional($paket->paket)->jumlah_orang ?? '-' }} orang</p>

                    <div class="text-center mt-4">
                        <a href="{{ route('pembayaran.transfer', $paket->id) }}" class="btn btn-primary btn-lg px-4 py-2 shadow-sm">
                            <i class="bi bi-cart-plus-fill me-2"></i>Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($paket->detailItinerary) && $paket->detailItinerary->count())
        <hr class="my-5">
        <div class="mt-5">
            <h4 class="mb-4 text-center">📝 Itinerary / Rencana Perjalanan</h4>
            @foreach ($paket->detailItinerary as $index => $item)
                <div class="d-flex mb-4">
                    <div class="me-3">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            {{ $index + 1 }}
                        </div>
                    </div>
                    <div>
                        <h5 class="mb-1">{{ $item->judul ?? '-' }}</h5>
                        <p class="mb-1">{{ $item->deskripsi ?? '-' }}</p>
                        <small class="text-muted">{{ $item->durasi ?? '-' }} • {{ $item->catatan ?? '' }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

