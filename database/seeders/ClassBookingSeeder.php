<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassBooking;

class ClassBookingSeeder extends Seeder
{
    public function run()
    {
        ClassBooking::create([
            'order_id' => 1, // 假设订单 ID 为 1
            'user_id' => 1, // 假设用户 ID 为 1
            'class_schedule_id' => 1, // 假设课程表 ID 为 1
            'status' => 'booked'
        ]);
        // 添加更多测试数据...
    }
}
