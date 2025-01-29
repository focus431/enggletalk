<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgencyResponsiblePersonAndPaymentDateToGuaranteeCertificatesTable extends Migration
{
    public function up()
    {
        Schema::table('guarantee_certificates', function (Blueprint $table) {
            $table->string('agency_responsible_person')->nullable()->after('agency_name'); // 負責人姓名
            $table->date('payment_date')->nullable()->after('valid_until'); // 擔保金支付日期
        });
    }

    public function down()
    {
        Schema::table('guarantee_certificates', function (Blueprint $table) {
            $table->dropColumn(['agency_responsible_person', 'payment_date']);
        });
    }
};
