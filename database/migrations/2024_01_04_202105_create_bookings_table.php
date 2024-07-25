<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('tutor_id');
            $table->string('lesson_id');
            $table->date('start_date');
            $table->string('location');
            $table->string('days_times');
            $table->string('subjects');
            $table->string('learners');
            $table->integer('sessions');
            $table->string('duration');
            $table->enum('tutorGender', ['Male', 'Female', 'Any']);
            $table->enum('curriculum', ['British', 'French', 'Nigerian', 'Blended']);
            $table->enum('status', ['Assigned', 'Cancelled', 'Pending', 'Completed']);
            $table->string('classes');
            $table->string('tutorRemarks')->nullable(); 
            $table->string('clientRemarks')->nullable();
            $table->timestamps();
        
            // Foreign key constraints linking to the users table
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('tutor_id')->references('id')->on('users');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
