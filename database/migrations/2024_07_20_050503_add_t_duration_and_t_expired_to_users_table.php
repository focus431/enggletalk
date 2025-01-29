<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTDurationAndTExpiredToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('t_duration')->nullable()->after('about_me'); // 假设 t_duration 为整数类型
            $table->dateTime('t_expired')->nullable()->after('t_duration'); // 假设 t_expired 为日期时间类型
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['t_duration', 't_expired']);
        });
    }
};
