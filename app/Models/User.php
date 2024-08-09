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
use App\Models\TutorRequest;
use App\Models\Crm;
use App\Models\Payment;



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

    public function tutorRequests(){
        return $this->hasMany(TutorRequest::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function crms(){
        return $this->hasMany(Crm::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
