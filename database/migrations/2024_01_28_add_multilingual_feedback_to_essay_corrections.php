<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('essay_corrections', function (Blueprint $table) {
            // 日文回饋欄位
            $table->text('grammar_corrections_ja')->nullable();
            $table->text('content_suggestions_ja')->nullable();
            $table->text('vocabulary_suggestions_ja')->nullable();
            $table->text('overall_feedback_ja')->nullable();

            // 韓文回饋欄位
            $table->text('grammar_corrections_ko')->nullable();
            $table->text('content_suggestions_ko')->nullable();
            $table->text('vocabulary_suggestions_ko')->nullable();
            $table->text('overall_feedback_ko')->nullable();

            // 越南文回饋欄位
            $table->text('grammar_corrections_vi')->nullable();
            $table->text('content_suggestions_vi')->nullable();
            $table->text('vocabulary_suggestions_vi')->nullable();
            $table->text('overall_feedback_vi')->nullable();
        });
    }

    public function down()
    {
        Schema::table('essay_corrections', function (Blueprint $table) {
            // 移除日文欄位
            $table->dropColumn([
                'grammar_corrections_ja',
                'content_suggestions_ja',
                'vocabulary_suggestions_ja',
                'overall_feedback_ja'
            ]);

            // 移除韓文欄位
            $table->dropColumn([
                'grammar_corrections_ko',
                'content_suggestions_ko',
                'vocabulary_suggestions_ko',
                'overall_feedback_ko'
            ]);

            // 移除越南文欄位
            $table->dropColumn([
                'grammar_corrections_vi',
                'content_suggestions_vi',
                'vocabulary_suggestions_vi',
                'overall_feedback_vi'
            ]);
        });
    }
}; 