<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeningQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'audio_file',  // 存儲音頻檔案的字段
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
