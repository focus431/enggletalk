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
        Schema::table('reviews', function (Blueprint $table) {
            // 重命名 booking_id 为 classschedule_id
            $table->renameColumn('booking_id', 'classschedule_id');
            
            // 添加 mentee_id 列
            $table->unsignedBigInteger('mentee_id')->after('mentor_id')->nullable();

            // 如果需要，还可以添加外键约束
            // $table->foreign('mentee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // 将列名改回去
            $table->renameColumn('classschedule_id', 'booking_id');
            
            // 删除 mentee_id 列
            $table->dropColumn('mentee_id');
        });
    }
};
