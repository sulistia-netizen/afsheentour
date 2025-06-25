<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Booking</title>
</head>
<body>
    <h2>Halo {{ $booking->user->name ?? 'Pelanggan' }},</h2>
    <p>Terima kasih telah melakukan booking!</p>
    <p><strong>ID Booking:</strong> {{ $booking->id }}</p>
    <p><strong>Paket:</strong> {{ $booking->paket->nama ?? '-' }}</p>
    <p><strong>Tanggal Mulai:</strong> {{ $booking->tanggal_mulai }}</p>
    <p><strong>Jumlah Orang:</strong> {{ $booking->jumlah_orang }}</p>
    <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
    <br>
    <p>Salam, <br> Tim Afsheen Tour</p>
</body>
</html>
