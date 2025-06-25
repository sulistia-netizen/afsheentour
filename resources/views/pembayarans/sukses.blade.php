<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran Sukses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f0f9f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .success-container {
            max-width: 600px;
            margin: 80px auto;
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .success-icon {
            font-size: 64px;
            color: #0d8f4c;
            margin-bottom: 20px;
        }

        .btn-home {
            background-color: #0d8f4c;
            color: #fff;
            padding: 12px 24px;
            border-radius: 8px;
            margin-top: 24px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-home:hover {
            background-color: #0b7a3f;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="success-container">
        <div class="success-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <h2 class="text-success">Pembayaran Berhasil!</h2>
        <p class="mt-3">Terima kasih telah mengirim bukti pembayaran.<br>Tim kami akan segera melakukan verifikasi.
        </p>

        <a href="{{ url('/') }}" class="btn-home">
            <i class="bi bi-house-door-fill me-1"></i> Kembali ke Beranda
        </a>
    </div>

</body>

</html>
