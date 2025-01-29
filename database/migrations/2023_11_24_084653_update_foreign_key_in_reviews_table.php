<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyInReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // 移除舊的外鍵約束
            $table->dropForeign(['booking_id']);

            // 新增外鍵約束，指向 class_schedules 表
            $table->foreign('booking_id')->references('id')->on('class_schedules')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // 回滾時恢復原有的外鍵約束
            $table->dropForeign(['booking_id']);
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }
}

