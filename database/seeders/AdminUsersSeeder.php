<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Alexandre Barroso Costa',
            'email' => 'alexandre.barroso@rodobank.com.br',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'Thiago Barros',
            'email' => 'thiagobarros95@gmail.com',
            'password' => Hash::make('password'),
        ]);
        User::factory()
            ->count(5)
            ->create();
    }
}
