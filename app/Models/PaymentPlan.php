<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPlan extends Model
{
    use HasFactory;

    // 可以被批量賦值的屬性
    protected $fillable = [
        'name', 
        'lessons', 
        'price', 
        'duration', 
        'description',
        'days'  // 新添加的字段
    ];
}
