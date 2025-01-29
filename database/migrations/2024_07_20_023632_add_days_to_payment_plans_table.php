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
    Schema::table('payment_plans', function (Blueprint $table) {
        $table->integer('days')->nullable(); // 假設天數可以為空
    });
}

public function down()
{
    Schema::table('payment_plans', function (Blueprint $table) {
        $table->dropColumn('days');
    });
}

};
