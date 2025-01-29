<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToOrderPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_plans', function (Blueprint $table) {
            $table->string('last_name')->after('user_id');
            $table->string('first_name')->after('last_name');
            $table->string('selected_plan')->after('status');
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
            $table->dropColumn('last_name');
            $table->dropColumn('first_name');
            $table->dropColumn('selected_plan');
        });
    }

};
