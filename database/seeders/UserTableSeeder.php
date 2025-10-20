<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // pastikan role admin sudah ada
        // firstOrCreate, kalo data tidak ada create
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // create user
        $user = User::create([
            'name'  => 'Wahyu',
            'email' => 'wahyu@bee.com',
            'password' => bcrypt('wahyu12345'),
        ]);

        // tambahkan role admin
        $user->assignRole($adminRole);
    }
}
