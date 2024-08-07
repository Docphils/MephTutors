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
        'tutorRemarks',
        'clientAcceptanceRemarks',
        'clientApprovalRemarks',
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

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }


    public function tutorRequest()
    {
        return $this->belongsTo(TutorRequest::class, 'tutorRequest_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($booking) {
            $tutorRequest = $booking->tutorRequest;
            if ($tutorRequest && $tutorRequest->status == 'Pending') {
                $tutorRequest->status = 'Assigned';
                $tutorRequest->save();
            }
        });
    }

}
