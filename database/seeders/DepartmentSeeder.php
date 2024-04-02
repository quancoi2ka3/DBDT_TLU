<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = faker::create();

        for ($i = 0; $i < 50; $i++) {
            $departmentCount = Department::count();
            if ($departmentCount > 0) {
                $parentId = rand(1, $departmentCount );
              } else {
                $parentId = null; // Or set a default value (e.g., 1 for the root department)
              }
            Department::create([
                'name' => $faker->company(),
                'address' => $faker->streetAddress(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->phoneNumber(),
                'logo' => $faker->url(),
                'website' => $faker->url(),
                'parent_id' => $parentId // Gán parent_id ngẫu nhiên trong phạm vi
            ]);
        }
    }
}
