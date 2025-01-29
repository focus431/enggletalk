<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'user_id' => 1, // 假设用户 ID 为 1
            'payment_plan_id' => 1, // 假设方案 ID 为 1
            'total_lessons' => 8,
            'remaining_lessons' => 8,
            'start_date' => now(),
            'end_date' => now()->addDays(30)
        ]);
        // 添加更多测试数据...
    }
}
