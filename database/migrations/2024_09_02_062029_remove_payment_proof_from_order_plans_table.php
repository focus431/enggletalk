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
        Schema::table('order_plans', function (Blueprint $table) {
            $table->dropColumn('payment_proof');
        });
    }

    /**
     * 回滚迁移
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_plans', function (Blueprint $table) {
            $table->string('payment_proof')->nullable();
        });
    }
};
