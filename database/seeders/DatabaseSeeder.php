<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Pierre',
            'email' => 'p.brickley@hotmail.fr',
            'password' => Hash::make('Vetpreislen'),
            ]);
        DB::table('types')->insert([
            'nom' => 'Books',
            'description' => 'du papier',
            ]);
        DB::table('types')->insert([
            'nom' => 'Works',
            'description' => 'des photos',
            ]);        
    }
}
