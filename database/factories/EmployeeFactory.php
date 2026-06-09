<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Models\Country;
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
        $country = Country::inRandomOrder()->first();
        $genderInstance = fake()->randomElement(Gender::cases());
        $studyProgram = [
            "teknik-listrik",
            "teknik-elektronika",
            "teknologi-rekayasa-pembangkit-energi",
            "teknik-otomotif",
            "teknologi-rekayasa-konstruksi-pesawat-udara",
            "teknik-sipil",
            "teknologi-rekayasa-konstruksi-jalan-dan-jembatan",
            "administrasi-bisnis",
            "manajemen-pemasaran",
            "akuntansi",
            "bisnis-digital",
        ];

        $studyProgramKey = fake()->randomKey($studyProgram);

        return [
            'nip' => fake()->numerify('##################'),
            'nik' => fake()->nik(),
            'employee_name' => fake()->name(),
            'study_program_id' => $studyProgramKey,
            'study_program_name' => $studyProgram[$studyProgramKey],
            'address' => fake()->address(),
            'birth_place' => fake()->city(),
            'birth_date' => fake()->dateTimeBetween(startDate: '-30 years', endDate: '-20 years'),
            'gender' => $genderInstance->value,
            'phone_number' => fake()->numerify('08##########'),
            'village_code' => $village->code,
            'district_code' => $village->district->code,
            'city_code' => $village->district->city->code,
            'province_code' => $village->district->city->province->code,
            'citizen_code' => $country->code,
        ];
    }
}
