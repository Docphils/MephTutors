<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'startDate',
        'subjects',
        'endDate',
        'location',
        'sessions',
        'duration',
        'learners',
        'amount',
        'days_times',
        'tutor',
        'classes',
        'curriculum',
        'remarks',
        'status',
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
