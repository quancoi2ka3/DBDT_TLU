<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Department;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Employee::class;
    public function definition(): array
    {
        $faker = faker::create();
        $department = Department::all();
        return [
            'full_name'=>$faker->name(),
            'address'=>$faker->streetAddress(),
            'email'=>$faker->unique()->safeEmail(),
            'mobile_phone'=>$faker->phoneNumber(),
            'position'=>$faker->jobTitle(),
            'avatar'=>$faker->url(),
            'department_id'=>$department->random()->id
        ];
    }
}
