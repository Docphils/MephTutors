<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserProfile;
use App\Models\TutorProfile;
use App\Models\Booking;
use App\Models\Lesson;
use App\Models\LessonUser;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function userProfile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function tutorProfile(){
        return $this->hasOne(tutorProfile::class);
    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
