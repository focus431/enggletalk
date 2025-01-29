<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EssayCorrection extends Model
{
    protected $fillable = [
        'essay_id',
        'grammar_score',
        'content_score',
        'structure_score',
        'vocabulary_score',
        'grammar_corrections_zh_tw',
        'grammar_corrections_zh_cn',
        'grammar_corrections_en',
        'grammar_corrections_ja',
        'grammar_corrections_ko',
        'grammar_corrections_vi',
        'content_suggestions_zh_tw',
        'content_suggestions_zh_cn',
        'content_suggestions_en',
        'content_suggestions_ja',
        'content_suggestions_ko',
        'content_suggestions_vi',
        'vocabulary_suggestions_zh_tw',
        'vocabulary_suggestions_zh_cn',
        'vocabulary_suggestions_en',
        'vocabulary_suggestions_ja',
        'vocabulary_suggestions_ko',
        'vocabulary_suggestions_vi',
        'overall_feedback_zh_tw',
        'overall_feedback_zh_cn',
        'overall_feedback_en',
        'overall_feedback_ja',
        'overall_feedback_ko',
        'overall_feedback_vi'
    ];

    public function essay(): BelongsTo
    {
        return $this->belongsTo(Essay::class);
    }
} 