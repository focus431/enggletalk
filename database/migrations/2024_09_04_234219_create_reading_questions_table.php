<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadingQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reading_questions', function (Blueprint $table) {
            $table->id(); // 自增ID
            $table->text('question'); // 题目内容
            $table->string('option_a'); // 选项A
            $table->string('option_b'); // 选项B
            $table->string('option_c'); // 选项C
            $table->string('option_d'); // 选项D
            $table->string('correct_answer'); // 正确答案
            $table->string('difficulty_level')->nullable(); // 难度等级（可选）
            $table->string('category')->nullable(); // 题目分类（可选）
            $table->timestamps(); // 创建时间和更新时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reading_questions');
    }
}
