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
    Schema::table('user_sessions', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->after('id');
        // 如果需要添加外鍵約束，可以取消以下註釋
        // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('user_sessions', function (Blueprint $table) {
        $table->dropColumn('user_id');
    });
}
};
