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
        $recordCount = 10; 

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
                'days_times' => $faker->dayOfWeek, 
                'subjects' => $faker->randomElement(['Maths, Science', 'Math, English', 'Science, ICT']), 
                'learners' => $faker->name,
                'sessions' => $faker->numberBetween(10, 20),
                'duration' => $faker->randomElement(['1 hr 30 minutes', '2 hours', '1 hour']), 
                'tutor_gender' => $faker->randomElement(['Male', 'Female', 'Any']),
                'curriculum' => $faker->randomElement(['British', 'French', 'Nigerian', 'Blended']),
                'amount' => $faker->numberBetween(10000, 200000),
                'remarks' => $faker->sentence(),
            ]);
        }
    }
    }
