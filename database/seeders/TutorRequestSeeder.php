<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TutorRequest;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TutorRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $recordCount = 10; // Adjust the number of records here

        // Get all users with the 'client' role
        $clients = User::where('role', 'client')->get();

        for ($i = 0; $i < $recordCount; $i++) {
            $randomClient = $clients->random();

        }
        foreach ($clients as $client) {
            TutorRequest::create([
                'user_id' => $randomClient->id,
                'start_date' => $faker->date('Y-m-d', '+1 week'),
                'end_date' => $faker->date('Y-m-d', '+2 months'),
                'location' => $faker->city,
                'days_times' => 'Monday, Wednesday, Friday: 3:00 PM - 4:00 PM', // Replace with desired format
                'subjects' => 'Math, Science', // Replace with desired subjects
                'learners' => $faker->name,
                'sessions' => $faker->numberBetween(10, 20),
                'duration' => '60', // Minutes
                'tutor_gender' => $faker->randomElement(['Male', 'Female', 'Any']),
                'curriculum' => $faker->randomElement(['British', 'French', 'Nigerian', 'Blended']),
                'amount' => $faker->numberBetween(10000, 50000),
                'remarks' => $faker->sentence(),
            ]);
        }
    }
    }
