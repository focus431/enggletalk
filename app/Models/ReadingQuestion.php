<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingQuestion extends Model
{
    use HasFactory;

    // 设置可批量赋值的字段
    protected $fillable = [
        'question', 
        'option_a', 
        'option_b', 
        'option_c', 
        'option_d', 
        'correct_answer', 
        'difficulty_level', 
        'category'
    ];
}
