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
    Schema::table('blogs', function (Blueprint $table) {
        $table->string('author')->nullable(); // 添加 'author' 列
    });
}

public function down()
{
    Schema::table('blogs', function (Blueprint $table) {
        $table->dropColumn('author'); // 移除 'author' 列
    });
}

};
