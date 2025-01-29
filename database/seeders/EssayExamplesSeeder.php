<?php

namespace Database\Seeders;

use App\Models\Essay;
use App\Models\User;
use Illuminate\Database\Seeder;

class EssayExamplesSeeder extends Seeder
{
    public function run()
    {
        // 確保有測試用戶
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'password' => bcrypt('password'),
                'role' => 'mentee'
            ]
        );

        // 創建範例作文
        $essays = [
            [
                'title' => 'The Impact of Technology on Education',
                'content' => "Technology has revolutionized the way we learn and teach in modern society. Traditional classrooms are being transformed into digital learning spaces, where students can access information instantly and engage with educational content in new ways.

First, the integration of technology in education has made learning more accessible. Students can now attend virtual classes from anywhere in the world, access digital textbooks, and collaborate with peers online. This has broken down geographical barriers and democratized education.

Furthermore, technology has made learning more interactive and engaging. Through educational apps, virtual reality experiences, and online simulations, students can visualize complex concepts and participate in hands-on learning activities. This has helped improve understanding and retention of information.

However, there are also challenges to consider. The digital divide between students who have access to technology and those who don't can create educational inequalities. Additionally, excessive screen time and online distractions can impact focus and learning effectiveness.

In conclusion, while technology has brought significant benefits to education, it's important to implement it thoughtfully and ensure equal access for all students. The future of education lies in finding the right balance between traditional teaching methods and technological innovation.",
                'topic_type' => 'argumentative',
                'word_count' => 156
            ],
            [
                'title' => 'My Summer Vacation',
                'content' => "Last summer, I had an unforgettable vacation with my family in Hawaii. The moment we stepped off the plane, we were greeted by the warm tropical breeze and the sweet scent of plumeria flowers.

Our days were filled with exciting activities. We went snorkeling in crystal-clear waters, where we saw colorful fish and even a sea turtle. The coral reefs were like underwater gardens, teeming with marine life. We also tried surfing lessons, though I spent more time falling off the board than riding waves!

The local cuisine was another highlight of our trip. We enjoyed fresh pineapples, coconuts, and traditional Hawaiian dishes at a luau. The entertainment at the luau was spectacular, with fire dancers and traditional hula performances.

One of my favorite memories was hiking to a waterfall. The trail was challenging but rewarding, and the view at the end was breathtaking. The sound of the falling water and the lush greenery around us created a peaceful atmosphere.

This vacation taught me about Hawaiian culture and the importance of preserving natural beauty. It was more than just a trip; it was an educational experience that I'll never forget.",
                'topic_type' => 'narrative',
                'word_count' => 143
            ]
        ];

        foreach ($essays as $essayData) {
            Essay::create([
                'user_id' => $user->id,
                'title' => $essayData['title'],
                'content' => $essayData['content'],
                'topic_type' => $essayData['topic_type'],
                'word_count' => $essayData['word_count']
            ]);
        }
    }
} 