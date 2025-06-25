<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Testimonial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 800px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
        }

        .card-header {
            background-color: #f9f9f9;
            font-weight: 600;
            border-bottom: 1px solid #ddd;
        }

        .btn-primary {
            background-color: #333;
            border-color: #333;
        }

        .btn-primary:hover {
            background-color: #000;
            border-color: #000;
        }

        .rating-stars {
            color: #f0a500;
        }

        footer {
            margin-top: 50px;
            padding: 20px 0;
            font-size: 14px;
            text-align: center;
            color: #aaa;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <h2 class="text-center mb-4">Ulasan Pengunjung</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @auth
        <div class="card mb-4">
            <div class="card-header">Berikan Ulasan Anda</div>
            <div class="card-body">
                <form action="{{ route('testimonial.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_paket" class="form-label">Pilih Paket</label>
                        <select name="id_paket" class="form-select" required>
                            <option value="">-- Pilih Paket --</option>
                            @foreach($pakets as $paket)
                                <option value="{{ $paket->id }}">{{ $paket->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" class="form-select" required>
                            <option value="5">⭐⭐⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="1">⭐</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="komentar" class="form-label">Komentar</label>
                        <textarea name="komentar" class="form-control" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                </form>
            </div>
        </div>
        @else
            <div class="alert alert-warning text-center">Silakan <a href="{{ route('login') }}">login</a> untuk menulis ulasan.</div>
        @endauth

        {{-- List Ulasan --}}
        <div class="mt-4">
            @forelse($ulasans as $ulasan)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $ulasan->user->name ?? 'Anonim' }}</strong>
                            <span class="rating-stars">{{ str_repeat('★', $ulasan->rating) }}</span>
                        </div>
                        <small class="text-muted">{{ $ulasan->paket->nama ?? 'Paket' }}</small>
                        <p class="mt-2 mb-0">{{ $ulasan->komentar }}</p>
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada ulasan.</p>
            @endforelse
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} AfsheenTour. Semua hak dilindungi.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
