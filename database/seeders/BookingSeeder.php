<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Booking;
use App\Models\TutorRequest;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $recordCount = 50; // Adjust the number of records here

        $tutorRequests = TutorRequest::all();
        // Get all users with the 'client' role
        $tutor = User::where('role', 'tutor')->get();

        for ($i = 0; $i < $recordCount; $i++) {
            $randomTutor = $tutor->random();
        }
        foreach ($tutorRequests as $tutorRequest) {
            Booking::create([
                'user_id' => $tutorRequest->user_id, // Assuming user is the client
                'client_id' => $tutorRequest->user_id,
                'tutor_id' => $randomTutor->id,// Assign tutor based on some logic
                'tutorRequest_id' => $tutorRequest->id,
                'start_date' => $tutorRequest->start_date,
                'end_date' => $tutorRequest->end_date,
                'location' => $tutorRequest->location,
                'days_times' => $tutorRequest->days_times,
                'subjects' => $tutorRequest->subjects,
                'learners' => $tutorRequest->learners,
                'sessions' => $tutorRequest->sessions,
                'duration' => $tutorRequest->duration,
                'tutorGender' => 'Male',
                'curriculum' => $tutorRequest->curriculum,
                'status' => 'Pending',
                'classes' => 'Adult',
                'amount' => $tutorRequest->amount,
                'paymentStatus' => 'Pending',
                'tutorRemarks' => null,
                'clientAcceptanceRemarks' => null,
                'clientApprovalRemarks' => null,
            ]);
        }
    }
}