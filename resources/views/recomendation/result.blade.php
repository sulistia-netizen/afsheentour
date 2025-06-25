<h1>Rekomendasi Paket Travel Terbaik</h1>
<div>
    <p>Destinasi: {{ $bestPackage->destination->name }}</p>
    <p>Durasi: {{ $bestPackage->duration }} hari</p>
    <p>Budget: Rp{{ number_format($bestPackage->budget, 2, ',', '.') }}</p>
    <p>Aktivitas: {{ $bestPackage->activities->pluck('name')->implode(', ') }}</p>
</div>