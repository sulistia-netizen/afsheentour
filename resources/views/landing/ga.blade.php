<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Paket Wisata</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f1f8f5;
            font-family: 'Roboto', sans-serif;
            color: #1b4332;
        }

        .section-header {
            background-color: #2d6a4f;
            color: #fff;
            padding: 40px;
            border-radius: 8px;
            margin-bottom: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #1b4332;
        }

        .section-header h2 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .section-header p {
            font-size: 1.1rem;
            color: #d8f3dc;
            opacity: 0.9;
        }

        .info-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
            padding: 20px;
            border-bottom: 2px solid #95d5b2;
        }

        .info-card h6 {
            font-size: 1rem;
            color: #1b4332;
            font-weight: 600;
        }

        .info-card p {
            font-size: 0.9rem;
            color: #2f3e46;
        }

        .info-card i {
            color: #2d6a4f;
            font-size: 1.1rem;
            margin-right: 8px;
        }

        .itinerary-section {
            margin-top: 30px;
        }

        .day-header {
            background-color: #d8f3dc;
            color: #1b4332;
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 15px;
            border-left: 3px solid #1b4332;
        }

        .day-header h5 {
            font-size: 1.15rem;
            font-weight: 600;
            margin-bottom: 0;
        }

        .activity-item {
            background-color: #fff;
            padding: 18px 22px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 10px;
            border-left: 2px solid #52b788;
        }

        .activity-item h6 {
            font-size: 1rem;
            font-weight: 500;
            color: #1b4332;
            margin-bottom: 5px;
        }

        .activity-item p {
            font-size: 0.9rem;
            color: #2f3e46;
        }

        .activity-item .time {
            font-size: 0.85rem;
            color: #6c757d;
            font-style: italic;
        }

        .btn-order {
            background-color: #1b4332;
            color: #fff;
            font-weight: 600;
            padding: 14px 30px;
            font-size: 1rem;
            border: none;
            border-radius: 8px;
            margin-top: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease-in-out;
        }

        .btn-order:hover {
            background-color: #081c15;
            transform: scale(1.03);
        }

        .info-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .btn-success {
            background-color: #40916c !important;
            border-color: #40916c;
        }

        .btn-success:hover {
            background-color: #2d6a4f !important;
            border-color: #2d6a4f;
        }

        .timeline-vertical {
            border-left: 4px solid #52b788;
            margin: 40px 0;
            padding-left: 20px;
            position: relative;
        }

        .timeline-item-vertical {
            position: relative;
            margin-bottom: 30px;
            padding-left: 20px;
        }

        .timeline-item-vertical::before {
            content: '';
            position: absolute;
            left: -12px;
            top: 8px;
            width: 16px;
            height: 16px;
            background-color: #2d6a4f;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 2px #52b788;
        }

        .timeline-date-badge {
            background-color: #2d6a4f;
            color: white;
            padding: 4px 12px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            border-radius: 20px;
            margin-bottom: 8px;
        }

        .timeline-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1b4332;
            margin-bottom: 4px;
        }

        .timeline-time {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 4px;
        }

        .timeline-desc {
            font-size: 0.9rem;
            color: #344e41;
        }
    </style>
</head>

