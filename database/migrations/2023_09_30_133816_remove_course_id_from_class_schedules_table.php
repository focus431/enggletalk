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
    Schema::table('class_schedules', function (Blueprint $table) {
        // 移除外鍵約束
        $table->dropForeign(['course_id']);
        // 刪除欄位
        $table->dropColumn('course_id');
    });
}



    /**
     * Reverse the migrations.
     *
     * @return void
     */
   public function down()
{
    Schema::table('class_schedules', function (Blueprint $table) {
        $table->integer('course_id')->nullable();
        $table->foreign('course_id')->references('id')->on('courses');
    });
}


};
