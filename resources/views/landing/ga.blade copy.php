

    <?php

    echo "<br><br>start palembang<br><br>";
    

        $counter = 0;
        $hotel_terpilih = $best_chromosome[1];
        $transportasi_terpilih = $best_chromosome[2];
        $koordinat_palembang = [-2.990934, 104.756554];

        foreach ($itinerary_akhir as $hari => $aktivitas) {
            echo "<br>Hari ke : " . ($hari + 1) . "\n<br>";
            $jam_berangkat = 8;
            $counter2 = 0;
            $a_sebelum = null;

            foreach ($aktivitas as $a) {
                if ($counter == 0 && $counter2 == 0) {
                    $durasi_berangkat = round(durasi_transportasi($koordinat_palembang, $a['koordinat'], $transportasi_terpilih['menit_per_km_luar_kota']) / 60);
                    echo "<br>$jam_berangkat s/d " . ($jam_berangkat + $durasi_berangkat) . " | Keberangkatan\n<br>";
                    $jam_berangkat += $durasi_berangkat;
                } elseif ($counter2 == 0) {
                    $durasi_berangkat = round(durasi_transportasi($hotel_terpilih['koordinat'], $a['koordinat'], $transportasi_terpilih['menit_per_km_dalam_kota']) / 60);
                    echo "<br>$jam_berangkat s/d " . ($jam_berangkat + $durasi_berangkat) . " | Keberangkatan dari Hotel\n<br>";
                    $jam_berangkat += $durasi_berangkat;
                } else {
                    $durasi_berangkat = round(durasi_transportasi($a_sebelum['koordinat'], $a['koordinat'], $transportasi_terpilih['menit_per_km_dalam_kota']) / 60);
                    echo "<br>$jam_berangkat s/d " . ($jam_berangkat + $durasi_berangkat) . " | Perjalanan\n<br>";
                    $jam_berangkat += $durasi_berangkat;
                }

                if ($a === end($aktivitas)) {
                    echo "$jam_berangkat s/d selesai | {$a['nama']} ({$a['biaya']})\n<br>";
                } else {
                    $durasi_bermain = round($a['durasi'] / 60);
                    echo "$jam_berangkat s/d " . ($jam_berangkat + $durasi_bermain) . " | {$a['nama']} ({$a['biaya']})\n";
                    $jam_berangkat += $durasi_bermain;
                }

                $a_sebelum = $a;
                $counter2++;
            }
            echo "\n";
            $counter++;
        }

        
        echo "</br>end palembang ";

?>