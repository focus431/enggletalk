<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // 指定與模型相關聯的資料表名稱
    protected $table = 'comments';

    // 指定可以被批量賦值的欄位
    protected $fillable = ['name', 'avatar_path', 'content','email','blog_id'];

    // 如果您的資料表有 created_at 和 updated_at 欄位並希望 Laravel 自動維護，則保留此行
    public $timestamps = true;

    // 如果您的資料表中沒有 created_at 和 updated_at 欄位，或您不希望自動維護這些欄位，則取消註釋以下行
    // public $timestamps = false;
}
