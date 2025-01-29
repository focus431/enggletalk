<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuaranteeCertificate extends Model
{
    use HasFactory;

    // 自動轉換為 Carbon 實例的日期字段
    protected $dates = ['issue_date', 'valid_until', 'payment_date'];

    // 可批量填充的字段
    protected $fillable = [
        'certificate_number',         // 擔保書編號
        'student_name',               // 學生姓名
        'id_number',                  // 身份證號碼
        'tuition_fee',                // 學費金額
        'school_name',                // 就讀學校
        'agency_name',                // 代辦公司名稱
        'agency_contact',             // 聯絡電話
        'agency_responsible_person',  // 負責人姓名（新欄位）
        'issue_date',                 // 簽發日期
        'valid_until',                // 有效期限
        'payment_date',               // 擔保金支付日期（新欄位）
                            
    ];
}
