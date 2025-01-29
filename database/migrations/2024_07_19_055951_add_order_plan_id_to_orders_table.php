<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderPlanIdToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('order_plan_id')->after('user_id')->nullable();  // 可以根據需求設置為可空
            $table->foreign('order_plan_id')->references('id')->on('order_plans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['order_plan_id']);
            $table->dropColumn('order_plan_id');
        });
    }
}
