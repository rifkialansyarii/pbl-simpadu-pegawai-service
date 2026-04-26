<?php

namespace Database\Seeders;

use App\Models\ChangeRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChangeRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChangeRequest::factory()
            ->count(30)
            ->create();
    }
}
