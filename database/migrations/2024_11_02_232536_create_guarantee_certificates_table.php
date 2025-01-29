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
    Schema::create('guarantee_certificates', function (Blueprint $table) {
        $table->id();
        $table->string('certificate_number')->unique()->comment('擔保書編號');
        $table->string('student_name')->comment('學生姓名');
        $table->string('id_number')->comment('身份證號碼');
        $table->decimal('tuition_fee', 10, 2)->comment('學費金額');
        $table->string('school_name')->comment('就讀學校');
        $table->string('agency_name')->comment('代辦公司名稱');
        $table->string('agency_contact')->comment('聯絡電話');
        $table->date('issue_date')->comment('簽發日期');
        $table->date('valid_until')->comment('有效期限');
        $table->string('qr_code')->comment('QR碼');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guarantee_certificates');
    }
};
