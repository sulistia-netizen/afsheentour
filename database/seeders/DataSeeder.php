<?php

namespace Database\Seeders;

use App\Models\Destinasi;
use App\Models\DetailPaket;
use App\Models\Hotel;
use App\Models\Paket;
use App\Models\Transportasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Destinasi::create([
            'nama' => 'Bukit Sakura',
            'deskripsi' => 'abc',
            'gambar' => 'abc.png',
            'harga' => 15000,
            'jumlah_jam' => 300,
            'longitude' => 'abc',
            'latitude' => 'abc',
            'is_hotel' => 0
        ]);

        Hotel::create([
            'nama_hotel' => 'Puspa Hotel',
            'longitude' => 'abc',
            'latitude' => 'abc',
            'harga' => 200000,
            'keterangan' => 'aabbcc'
        ]);

        Transportasi::create([
            'jenis' => 'mobil',
            'biaya_per_km' => 9500,
            'jumlah_penumpang' => 20,
            'menit_per_km_luar_kota' => 0.7,
            'menit_per_km_dalam_kota' => 1

        ]);

        Paket::create([
            'nama' => 'paketA',
            'deskripsi' => 'aaabbbccc',
            'jumlah_orang' => 20,
            'harga' => 25000000,
            'durasi' => '3hari',
            'gambar' => 'abc.png',
            'is_ai' => 0,
            'id_hotel' => 1,
            'id_transportasi' => 1,
            'tanggal_mulai' => '25 mei 2025',
            'tanggal_selesai' => '27 mei 2025'

        ]);

        DetailPaket::create([
            'id_paket' => 1,
            'jam_mulai' => '08.00',
            'jam_selesai' => '20.00',
            'id_destinasi' => 1,
            'hari_ke' => 3,
            
        ]);


    }
}
