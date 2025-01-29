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
    Schema::create('remittances', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('teacher_id');
        $table->integer('total_lessons');
        $table->decimal('total_amount', 8, 0);
        $table->string('status')->default('unpaid');
        $table->date('paid_on')->nullable();
        $table->timestamps();

        // 外鍵約束
        $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('remittances');
}


};
