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
        Schema::create('crm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('start_date');
            $table->enum('state', [
                'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross River', 'Delta', 
                'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 
                'Kwara', 'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 
                'Taraba', 'Yobe', 'Zamfara', 'FCT']);
            $table->string('full_address');
            $table->string('languages')->nullable();
            $table->enum('learnersGrade', ['under_12', 'teen', 'adult']);
            $table->enum('class_type', ['home_tutoring', 'online'])->nullable();
            $table->enum('status', ['Pending','Ongoing', 'Closed'])->default('Pending');
            $table->string('remarks')->nullable();
            $table->enum('request_type', ['coding_tutor', 'club']);
            $table->string('school_name')->nullable();
            $table->string('school_address')->nullable();
            $table->integer('learnersNumber');
            $table->integer('daysPerWeek');
            $table->string('days');
            $table->string('duration');
            $table->timestamps();



            // Foreign key constraints linking to the users table
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm');
    }
};
