<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Essay extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'topic_type',
        'word_count'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function correction(): HasOne
    {
        return $this->hasOne(EssayCorrection::class);
    }
} 