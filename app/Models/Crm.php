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
        'days',
        'daysPerWeek',
        'learnersNumber',
        'duration',
        'learnersGrade',
        'class_type',
        'status',
        'remarks',
        'request_type',
        'school_name',
        'school_address',
        'languages',

    ];



    public function user(){
        return $this->belongsTo(User::class);
    }
}
