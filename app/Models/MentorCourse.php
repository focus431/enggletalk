<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorCourse extends Model
{
    use HasFactory;

    // 指定對應的資料表名稱
    protected $table = 'mentor_courses';

    // 允許批量賦值的欄位
    protected $fillable = [
        'user_id',
        'course_id',
    ];

    // 指定主鍵
    protected $primaryKey = 'id';

    // 自動管理 created_at 和 updated_at 欄位
    public $timestamps = true;

    /**
     * 關聯到 User 模型 (假設每個 mentor_course 對應到一個 user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 關聯到 Course 模型 (假設每個 mentor_course 對應到一個 course)
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
