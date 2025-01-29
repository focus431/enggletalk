<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // 指定可以批量賦值的欄位
    protected $fillable = [
        'classschedule_id',  // 修改后的字段名
        'mentor_id', 
        'mentee_id',         // 新增的字段
        'rating',
        'comment'
    ];

    // 每個評論屬於一個特定的課程安排
    public function classSchedule()
    {
        return $this->belongsTo(ClassSchedule::class, 'classschedule_id');
    }

    // 每個評論屬於一個特定的學員
    public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_id');
    }
}

