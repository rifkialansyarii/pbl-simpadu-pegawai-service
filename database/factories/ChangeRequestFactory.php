<?php

namespace Database\Factories;

use App\Enums\ChangeRequestStatus;
use Illuminate\Support\Facades\Schema;
use App\Models\ChangeRequest;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ChangeRequest>
 */
class ChangeRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employee = Employee::inRandomOrder()->first();
        $fieldList = array_diff(Schema::getColumnListing('employees'), [
            'id', 
            'address',
            'birth_place',
            'birth_date',
            'gender',
            'phone_number',
            'avatar',
            'village_code',
            'district_code',
            'city_code',
            'province_code',
            'created_at',
            'updated_at'
        ]);

        $field = fake()->randomElement($fieldList);

        $oldData = $employee->{$field};

        $newData = match ($field) {
            'nip' => fake()->numerify('##################'),
            'nik' => fake()->numerify('################'),
            'employee_name' => fake()->name(),
            default => null,
        };

        $changeRequestStatusInstance = fake()->randomElement(ChangeRequestStatus::cases());

        return [
            'employee_id' => $employee->id,
            'field_name' => $field,
            'old_value' => $oldData,
            'new_value' => $newData,
            'status' => $changeRequestStatusInstance->value,
        ];
    }
}
