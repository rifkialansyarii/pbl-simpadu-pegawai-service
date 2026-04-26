<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravolt\Indonesia\Models\Village;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $village = Village::with('district.city.province')->inRandomOrder()->first();
        $genderInstance = fake()->randomElement(Gender::cases());

        return [
            'nip' => fake()->numerify('##################'),
            'nik' => fake()->nik(),
            'employee_name' => fake()->name(),
            'address' => fake()->address(),
            'birth_place' => fake()->city(),
            'birth_date' => fake()->dateTimeBetween(startDate: '-30 years', endDate: '-20 years'),
            'gender' => $genderInstance->value,
            'phone_number' => fake()->numerify('08##########'),
            'avatar' => null,
            'village_id' => $village->id,
            'district_id' => $village->district->id,
            'city_id' => $village->district->city->id,
            'province_id' => $village->district->city->province->id,
        ];
    }
}
