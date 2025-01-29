<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassBooking extends Model
{
    use HasFactory;
    // 填入字段白名单
    protected $fillable = [
        'order_id', 
        'user_id', 
        'class_schedule_id', 
        'status'
    ];

    // 定义与 Order 的关系
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // 定义与 User 的关系
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 定义与 ClassSchedule 的关系
    public function classSchedule()
    {
        return $this->belongsTo(ClassSchedule::class);
    }
}
