<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('essay_corrections', function (Blueprint $table) {
            // 先添加新欄位
            $table->text('grammar_corrections_zh')->nullable();
            $table->text('content_suggestions_zh')->nullable();
            $table->text('vocabulary_suggestions_zh')->nullable();
            $table->text('overall_feedback_zh')->nullable();
            $table->text('grammar_corrections_en')->nullable();
            $table->text('content_suggestions_en')->nullable();
            $table->text('vocabulary_suggestions_en')->nullable();
            $table->text('overall_feedback_en')->nullable();
        });

        // 複製現有資料到新欄位
        DB::statement('UPDATE essay_corrections SET 
            grammar_corrections_en = grammar_corrections,
            content_suggestions_en = content_suggestions,
            vocabulary_suggestions_en = vocabulary_suggestions,
            overall_feedback_en = overall_feedback');

        Schema::table('essay_corrections', function (Blueprint $table) {
            // 移除舊欄位
            $table->dropColumn('grammar_corrections');
            $table->dropColumn('content_suggestions');
            $table->dropColumn('vocabulary_suggestions');
            $table->dropColumn('overall_feedback');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('essay_corrections', function (Blueprint $table) {
            // 恢復舊欄位
            $table->text('grammar_corrections')->nullable();
            $table->text('content_suggestions')->nullable();
            $table->text('vocabulary_suggestions')->nullable();
            $table->text('overall_feedback')->nullable();
        });

        // 複製資料回舊欄位
        DB::statement('UPDATE essay_corrections SET 
            grammar_corrections = grammar_corrections_en,
            content_suggestions = content_suggestions_en,
            vocabulary_suggestions = vocabulary_suggestions_en,
            overall_feedback = overall_feedback_en');

        Schema::table('essay_corrections', function (Blueprint $table) {
            // 移除新欄位
            $table->dropColumn('grammar_corrections_zh');
            $table->dropColumn('content_suggestions_zh');
            $table->dropColumn('vocabulary_suggestions_zh');
            $table->dropColumn('overall_feedback_zh');
            $table->dropColumn('grammar_corrections_en');
            $table->dropColumn('content_suggestions_en');
            $table->dropColumn('vocabulary_suggestions_en');
            $table->dropColumn('overall_feedback_en');
        });
    }
};
