<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'phone',
        'address',
        'DOB',
        'image',
        'gender',
        'qualification',
        'experience',
        'CV',
        'discipline',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
