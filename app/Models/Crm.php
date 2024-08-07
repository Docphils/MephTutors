<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'state',
        'full_address',
        'languages',
        'learnersGrade',
        'class_type',
        'status',
        'remarks',
        'request_type',
        'school_name',
        'school_address',
        'learnersNumber',
        'daysPerWeek',
        'days',
        'duration',
    ];



    public function user(){
        return $this->belongsTo(User::class);
    }
}
