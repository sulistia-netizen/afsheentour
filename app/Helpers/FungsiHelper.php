<?php
function haversine($coord1, $coord2)
{
    $R = 6371; // Radius bumi dalam km

    // Ambil koordinat dan pastikan bertipe float
    list($lat1, $lon1) = array_map('floatval', $coord1);
    list($lat2, $lon2) = array_map('floatval', $coord2);

    // Hitung selisih radian
    $dlat = deg2rad($lat2 - $lat1);
    $dlon = deg2rad($lon2 - $lon1);

    // Rumus haversine
    $a = sin($dlat / 2) ** 2 +
        cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
        sin($dlon / 2) ** 2;

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $R * $c; // hasil dalam kilometer
}


function durasi_transportasi($coord1, $coord2, $waktu_per_km = 5)
{
    $jarak_km = haversine($coord1, $coord2);
    return $jarak_km * $waktu_per_km; // hasil dalam menit
}

function biaya_transportasi($coord1, $coord2, $biaya = 500)
{
    $jarak_km = haversine($coord1, $coord2);
    return $jarak_km * $biaya; // hasil dalam rupiah
}


function hitung_jarak_km($coord1, $coord2)
{
    $R = 6371; // Radius bumi dalam km
    list($lat1, $lon1) = $coord1;
    list($lat2, $lon2) = $coord2;

    $dlat = deg2rad($lat2 - $lat1);
    $dlon = deg2rad($lon2 - $lon1);
    $a = sin($dlat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dlon / 2) ** 2;
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    return $R * $c;
}
