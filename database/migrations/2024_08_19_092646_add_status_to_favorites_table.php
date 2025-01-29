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
        Schema::table('favorites', function (Blueprint $table) {
            // 添加 status 字段，数据类型为 string，并设置默认值为 'active'
            $table->string('status')->default('active')->after('mentor_id');
        });
    }

    /**
     * 逆向迁移。
     *
     * @return void
     */
    public function down()
    {
        Schema::table('favorites', function (Blueprint $table) {
            // 删除 status 字段
            $table->dropColumn('status');
        });
    }
};
