<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDurationAndExpiryDateToOrderPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_plans', function (Blueprint $table) {
            $table->integer('duration')->after('price')->comment('方案有效天數');
            // 将 expiry_date 设置为可为空，并提供一个默认值
            $table->date('expiry_date')->nullable()->default('1970-01-01')->after('duration')->comment('方案到期日期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_plans', function (Blueprint $table) {
            $table->dropColumn(['duration', 'expiry_date']);
        });
    }
}
