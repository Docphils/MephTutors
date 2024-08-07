<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'lesson_id',
        'user_id',
        'client_id',
        'tutor_id',
        'start_date',
        'location',
        'sessions',
        'duration',
        'learners',
        'days_times',
        'tutorGender',
        'classes',
        'amount',
        'curriculum',
        'subjects',
        'remarks',
        'status',
        'paymentStatus',
        'paymentEvidence',
    ];

    public function user(){
        return $this->belongsToMany(User::class);
    }
    
    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($booking) {
            $lesson = $booking->lesson;
            if ($lesson && $lesson->status == 'Pending') {
                $lesson->status = 'Assigned';
                $lesson->save();
            }
        });
    }

}
