<?php

namespace Database\Factories;

use App\Models\Model;
use File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $data = json_decode(File::get(__DIR__ . '/../data/countries.json'));

        return [
            "country_name" => $data["name"]["common"]
        ];
    }
}
