<?php
  
namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengguna = Pengguna::create([
            'nama' => 'Admin',
            'jenis_kelamin' => 'perempuan',
            'nomor_hp' => '083836031968',
            'alamat_email' => 'admin@gmail.com'
        ]);

        $user = User::create([
            'pengguna_id' => $pengguna->id,
            'name' => 'Admin', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        
        $role = Role::create(['name' => 'Admin']);
         
        $permissions = Permission::pluck('id','id')->all();
       
        $role->syncPermissions($permissions);
         
        $user->assignRole([$role->id]);

    }
}
