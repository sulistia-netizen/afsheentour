<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pembayaran Paket Wisata</title>
    <style>
        :root {
            --green: #0d8f4c;
            --bg: #f6f9fb;
            --text: #333;
            --card-bg: #fff;
            --highlight: #e6f5ee;
            --shadow: rgba(0, 0, 0, 0.05);
            --yellow: #ffc107;
            --yellow-dark: #e0a800;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--bg);
            margin: 0;
            padding: 0;
            color: var(--text);
            font-size: 16px;
        }

        .container {
            max-width: 800px;
            margin: 24px auto;
            padding: 16px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 12px var(--shadow);
            margin-bottom: 24px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 14px;
            font-size: 1.1rem;
            color: var(--green);
        }

        .summary p {
            margin: 6px 0;
        }

        .total {
            background: var(--highlight);
            padding: 14px;
            border-radius: 12px;
            font-weight: bold;
            color: var(--green);
            margin-top: 12px;
            text-align: center;
            font-size: 1.1rem;
        }

        .payment-info {
            background: #f1f9f3;
            padding: 16px;
            border-radius: 12px;
            font-size: 1rem;
        }

        .payment-info p {
            margin: 6px 0;
        }

        .payment-info strong {
            color: #000;
        }

        .upload-section {
            margin-top: 20px;
        }

        .upload-section label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .upload-section input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background: #fff;
            font-size: 0.95rem;
        }

        .submit-btn {
            background: var(--yellow);
            color: #333;
            font-weight: bold;
            border: none;
            padding: 16px;
            border-radius: 12px;
            width: 100%;
            margin-top: 24px;
            cursor: pointer;
            font-size: 1rem;
        }

        .submit-btn:hover {
            background: var(--yellow-dark);
        }

        .destinasi-item {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 16px;
            background: #fafafa;
        }

        .destinasi-item img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 10px;
        }

        @media (max-width: 600px) {
            body {
                font-size: 15px;
            }

            .section-title {
                font-size: 1rem;
            }

            .total {
                font-size: 1rem;
            }

            .payment-info {
                font-size: 0.95rem;
            }

            .submit-btn {
                font-size: 0.95rem;
                padding: 14px;
            }
        }

        @media (min-width: 1024px) {
            body {
                font-size: 18px;
            }

            .section-title {
                font-size: 1.3rem;
            }

            .total {
                font-size: 1.2rem;
            }

            .payment-info {
                font-size: 1.05rem;
            }

            .submit-btn {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        {{-- Detail Pembayaran --}}
        <div class="card">
            <div class="section-title">Detail Pembayaran</div>
            @php
                $paketInfo = $destinasiList[0]['paket'];
            @endphp
            <div class="summary">
                <p><strong>Paket:</strong> {{ $paketInfo['nama'] }}</p>
                <p><strong>Durasi:</strong> {{ $paketInfo['durasi'] }} hari</p>
                <div class="total">Total Pembayaran: Rp {{ number_format($paketInfo['harga'], 0, ',', '.') }}</div>
            </div>
        </div>

        {{-- Daftar Destinasi --}}
        <div class="card">
            <div class="section-title">Rincian Destinasi</div>
            @foreach ($destinasiList as $item)
                <div class="destinasi-item">
                    <h4>{{ $item['destinasi']['nama'] }}</h4>
                    <p><strong>Hari ke:</strong> {{ $item['hari_ke'] }}</p>
                    <p><strong>Jam:</strong> {{ $item['jam_mulai'] }}:00 - {{ $item['jam_selesai'] }}:00</p>
                    <p>{{ $item['destinasi']['deskripsi'] }}</p>
                    <img src="{{ asset('storage/' . $item['destinasi']['gambar']) }}"
                        alt="{{ $item['destinasi']['nama'] }}">
                </div>
            @endforeach
        </div>

        <form action="{{ route('pembayarans.upload') }}" method="POST" enctype="multipart/form-data"
            style="background:#fff; padding:24px; border-radius:16px; box-shadow:0 4px 12px rgba(0,0,0,0.05); max-width:800px; margin:auto;">
            @csrf
            <h2 style="color:#0d8f4c; margin-bottom:16px;">Transfer Pembayaran</h2>

            <p style="margin-bottom:8px; font-weight:600;">Pilih satu metode pembayaran:</p>

            <div style="background:#f1f9f3; padding:16px; border-radius:12px; margin-bottom:20px;">
                <label style="display:block; margin-bottom:10px;">
                    <input type="radio" name="metode_pembayaran" value="Bank Mandiri" required
                        style="margin-right:8px;">
                    <strong>Bank Mandiri</strong> - 1130015765385 (Meisi Arsita)
                </label>

                <label style="display:block; margin-bottom:10px;">
                    <input type="radio" name="metode_pembayaran" value="Bank Sumsel" style="margin-right:8px;">
                    <strong>Bank Sumsel</strong> - 16609014689 (Angelica Putri Alfina)
                </label>

                <label style="display:block; margin-bottom:10px;">
                    <input type="radio" name="metode_pembayaran" value="Sea Bank" style="margin-right:8px;">
                    <strong>Sea Bank</strong> - 901594691390 (Angelica Putri Alfina)
                </label>

                <label style="display:block; margin-bottom:10px;">
                    <input type="radio" name="metode_pembayaran" value="Dana" style="margin-right:8px;">
                    <strong>Dana</strong> - 0896-1526-7014
                </label>
            </div>

            <div style="margin-bottom:20px;">
                <label for="bukti_pembayaran" style="display:block; font-weight:600; margin-bottom:8px;">Upload Bukti
                    Pembayaran:</label>
                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*,application/pdf"
                    required style="padding:12px; border:1px solid #ccc; border-radius:10px; width:100%;">
            </div>

            <input type="hidden" name="id_booking" value="{{ $booking->id ?? '' }}">

            <button type="submit"
                style="background:#ffc107; color:#333; font-weight:bold; padding:16px; border:none; border-radius:12px; width:100%; font-size:1rem; cursor:pointer;">
                Kirim Bukti Pembayaran
            </button>
        </form>


    </div>


    </div>
</body>

</html>
