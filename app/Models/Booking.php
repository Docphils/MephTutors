<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'startDate',
        'location',
        'sessions',
        'duration',
        'learners',
        'days_times',
        'tutorGender',
        'classes',
        'curriculum',
        'subjects',
        'remarks',
        'status',
    ];

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