<body>

    <div class="alert alert-danger d-flex align-items-center m-2" role="alert">
        <i class="bi bi-info-circle-fill me-2"></i>
        <div>
            Jika Anda ingin melihat paket lain, <strong>silakan muat ulang halaman</strong> untuk melihat
            paket lain.
        </div>
    </div>

    <div class="container my-5">
        <div class="section-header">
            <h2><i class="bi bi-bookmark-heart-fill me-2"></i> Paket Anda: {{ $paket->nama }}</h2>
            <p>Selami petualangan anda dengan menyenangkan.</p>
        </div>

        <div class="info-section">
            <div class="info-card">
                <h6><i class="bi bi-people-fill"></i> Peserta</h6>
                <p>{{ $paket->jumlah_orang }} Orang</p>
            </div>
            <div class="info-card">
                <h6><i class="bi bi-cash-coin"></i> Biaya Total</h6>
                <p>Rp{{ number_format($paket->harga, 0, ',', '.') }}</p>
            </div>
            <div class="info-card">
                <h6><i class="bi bi-calendar-check-fill"></i> Durasi</h6>
                <p>{{ $paket->durasi }} Hari</p>
            </div>
            <div class="info-card">
                <h6><i class="bi bi-building"></i> Penginapan</h6>
                <p>{{ $paket->hotel?->nama_hotel ?? 'Tidak Termasuk' }}</p>
            </div>
            <div class="info-card">
                <h6><i class="bi bi-bus-front-fill"></i> Transportasi</h6>
                <p>{{ $paket->transportasi?->nama ?? 'Informasi Tidak Tersedia' }}</p>
            </div>
        </div>

        <div class="timeline-vertical">
            <h4 class="text-success mb-4 fw-bold">
                <i class="bi bi-clock-history me-2"></i> Rangkaian Perjalanan
            </h4>

            @foreach ($paket->detail_paket->sortBy(['hari_ke', 'jam_mulai']) as $dp)
                <div
                    class="timeline-item-vertical mb-4 p-3 border-start border-3 border-success bg-light rounded shadow-sm">
                    <div class="timeline-date-badge fw-bold text-light mb-1">
                        Hari ke-{{ $dp->hari_ke }}
                    </div>

                    <div class="timeline-title h5 text-dark mb-2">
                        <i class="bi bi-geo-alt-fill me-1 text-success"></i>
                        {{ $dp->destinasi?->nama ?? 'Destinasi Wisata' }}
                    </div>

                    <div class="timeline-time mb-2 text-muted">
                        <i class="bi bi-clock me-1"></i>
                        {{ $dp->jam_mulai }} - {{ $dp->jam_selesai }}
                    </div>
                </div>
            @endforeach
        </div>



        {{-- Form Pemesanan --}}
        {{-- <div class="card mt-5 shadow" style="max-width: 700px; margin: 0 auto;">
            <div class="card-body">
                <h4 class="card-title text-center mb-4 text-success">
                    <i class="bi bi-person-lines-fill me-2"></i> Data Pemesan
                </h4>
                <form action="{{ route('pembayaran.transfer', $paket->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_paket" value="{{ $paket->id }}">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option selected disabled>Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label">Nomor HP</label>
                        <input type="tel" class="form-control" id="nomor_hp" name="nomor_hp"
                            placeholder="08xxxxxxxxxx" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="alamat_email" name="alamat_email"
                            placeholder="contoh@email.com" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100 mt-3">
                        <i class="bi bi-check-circle me-1"></i> Lanjut ke Pembayaran
                    </button>
                </form>
            </div>
        </div> --}}

        <!-- Tombol Back ke Dashboard dan Pesan Sekarang -->
        <div class="d-flex gap-2">
            <!-- Tombol Back ke Dashboard -->
            <a href="{{ route('landing') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>

            <!-- Tombol Pesan Sekarang -->
            @if (Auth::check())
                <!-- Jika sudah login, buka modal form pemesanan -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalPemesanan">
                    <i class="bi bi-cart-plus me-1"></i> Pesan Sekarang
                </button>
            @else
                <!-- Jika belum login, buka modal notifikasi login -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalHarusLogin">
                    <i class="bi bi-cart-plus me-1"></i> Pesan Sekarang
                </button>
            @endif
        </div>



        <!-- Modal Form Pemesan -->
        <div class="modal fade" id="modalPemesanan" tabindex="-1" aria-labelledby="modalPemesananLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content shadow">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalPemesananLabel">
                            <i class="bi bi-person-lines-fill me-2"></i> Data Pemesan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pembayaran.transfer', $paket->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_paket" value="{{ $paket->id }}">

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukkan nama lengkap" value="{{ $user->name }}" readonly required>
                            </div>

                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Pengguna</label>
                                <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                    placeholder="Masukkan jenis kelamin" value="{{ $user->pengguna->jenis_kelamin }}"
                                    readonly required>
                            </div>

                            <div class="mb-3">
                                <label for="nomor_hp" class="form-label">Nomor HP</label>
                                <input type="tel" class="form-control" id="nomor_hp" name="nomor_hp"
                                    placeholder="08xxxxxxxxxx" value="{{ $user->pengguna->nomor_hp }}" readonly
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="alamat_email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control" id="alamat_email" name="alamat_email"
                                    placeholder="contoh@email.com" value="{{ $user->pengguna->alamat_email }}"
                                    readonly required>
                            </div>

                            <div class="modal-footer p-0 pt-3">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle me-1"></i> Lanjut ke Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Harus Login -->
        <div class="modal fade" id="modalHarusLogin" tabindex="-1" aria-labelledby="modalHarusLoginLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalHarusLoginLabel">
                            <i class="bi bi-lock-fill me-2"></i> Login Diperlukan
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body text-center text-black">
                        <p>Untuk melakukan pemesanan, silakan login terlebih dahulu.</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
