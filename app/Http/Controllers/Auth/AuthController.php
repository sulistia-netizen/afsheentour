<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Paket;
use App\Models\Destinasi;
use App\Models\DetailPaket;
use App\Models\Transportasi;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Kunjungan;
use App\Models\Pembayaran;
use App\Models\Ulasan;
use App\Models\Pengguna;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Helper;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only(
            'email',
            'password'
        );

        // $user = User::all();
        // dd($user);

        // dd(Auth::attempt($credentials));
        // dd([
        //     'credentials' => $credentials,
        //     'user' => \App\Models\User::where('email', $credentials['email'])->first(),
        // ]);


        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);


        $data = $request->all();
        $check = $this->create($data);
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard(Request $request)
    {
        // if (Auth::check()) {
        //     if (Auth::user()->hasRole('Admin')) {


        $ip = $request->ip();

        // Cek apakah IP sudah ada di tabel
        $today = Carbon::today();

        $visitorExists = Kunjungan::where('ip_address', $ip)
            ->whereDate('created_at', $today)
            ->exists();

        if (!$visitorExists) {
            // Simpan visitor baru untuk hari ini
            Kunjungan::create([
                'ip_address' => $ip,
            ]);
        }

        $totalPaket = Paket::count();
        $PesananTerkonfirmasi = Booking::count();
        $Testimonial = Ulasan::count();
        $history_pemesanan = Pembayaran::with('booking')->get();
        // $history_pemesanan = Pembayaran::with('booking')->get();

        $monthlySums = $history_pemesanan->groupBy(function ($item) {
            // Convert string "dd-MMM-yyyy" to Carbon object
            $date = Carbon::createFromFormat('d-M-Y', $item->booking->tanggal_mulai);
            // Group by year-month (e.g., "2025-06")
            return $date->format('Y-m');
        })->map(function ($group) {
            // Sum the 'nilai' for each month group
            return $group->sum('nilai');
        })->sortKeys();

        $monthlyLabels = $monthlySums->keys(); // ["2025-01", "2025-02", ...]
        $monthlyValues = $monthlySums->values(); // [150000, 200000, ...]
        // dd($monthlySums);
        $bulanIni = Carbon::now()->format('Y-m');
        $pendapatanBulanIni = $monthlySums->get($bulanIni, 0);

        return view('layouts.dashboard', compact('totalPaket', 'PesananTerkonfirmasi', 'Testimonial', 'monthlyLabels', 'monthlyValues', 'pendapatanBulanIni'));
        // }
        // return view('layouts.dashboard');
        // }
        // return redirect("login")->withSuccess('Opps!
        // You do not have access');
    }

    public function landing()
    {
        $paket = Paket::where('is_ai', '=', 0)->get();
        $destinasi = Destinasi::all();
        $detail_paket = DetailPaket::all();
        $transportasi = Transportasi::all();
        $booking = Booking::all();
        $hotel = Hotel::all();
        $pembayaran = Pembayaran::all();
        $ulasan = Ulasan::all();
        return view('landing.index', compact('paket', 'destinasi', 'detail_paket', 'transportasi', 'booking', 'hotel', 'pembayaran', 'ulasan'));
    }

    public function hasil(Request $request)
    {
        // dd($request->all());
        $data_tempat_wisata = Destinasi::all();
        // dd($data_tempat_wisata);
        $tempat_wisata = [];
        foreach ($data_tempat_wisata as $key => $value) {
            # code...
            $tempat_wisata[] = [
                "id" => $value->id,
                "nama" => $value->nama,
                "koordinat" => [$value->latitude, $value->longitude],
                "durasi" => $value->jumlah_jam * 60,
                "biaya" => $value->harga,
                "kepuasan" => 4.5
            ];
        }

        $data_hotel = Hotel::all();
        $hotel = [];
        foreach ($data_hotel as $key => $value) {
            # code...
            $hotel[] = [
                "id" => $value->id,
                "nama" => $value->nama_hotel,
                "koordinat" => [$value->latitude, $value->longitude],
                "biaya" => $value->harga,

            ];
        }
        // dd($hotel);

        $data_transportasi = Transportasi::all();
        $transportasi = [];
        foreach ($data_transportasi as $key => $value) {
            #code
            $transportasi[] = [
                "id" => $value->id,
                "jenis" => $value->nama,
                "biaya_per_km" => $value->biaya_per_km,
                "jumlah_penumpang" => $value->jumlah_penumpang,
                "menit_per_km_luar_kota" => $value->menit_per_km_luar_kota,
                "menit_per_km_dalam_kota" => $value->menit_per_km_luar_kota,
            ];
        }
        // dd($transportasi);

        // dd($tempat_wisata);
        // $tempat_wisata = [
        //     ["nama" => "Bukit Sakura", "koordinat" => [-5.396589, 105.264917], "durasi" => 120, "biaya" => 120000, "kepuasan" => 4.2],
        //     ["nama" => "Air Terjun Way Lalaan", "koordinat" => [-5.650335, 105.488405], "durasi" => 150, "biaya" => 55000, "kepuasan" => 4.4],
        //     ["nama" => "Pantai Gigi Hiu", "koordinat" => [-5.745315, 105.463307], "durasi" => 240, "biaya" => 80000, "kepuasan" => 4.8],
        //     ["nama" => "Pantai Marina", "koordinat" => [-5.692308, 105.479722], "durasi" => 240, "biaya" => 85000, "kepuasan" => 4.7],
        //     ["nama" => "Pantai Mutun", "koordinat" => [-5.526667, 105.317222], "durasi" => 240, "biaya" => 65000, "kepuasan" => 4.3],
        //     ["nama" => "Pulau Pahawang", "koordinat" => [-5.604184, 105.245537], "durasi" => 360, "biaya" => 300000, "kepuasan" => 4.9],
        //     ["nama" => "Pulau Tegal Mas", "koordinat" => [-5.641634, 105.258984], "durasi" => 360, "biaya" => 85000, "kepuasan" => 4.8],
        //     ["nama" => "Pulau Wayang", "koordinat" => [-5.884451, 105.351456], "durasi" => 390, "biaya" => 300000, "kepuasan" => 4.7],
        //     ["nama" => "Rio by The Beach", "koordinat" => [-5.68315, 105.460874], "durasi" => 240, "biaya" => 75000, "kepuasan" => 4.7],
        //     ["nama" => "Taman Krakatau", "koordinat" => [-5.448000,105.400000], "durasi" => 150, "biaya" => 35000, "kepuasan" => 4.2],
        //     ["nama" => "Teluk Hantu", "koordinat" => [-5.754001, 105.324411], "durasi" => 360, "biaya" => 270000, "kepuasan" => 4.7],
        //     ["nama" => "Teluk Kiluan", "koordinat" => [-5.830000, 105.100000], "durasi" => 360, "biaya" => 350000, "kepuasan" => 4.9],
        //     ["nama" => "Curug Gangsa", "koordinat" => [-4.680556, 104.412778], "durasi" => 210, "biaya" => 25000, "kepuasan" => 4.3],
        //     ["nama" => "Pantai Klara", "koordinat" => [-5.60625, 105.281111], "durasi" => 210, "biaya" => 40000, "kepuasan" => 4.2],
        //     ["nama" => "Lembah Hijau Lampung", "koordinat" => [-5.405556, 105.257222], "durasi" => 270, "biaya" => 85000, "kepuasan" => 4.5],
        //     ["nama" => "Air Terjun Ciupang", "koordinat" => [-5.047778, 104.000278], "durasi" => 210, "biaya" => 25000, "kepuasan" => 4.4],
        //     ["nama" => "Wira Garden", "koordinat" => [-5.401111, 105.245833], "durasi" => 270, "biaya" => 25000, "kepuasan" => 4.3],
        //     ["nama" => "Puncak Mas Lampung", "koordinat" => [-5.392222, 105.239444], "durasi" => 180, "biaya" => 30000, "kepuasan" => 4.3],
        //     ["nama" => "Air Terjun Way Tayas", "koordinat" => [-5.497222, 105.511111], "durasi" => 180, "biaya" => 30000, "kepuasan" => 4.8],
        //     ["nama" => "Lengkung Langit", "koordinat" => [-5.387590, 105.264320], "durasi" => 150, "biaya" => 30000, "kepuasan" => 4.5],
        // ];

        // $hotel = [
        //     ["nama" => "Griya Vina Pahawang", "koordinat" => [-5.608611, 105.246944], "biaya" => 400000],
        //     ["nama" => "Asyraf Homestay Pahawang", "koordinat" => [-5.606111, 105.250278], "biaya" => 300000],
        //     ["nama" => "Homestay Ibu Nur", "koordinat" => [-5.532500, 105.282222], "biaya" => 275000],
        //     ["nama" => "Kiluan Bay Lodge", "koordinat" => [-5.830278, 105.101667], "biaya" => 400000],
        //     ["nama" => "Penginapan Teluk Kiluan", "koordinat" => [-5.831200, 105.100800], "biaya" => 300000],
        //     ["nama" => "Wisma Kiluan Dolphin Inn", "koordinat" => [-5.830000, 105.099500], "biaya" => 300000],
        //     ["nama" => "Tegal Mas Resort & Villa", "koordinat" => [-5.641634, 105.258984], "biaya" => 900000],
        //     ["nama" => "RedDoorz near Pantai Mutun", "koordinat" => [-5.531600, 105.308800], "biaya" => 250000],
        //     ["nama" => "Homestay Ketapang", "koordinat" => [-5.564200, 105.286000], "biaya" => 200000],
        //     ["nama" => "RedDoorz Plus @ Pahoman", "koordinat" => [-5.425278, 105.265833], "biaya" => 300000],
        //     ["nama" => "Urbanview Hotel Raka", "koordinat" => [-5.393056, 105.238611], "biaya" => 300000],
        //     ["nama" => "Whiz Prime Hotel Ahmad Yani", "koordinat" => [-5.432003, 105.260445], "biaya" => 500000],
        //     ["nama" => "Emersia Hotel & Resort", "koordinat" => [-5.413889, 105.251667], "biaya" => 1000000],
        //     ["nama" => "Labuhan Jaya Resort", "koordinat" => [-5.719444, 105.591944], "biaya" => 450000],
        //     ["nama" => "Hotel Kalianda Inn", "koordinat" => [-5.713889, 105.607222], "biaya" => 350000],
        //     ["nama" => "Villa Bukit Indah Kalianda", "koordinat" => [-5.712800, 105.590500], "biaya" => 900000],
        //     ["nama" => "Wisma Way Belerang", "koordinat" => [-5.735500, 105.615500], "biaya" => 250000],
        // ];

        // $transportasi = [
        //     ["jenis" => "Hyundai H-1", "biaya_per_km" => 9800, "jumlah_penumpang" => 7, "menit_per_km_luar_kota" => 0.75, "menit_per_km_dalam_kota" => 1.1],
        //     ["jenis" => "Isuzu Elf Short", "biaya_per_km" => 9000, "jumlah_penumpang" => 12, "menit_per_km_luar_kota" => 0.86, "menit_per_km_dalam_kota" => 1.3],
        //     ["jenis" => "Isuzu Elf Long", "biaya_per_km" => 10000, "jumlah_penumpang" => 18, "menit_per_km_luar_kota" => 0.86, "menit_per_km_dalam_kota" => 1.3],
        //     ["jenis" => "Toyota HiAce Commuter", "biaya_per_km" => 10000, "jumlah_penumpang" => 11, "menit_per_km_luar_kota" => 1.0, "menit_per_km_dalam_kota" => 1.5],
        //     ["jenis" => "Ford Transit", "biaya_per_km" => 10500, "jumlah_penumpang" => 15, "menit_per_km_luar_kota" => 0.8, "menit_per_km_dalam_kota" => 1.2],
        //     ["jenis" => "Kia Grand Carnival", "biaya_per_km" => 9800, "jumlah_penumpang" => 11, "menit_per_km_luar_kota" => 0.9, "menit_per_km_dalam_kota" => 1.3],
        //     ["jenis" => "Toyota Coaster", "biaya_per_km" => 11000, "jumlah_penumpang" => 20, "menit_per_km_luar_kota" => 0.86, "menit_per_km_dalam_kota" => 1.3],
        //     ["jenis" => "Bus Medium 3/4", "biaya_per_km" => 12500, "jumlah_penumpang" => 28, "menit_per_km_luar_kota" => 1.0, "menit_per_km_dalam_kota" => 1.6],
        //     ["jenis" => "Bus Besar Pariwisata", "biaya_per_km" => 15000, "jumlah_penumpang" => 48, "menit_per_km_luar_kota" => 1.1, "menit_per_km_dalam_kota" => 1.8],
        //     ["jenis" => "Nissan Urvan", "biaya_per_km" => 9500, "jumlah_penumpang" => 10, "menit_per_km_luar_kota" => 0.85, "menit_per_km_dalam_kota" => 1.2]
        // ];


        $tanggal_mulai = new DateTime($request->input('tanggal_mulai'));
        $tanggal_selesai = new DateTime($request->input('tanggal_selesai'));
        $jumlah_orang = ($request->input('jumlah_orang'));
        $budget = ($request->input('budget'));
        $jumlah_hari = $tanggal_selesai->diff($tanggal_mulai)->days + 1;

        $pop_size = 150;
        $jumlah_hari = $tanggal_mulai->diff($tanggal_selesai)->days + 1;
        $jumlah_tempat = count($tempat_wisata);

        $biaya_per_km = 5000;

        // Fungsi generate_population_dinamis dan evolve perlu dikonversi dulu
        $pop = $this->generate_population_dinamis($pop_size, $tempat_wisata, $jumlah_hari, $hotel, $transportasi, $jumlah_orang);
        $best_chromosome = $this->evolve($pop, $tempat_wisata, $budget, $biaya_per_km);
        $itinerary_akhir = $this->tambahkan_hotel($best_chromosome, $tempat_wisata, $hotel);

        $counter = 0;
        $hotel_terpilih = $best_chromosome[1];
        $transportasi_terpilih = $best_chromosome[2];
        $koordinat_palembang = [-2.990934, 104.756554];
        $budget_total = 0;

        $paket = Paket::create(
            [
                "nama" => "Paket Hasil AI" . ($tanggal_mulai->format('Y-m-d')) . " s/d " . ($tanggal_selesai->format('Y-m-d')),
                "deskripsi" => "-",
                "jumlah_orang" => $jumlah_orang,
                "harga" => 0,
                "durasi" => $jumlah_hari,
                "gambar" => "",
                "id_hotel" => $hotel_terpilih['id'],
                "id_transportasi" => $transportasi_terpilih['id'],
                "is_ai" => true,
                'tanggal_mulai' => $tanggal_mulai->format('d-M-Y'),
                'tanggal_selesai' => $tanggal_selesai->format('d-M-Y'),
            ]
        );

        // dd($paket);

        foreach ($itinerary_akhir as $hari => $aktivitas) {
            // echo "<br>Hari ke : " . ($hari + 1) . "\n<br>";
            $jam_berangkat = 8;
            $counter2 = 0;
            $a_sebelum = null;

            foreach ($aktivitas as $a) {
                if ($counter == 0 && $counter2 == 0) {
                    $durasi_berangkat = round(durasi_transportasi($koordinat_palembang, $a['koordinat'], $transportasi_terpilih['menit_per_km_luar_kota']) / 60);
                    // echo "<br>$jam_berangkat s/d " . ($jam_berangkat + $durasi_berangkat) . " | Keberangkatan\n<br>";
                    $jam_berangkat += $durasi_berangkat;
                    $budget_total += biaya_transportasi($koordinat_palembang, $a['koordinat'], $transportasi_terpilih["biaya_per_km"]);
                } elseif ($counter2 == 0) {
                    $durasi_berangkat = round(durasi_transportasi($hotel_terpilih['koordinat'], $a['koordinat'], $transportasi_terpilih['menit_per_km_dalam_kota']) / 60);
                    // echo "<br>$jam_berangkat s/d " . ($jam_berangkat + $durasi_berangkat) . " | Keberangkatan dari Hotel\n<br>";
                    $jam_berangkat += $durasi_berangkat;
                    $budget_total += biaya_transportasi($hotel_terpilih['koordinat'], $a['koordinat'], $transportasi_terpilih["biaya_per_km"]);
                } else {
                    $durasi_berangkat = round(durasi_transportasi($a_sebelum['koordinat'], $a['koordinat'], $transportasi_terpilih['menit_per_km_dalam_kota']) / 60);
                    // echo "<br>$jam_berangkat s/d " . ($jam_berangkat + $durasi_berangkat) . " | Perjalanan\n<br>";

                    $jam_berangkat += $durasi_berangkat;
                    $budget_total += biaya_transportasi($a_sebelum['koordinat'], $a['koordinat'], $transportasi_terpilih["biaya_per_km"]);
                }

                if ($a === end($aktivitas)) {
                    $budget_total += $a['biaya'];
                    // echo "$jam_berangkat s/d selesai | {$a['nama']} ({$a['biaya']})\n<br>";
                } else {
                    $durasi_bermain = round($a['durasi'] / 60);
                    // echo "$jam_berangkat s/d " . ($jam_berangkat + $durasi_bermain) . " | {$a['nama']} ({$a['biaya']})\n";
                    DetailPaket::create(
                        [
                            "id_paket" => $paket->id,
                            "jam_mulai" => $jam_berangkat,
                            "jam_selesai" => $jam_berangkat + $durasi_bermain,
                            "id_destinasi" => $a['id'],
                            "hari_ke" => $hari + 1,
                        ]
                    );
                    $jam_berangkat += $durasi_bermain;
                    $budget_total += $a['biaya'];
                }

                $a_sebelum = $a;
                $counter2++;
            }
            // echo "\n";
            $counter++;
        }
        // dd($budget_total);

        $paket->update(
            [
                "harga" => $budget_total * $jumlah_orang
            ]
        );


        // dd($paket);
        // echo $jumlah_hari .'</br>';
        // echo "ini hasil";
        // dd($itinerary_akhir);
        return view('landing.ga', compact('itinerary_akhir', 'best_chromosome', 'paket'));
    }

    function generate_chromosome_dinamis($tempat_wisata, $jumlah_hari, $data_hotel, $data_transportasi, $jumlah_penumpang = 15, $waktu_maks_per_hari = 600)
    {
        $idxs = range(0, count($tempat_wisata) - 1);
        shuffle($idxs);

        $idxs_hotel = range(0, count($data_hotel) - 1);
        shuffle($idxs_hotel);
        $hotel_terpilih = $data_hotel[$idxs_hotel[0]];

        $transportasi_filtered = array_values(array_filter($data_transportasi, function ($t) use ($jumlah_penumpang) {
            return $t["jumlah_penumpang"] > $jumlah_penumpang;
        }));

        shuffle($transportasi_filtered);
        $transportasi_terpilih = $transportasi_filtered[0];
        $transportasi_terpilih['biaya_per_km'] = $transportasi_terpilih['biaya_per_km'] / $jumlah_penumpang;
        $itinerary = array_fill(0, $jumlah_hari, []);
        $waktu_harian = array_fill(0, $jumlah_hari, 0);

        $koordinat_palembang = [-2.9547941, 104.6805621];
        $koordinat_hotel = $hotel_terpilih["koordinat"];

        foreach ($idxs as $idx) {
            $durasi = $tempat_wisata[$idx]["durasi"];
            $dimasukkan = false;

            for ($i = 0; $i < $jumlah_hari; $i++) {
                if ($waktu_harian[$i] + $durasi <= $waktu_maks_per_hari) {
                    if ($i == 0 && count($itinerary[$i]) == 0) {
                        $dt = durasi_transportasi($koordinat_palembang, $tempat_wisata[$idx]["koordinat"], $transportasi_terpilih['menit_per_km_luar_kota']);
                        $durasi += $dt;
                    } elseif (count($itinerary[$i]) == 0) {
                        $dt = durasi_transportasi($koordinat_hotel, $tempat_wisata[$idx]["koordinat"], $transportasi_terpilih['menit_per_km_dalam_kota']);
                        $durasi += $dt;
                    } elseif (count($itinerary[$i]) > 0) {
                        $last_idx = end($itinerary[$i]);
                        $dt = durasi_transportasi($tempat_wisata[$last_idx]["koordinat"], $tempat_wisata[$idx]["koordinat"], $transportasi_terpilih['menit_per_km_dalam_kota']);
                        $durasi += $dt;
                    }

                    $itinerary[$i][] = $idx;
                    $waktu_harian[$i] += $durasi;
                    $dimasukkan = true;
                    break;
                }
            }

            if (!$dimasukkan) {
                continue;
            }
        }

        return [$itinerary, $hotel_terpilih, $transportasi_terpilih];
    }

    function generate_population_dinamis($pop_size, $tempat_wisata, $jumlah_hari, $data_hotel, $data_transportasi, $jumlah_orang)
    {
        $population = [];
        for ($i = 0; $i < $pop_size; $i++) {
            $chromosome = $this->generate_chromosome_dinamis($tempat_wisata, $jumlah_hari, $data_hotel, $data_transportasi, $jumlah_orang);
            $population[] = $chromosome;
        }
        return $population;
    }


    function fitness($individu, $tempat_wisata, $max_total_biaya, $max_durasi_per_hari = 600)
    {
        list($data_lokasi, $hotel_terpilih, $transportasi_terpilih) = $individu;
        $koordinat_start = [-2.990934, 104.756554]; // Palembang

        $skor_per_hari = [];
        $biaya_total = 0;
        $biaya_hari = 0;

        foreach ($data_lokasi as $i => $hari) {
            $durasi_hari = 0;

            if (empty($hari)) {
                $skor_per_hari[] = 0;
                continue;
            }

            $awal = $i === 0 ? $koordinat_start : $hotel_terpilih["koordinat"];

            // Awal ke tempat pertama
            $pertama = $tempat_wisata[$hari[0]];
            $durasi_awal = durasi_transportasi($awal, $pertama["koordinat"], $transportasi_terpilih["menit_per_km_luar_kota"]);
            $biaya_awal = biaya_transportasi($awal, $pertama["koordinat"], $transportasi_terpilih["biaya_per_km"]);
            $durasi_hari += $durasi_awal + $pertama["durasi"];
            $biaya_hari += $pertama["biaya"] + $biaya_awal;

            for ($j = 1; $j < count($hari); $j++) {
                $prev = $tempat_wisata[$hari[$j - 1]];
                $curr = $tempat_wisata[$hari[$j]];

                $durasi_jalan = durasi_transportasi($prev["koordinat"], $curr["koordinat"], $transportasi_terpilih["menit_per_km_dalam_kota"]);
                $biaya_jalan = biaya_transportasi($prev["koordinat"], $curr["koordinat"], $transportasi_terpilih["biaya_per_km"]);

                $durasi_hari += $durasi_jalan + $curr["durasi"];
                $biaya_hari += $curr["biaya"] + $biaya_jalan;
            }

            // Pulang ke hotel
            $terakhir = $tempat_wisata[end($hari)];
            $durasi_pulang = durasi_transportasi($terakhir["koordinat"], $hotel_terpilih["koordinat"], $transportasi_terpilih["menit_per_km_dalam_kota"]);
            $biaya_pulang = biaya_transportasi($terakhir["koordinat"], $hotel_terpilih["koordinat"], $transportasi_terpilih["biaya_per_km"]);

            $durasi_hari += $durasi_pulang;
            $biaya_hari += $hotel_terpilih["biaya"];
            $biaya_total += $biaya_hari + $biaya_pulang;
            if ($durasi_hari > $max_durasi_per_hari) {
                // print($durasi_hari);
                $skor_durasi = -100;
            } else {
                $skor_durasi = 1 / (abs($durasi_hari - $max_durasi_per_hari) / $max_durasi_per_hari);
            }

            $skor_hari = $skor_durasi;
            $skor_per_hari[] = $skor_hari;
        }


        // if ($biaya_total)

        $skor_biaya = $biaya_total / $max_total_biaya;
        if ($skor_biaya > 1) {
            $skor_biaya = 100;
        } else {
        }


        $skor_total = (array_sum($skor_per_hari) / count($skor_per_hari)) - $skor_biaya;
        return $skor_total;
    }

    function crossover_per_hari($parent1, $parent2)
    {
        list($data1, $hotel1, $transportasi1) = $parent1;
        list($data2, $hotel2, $transportasi2) = $parent2;

        $child1_data = [];
        $child2_data = [];

        for ($i = 0; $i < count($data1); $i++) {
            if (mt_rand() / mt_getrandmax() < 0.5) {
                $child1_data[] = $data1[$i];
                $child2_data[] = $data2[$i];
            } else {
                $child1_data[] = $data2[$i];
                $child2_data[] = $data1[$i];
            }
        }

        $child1_hotel = (mt_rand() / mt_getrandmax() < 0.5) ? $hotel1 : $hotel2;
        $child2_hotel = (mt_rand() / mt_getrandmax() < 0.5) ? $hotel1 : $hotel2;

        $child1_transportasi = (mt_rand() / mt_getrandmax() < 0.5) ? $transportasi1 : $transportasi2;
        $child2_transportasi = (mt_rand() / mt_getrandmax() < 0.5) ? $transportasi1 : $transportasi2;

        return [[$child1_data, $child1_hotel, $child1_transportasi], [$child2_data, $child2_hotel, $child2_transportasi]];
    }

    function evolve($population, $tempat_wisata, $budget, $hotel, $generasi = 100, $elitisme = 0.2, $mutation_rate = 0.1)
    {
        $pop_size = count($population);
        $elit_size = intval($elitisme * $pop_size);

        for ($g = 0; $g < $generasi; $g++) {
            $scored = [];

            foreach ($population as $chrom) {
                $score = $this->fitness($chrom, $tempat_wisata, $budget);
                $scored[] = [$chrom, $score];
            }

            usort($scored, function ($a, $b) {
                return $b[1] <=> $a[1];
            });

            $population = array_map(function ($x) {
                return $x[0];
            }, $scored);

            $next_gen = array_slice($population, 0, $elit_size);

            while (count($next_gen) < $pop_size) {
                $p1 = $population[rand(0, min(19, $pop_size - 1))];
                $p2 = $population[rand(0, min(19, $pop_size - 1))];

                list($child1, $child2) = $this->crossover_per_hari($p1, $p2);

                $child3 = $this->mutasi_per_hari($p1, $tempat_wisata, $mutation_rate);
                $child4 = $this->mutasi_per_hari($p2, $tempat_wisata, $mutation_rate);

                $next_gen[] = $child1;
                if (count($next_gen) < $pop_size) $next_gen[] = $child2;
                if (count($next_gen) < $pop_size) $next_gen[] = $child3;
                if (count($next_gen) < $pop_size) $next_gen[] = $child4;
            }

            $population = array_slice($next_gen, 0, $pop_size);
        }

        return $population[0];
    }

    function mutasi_per_hari($individu, $tempat_wisata, $prob_mutasi = 0.2)
    {
        list($data_lokasi, $hotel_terpilih, $transportasi_terpilih) = $individu;
        $data_lokasi = unserialize(serialize($data_lokasi)); // Deep copy

        $semua_idx_tw = range(0, count($tempat_wisata) - 1);

        // Ambil semua tempat wisata yang sudah digunakan
        $digunakan = [];
        foreach ($data_lokasi as $hari) {
            foreach ($hari as $idx) {
                $digunakan[$idx] = true;
            }
        }

        foreach ($data_lokasi as &$hari) {
            if (mt_rand() / mt_getrandmax() < $prob_mutasi) {
                if (count($hari) >= 2 && mt_rand() / mt_getrandmax() < 0.5) {
                    // Swap dua indeks dalam satu hari
                    $i = array_rand($hari);
                    do {
                        $j = array_rand($hari);
                    } while ($j == $i);
                    $tmp = $hari[$i];
                    $hari[$i] = $hari[$j];
                    $hari[$j] = $tmp;
                } else {
                    // Ganti salah satu tempat dengan yang belum digunakan
                    $i = rand(0, count($hari) - 1);
                    $tersedia = array_diff($semua_idx_tw, array_keys($digunakan));
                    if (!empty($tersedia)) {
                        $new_tw = $tersedia[array_rand($tersedia)];
                        unset($digunakan[$hari[$i]]);
                        $hari[$i] = $new_tw;
                        $digunakan[$new_tw] = true;
                    }
                }
            }
        }

        return [$data_lokasi, $hotel_terpilih, $transportasi_terpilih];
    }

    function tambahkan_hotel($itinerary, $tempat_wisata)
    {
        $hasil = [];
        $schedule = $itinerary[0];
        $hotel_terpilih = $itinerary[1];

        foreach ($schedule as $i => $hari) {
            $aktivitas = [];

            foreach ($hari as $idx) {
                $aktivitas[] = $tempat_wisata[$idx];
            }

            // Tambahkan hotel di akhir hari jika bukan hari terakhir
            if ($i < count($schedule) - 1) {
                $aktivitas[] = $hotel_terpilih;
            }

            $hasil[$i] = $aktivitas;
        }

        return $hasil;
    }






    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $role = Role::findByName('client');
        $user->assignRole($role);

        return $user;
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
