<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');  // 外鍵關聯到 questions 表
            $table->text('option_text');  // 選項內容
            $table->char('option_label', 1);  // 選項標籤 (A, B, C 或 D)
            $table->timestamps();  // 建立及更新時間
        });
    }

    public function down()
    {
        Schema::dropIfExists('options');
    }
};
