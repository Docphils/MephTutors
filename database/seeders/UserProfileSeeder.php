<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all();

        foreach ($users as $user) {
            UserProfile::create([
                'user_id' => $user->id,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'fullname' => $faker->name,
                'DOB' => $faker->date('Y-m-d', '-25 years'),
                'gender' => $faker->randomElement(['Male', 'Female']),
            ]);
        }
    }
}