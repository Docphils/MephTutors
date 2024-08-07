<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutor_id',
        'booking_id',
        'amount',
        'evidence',
        'status',
    ];



    public function user(){
        return $this->belongsTo(User::class);
    }
}
