<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remittance extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'total_lessons',
        'total_amount',
        'status',
        'paid_on',
    ];

    protected $dates = ['paid_on'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
