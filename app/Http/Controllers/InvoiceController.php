<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderPlan;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // 獲取當前登入用戶的 ID
        $orderPlans = OrderPlan::where('user_id', $userId)->get(); // 只獲取當前登入用戶的 OrderPlan 記錄
        return view('invoices', compact('orderPlans'));
    }
    public function show($id)
    {
        $userId = Auth::id(); // 獲取當前登入用戶的 ID
        $order = OrderPlan::where('id', $id)->where('user_id', $userId)->firstOrFail(); // 確保訂單屬於當前登入用戶
        return view('invoice-view', compact('order'));
    }
    public function print($id)
    {
        $userId = Auth::id(); // 確保當前登入用戶
        $order = OrderPlan::where('id', $id)->where('user_id', $userId)->firstOrFail(); // 確保訂單屬於當前登入用戶
        return view('invoice-print', compact('order')); // 使用 invoice-print 視圖來進行列印
    }
    
}
