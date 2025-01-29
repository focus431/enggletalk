<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'mentor_id', 'status'];

    /**
     * 获取属于这个收藏的用户。
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获取属于这个收藏的老师。
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
