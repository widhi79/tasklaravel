<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Contoh data untuk diisi ke tabel users
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'password' => Hash::make('password456'),
            ],
            [
                'name' => 'Dika',
                'email' => 'andika@gmail.com',
                'password' => Hash::make('tes1234'),
            ],
            // Tambahkan data pengguna lain sesuai kebutuhan
        ];

        // Masukkan data ke dalam tabel users
        DB::table('users')->insert($users);
    }
}
