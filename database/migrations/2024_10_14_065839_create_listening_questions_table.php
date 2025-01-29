<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('listening_questions', function (Blueprint $table) {
        $table->id();
        $table->string('audio_file');  // 存儲音頻檔案路徑
        $table->string('question');
        $table->string('option_a');
        $table->string('option_b');
        $table->string('option_c');
        $table->string('option_d');
        $table->string('correct_answer');
        $table->string('difficulty_level');
        $table->string('category');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listening_questions');
    }
};
