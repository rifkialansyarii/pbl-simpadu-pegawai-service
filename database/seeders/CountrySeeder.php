<?php

namespace Database\Seeders;

use App\Models\Country;
use File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('data/countries.json'));

        $data = json_decode($json, true);


        foreach ($data as $country) {
            $attributes = [
                'name' => $country['name']['common'],
                'code' => $country['cca2'],
            ];
            Country::create($attributes);
        }
    }
}
