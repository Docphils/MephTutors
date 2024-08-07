<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TutorRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'subjects',
        'end_date',
        'location',
        'sessions',
        'duration',
        'learners',
        'amount',
        'days_times',
        'tutor_gender',
        'classes',
        'curriculum',
        'remarks',
        'status',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'tutorRequest_id');
    }
}
