<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'tutorRequest_id',
        'user_id',
        'client_id',
        'tutor_id',
        'payment_id',
        'start_date',
        'end_date',
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
        'completed_at',
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

    public function payments()
    {
        return $this->hasOne(Payment::class);
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
