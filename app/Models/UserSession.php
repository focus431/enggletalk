<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    use HasFactory;

    // 指定對應的資料表名稱
    protected $table = 'user_sessions';

    // 指定可填充的字段
    protected $fillable = [
        'user_id',
        'session_id',
        'created_at',
        'updated_at',
    ];

    // 如果您希望 `created_at` 和 `updated_at` 自動管理時間戳，保持以下設置
    public $timestamps = true;

    // 定義與 User 模型的關係
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
