<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // how to create user to admin_users
        // Contoh: menambahkan 1 user admin ke tabel admin_users
        DB::table('admin_users')->insert([
            'username' => 'admin',
            'password' => Hash::make('password'), // enkripsi password
            'name' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
