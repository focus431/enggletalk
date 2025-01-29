<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GuaranteeCertificate;
use Illuminate\Http\Request;

class GuaranteeCertificateController extends Controller
{
    public function store(Request $request)
    {
        // 驗證請求數據
        $request->validate([
            'student_name' => 'required|string|max:255',
            'id_number' => 'required|string|max:255',
            'tuition_fee' => 'required|numeric',
            'school_name' => 'required|string|max:255',
            'agency_name' => 'required|string|max:255',
            'agency_contact' => 'required|string|max:255',
            'agency_responsible_person' => 'required|string|max:255', // 驗證負責人姓名
            'valid_until' => 'required|date',
            'payment_date' => 'nullable|date', // 可選的擔保金支付日期
        ]);

        // 建立新的擔保書資料
        $certificate = new GuaranteeCertificate();
        $certificate->certificate_number = 'PECA-' . now()->format('Ymd') . '-' . random_int(1000000, 9999999);
        $certificate->student_name = $request->student_name;
        $certificate->id_number = $request->id_number;
        $certificate->tuition_fee = $request->tuition_fee;
        $certificate->school_name = $request->school_name;
        $certificate->agency_name = $request->agency_name;
        $certificate->agency_contact = $request->agency_contact;
        $certificate->agency_responsible_person = $request->agency_responsible_person; // 新增的負責人姓名
        $certificate->issue_date = now();
        $certificate->valid_until = $request->valid_until;
        $certificate->payment_date = $request->payment_date; // 新增的支付日期

        // 儲存到資料庫
        $certificate->save();

        // 成功儲存後，重定向至 guarantee.show 頁面，並傳遞 certificateNumber
        return redirect()->route('guarantee.show', ['certificateNumber' => $certificate->certificate_number]);
    }

    public function verify($certificateNumber)
    {
        $certificate = GuaranteeCertificate::where('certificate_number', $certificateNumber)->first();

        if (!$certificate) {
            return response()->json(['message' => '擔保書不存在或已過期'], 404);
        }

        return view('guarantee.show', compact('certificate'));
    }

    public function create()
    {
        return view('guarantee.create_guarantee');
    }
}
