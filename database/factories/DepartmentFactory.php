<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Department::class;
    public function definition(): array
    {
        return[];
    }
}
// //$faker = Faker\Factory::create();

// // Tạo tên người ngẫu nhiên
// $name = $faker->name;

// // Tạo email ngẫu nhiên
// $email = $faker->email;

// // Tạo địa chỉ ngẫu nhiên
// $address = $faker->address;

// // Tạo số điện thoại ngẫu nhiên
// $phoneNumber = $faker->phoneNumber;

// // Tạo ngày sinh ngẫu nhiên
// $birthdate = $faker->birthdate;

// // Tạo giới tính ngẫu nhiên
// $gender = $faker->gender;

// // Tạo đoạn văn bản ngẫu nhiên
// $text = $faker->text;

// // Tạo câu ngẫu nhiên
// $sentence = $faker->sentence;

// // Tạo đoạn văn ngẫu nhiên
// $paragraph = $faker->paragraph;

// // Tạo từ ngẫu nhiên
// $word = $faker->word;

// // Tạo số ngẫu nhiên
// $randomNumber = $faker->randomNumber;

// // Tạo số ngẫu nhiên trong một khoảng
// $numberBetween = $faker->numberBetween(1, 100);

// // Tạo số thập phân ngẫu nhiên
// $decimal = $faker->decimal;

// // Tạo màu sắc ngẫu nhiên
// $color = $faker->color;

// // Tạo ảnh ngẫu nhiên
// $image = $faker->image;

// // Tạo tên công ty ngẫu nhiên
// $company = $faker->company;

// // Tạo chức danh công việc ngẫu nhiên
// $jobTitle = $faker->jobTitle;

// // Tạo URL ngẫu nhiên
// $url = $faker->url;
