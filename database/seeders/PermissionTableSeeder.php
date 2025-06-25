<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'destinasi-list',
           'destinasi-create',
           'destinasi-edit',
           'destinasi-delete',
           'paket-list',
           'paket-create',
           'paket-edit',
           'paket-delete',
           'detail_paket-list',
           'detail_paket-create',
           'detail_paket-edit',
           'detail_paket-delete',
           'transportasi-list',
           'transportasi-create',
           'transportasi-edit',
           'transportasi-delete',
           'booking-list',
           'booking-create',
           'booking-edit',
           'booking-delete',
           'pembayaran-list',
           'pembayaran-create',
           'pembayaran-edit',
           'pembayaran-delete',
           'ulasan-list',
           'ulasan-create',
           'ulasan-edit',
           'ulasan-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'hotel-list',
           'hotel-create',
           'hotel-edit',
           'hotel-delete',
           'pengguna-list',
           'pengguna-create',
           'pengguna-edit',
           'pengguna-delete',
           'kunjungan-list',
           'kunjungan-create',
           'kunjungan-edit',
           'kunjungan-delete',
           'landing-page-list',
           'landing-page-create',
           'landing-page-edit',
           'landing-page-delete',
           'testimonial-list',
           'testimonial-create',
           'testimonial-edit',
           'testimonial-delete',
           'rating-tempat-wisata-list',
           'rating-tempat-wisata-create',
           'rating-tempat-wisata-edit',
           'rating-tempat-wisata-delete',

        ];
        
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
