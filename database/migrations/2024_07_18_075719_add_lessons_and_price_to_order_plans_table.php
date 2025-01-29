<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLessonsAndPriceToOrderPlansTable extends Migration
{
    public function up()
    {
        Schema::table('order_plans', function (Blueprint $table) {
            $table->integer('lessons')->default(0);  // 設定課程數不為空，預設值為0
            $table->integer('price');               // 價格設定為整數
        });
    }

    public function down()
    {
        Schema::table('order_plans', function (Blueprint $table) {
            $table->dropColumn(['lessons', 'price']);
        });
    }

};
