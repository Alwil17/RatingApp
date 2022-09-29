<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'Grey',
            'lastname' => 'Attackeur',
            'pseudo' => 'grey',
            'email' => 'grey@ratethem.com',
            'type' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('P@ssw0rd'),
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::factory(99)->create();
        \App\Models\Structure::factory(25)->create();
        \App\Models\Product::factory(150)->create();
        \App\Models\Rating::factory(250)->create();

        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche', 'Jours féries'];

        foreach ($days as $day){
            Day::create([
               "nom" => $day,
               "slug" => Str::slug($day)
            ]);
        }
    }
}
