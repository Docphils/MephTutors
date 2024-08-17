<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TutorProfile;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TutorProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $tutors = User::where('role', 'tutor')->get(); // Assuming 'tutor' is the role for tutors

        foreach ($tutors as $tutor) {
            TutorProfile::create([
                'user_id' => $tutor->id,
                'fullName' => $faker->name,
                'phone' => $faker->randomNumber(5),
                'address' => $faker->address,
                'DOB' => $faker->date('Y-m-d', '-30 years'),
                'image' => 'default_tutor_image.jpg', // Replace with actual image handling
                'gender' => $faker->randomElement(['Male', 'Female']),
                'qualification' => $faker->randomElement(['SSCE', 'Diploma', 'NCE', 'HND/BSc/BEd/BA/BEng', 'MSc/MA', 'PhD']),
                'discipline' => $faker->randomElement(['Mathematics', 'English', 'Physics', 'Chemistry', 'Biology']), // Replace with relevant disciplines
                'experience' => $faker->randomElement(['0-1 year', '2-5 years', '6-10 years', 'Above 10 years']),
                'CV' => 'tutor_cv.pdf', // Replace with actual CV handling
                'careerProfile' => $faker->text,
                'bankName' => $faker->text,
                'accountName' => $faker->name,
                'accountNumber' => $faker->randomNumber(5),
            ]);
        }
    }
}