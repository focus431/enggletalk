<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question_text');  // 題目內容
            $table->string('category')->nullable();  // 題目分類
            $table->char('correct_answer', 1);  // 正確答案 (A, B, C 或 D)
            $table->timestamps();  // 建立及更新時間
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
