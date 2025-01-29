<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('essays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->string('topic_type')->nullable(); // 作文類型（議論文、說明文等）
            $table->integer('word_count');
            $table->timestamps();
        });

        Schema::create('essay_corrections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('essay_id')->constrained()->onDelete('cascade');
            $table->integer('grammar_score')->comment('文法評分');
            $table->integer('content_score')->comment('內容評分');
            $table->integer('structure_score')->comment('結構評分');
            $table->integer('vocabulary_score')->comment('詞彙評分');
            $table->text('grammar_corrections')->comment('文法修正建議');
            $table->text('content_suggestions')->comment('內容改進建議');
            $table->text('vocabulary_suggestions')->comment('用詞建議');
            $table->text('overall_feedback')->comment('整體評語');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('essay_corrections');
        Schema::dropIfExists('essays');
    }
}; 