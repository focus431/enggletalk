<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    

    protected $fillable = [
        'user_id', 
        'order_plan_id',  // 添加對應到 OrderPlan 的外鍵
        'total_lessons', 
        'remaining_lessons', 
        'start_date', 
        'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderPlan()  // 確保有此方法以連接到 OrderPlan
    {
        return $this->belongsTo(OrderPlan::class);
    }

    public function classBookings()
    {
        return $this->hasMany(ClassBooking::class);
    }

    public function updateRemainingLessons($change)
    {
        $this->remaining_lessons += $change;
        $this->save();
    }
}
