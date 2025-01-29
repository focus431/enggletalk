<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    public function up()
{
    if (!Schema::hasTable('ledgers')) {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->string('month');
            $table->integer('total_lessons')->default(0);
            $table->decimal('total_amount', 8, 2)->default(0);
            $table->string('status')->default('unpaid');
            $table->date('paid_on')->nullable();
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}

    public function down()
    {
        Schema::dropIfExists('ledgers');
    }
}

