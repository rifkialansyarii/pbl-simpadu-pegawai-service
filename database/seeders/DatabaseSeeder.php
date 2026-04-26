<?php

namespace Database\Seeders;

use App\Models\User;
use Artisan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('laravolt:indonesia:seed');

        $this->call([
            EmployeeSeeder::class,
            ChangeRequestSeeder::class,
        ]);   
    }
}
