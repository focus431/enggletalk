<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmedMail;

class OrderPlanController extends Controller
{
    public function updateStatus(Request $request)
    {
        try {
            $order = OrderPlan::findOrFail($request->input('id'));
            $order->status = $request->input('status');
            
            // 使用时区偏移量调整 updated_at
            $timezoneOffset = $request->input('timezoneOffset', 0);
            $order->updated_at = Carbon::now()->subMinutes($timezoneOffset);
        
            $order->save();

            Log::info('Order status updated successfully for Order ID: ' . $order->id);
        
            // 如果狀態是 Confirmed，則更新 User 的 t_expired 字段並發送確認郵件
            if ($order->status === 'Confirmed') {
                $user = User::findOrFail($order->user_id);
                $user->t_expired = $order->expiry_date;
                $user->save();

                // 获取用户的语言，默认为英文
                $userLanguage = $user->language ?? $request->getPreferredLanguage(['en', 'zh','ja']);

// 调试：记录获取的语言
Log::info('Language preference determined: ' . $userLanguage);

Log::info('Preparing to send confirmation email to user: ' . $user->email . ' in language: ' . $userLanguage);
                // 发送确认邮件
                Mail::to($user->email)->send(new OrderConfirmedMail($order, $userLanguage));

                Log::info('Confirmation email sent successfully to: ' . $user->email);
            
            // 发送确认邮件给管理者
            $adminEmail = 'leicesl1@gmail.com';
            Mail::to($adminEmail)->send(new OrderConfirmedMail($order, $userLanguage));
            Log::info('Confirmation email sent successfully to admin: ' . $adminEmail);
            }

            return response()->json(['message' => 'Order status updated and email sent successfully!']);
        } catch (\Exception $e) {
            Log::error('Error updating order status or sending email: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update order status or send email'], 500);
        }
    }

    public function transactionsList()
    {
        $orders = OrderPlan::all(); // 獲取所有訂單
        return view('admin.transactions-list', ['orders' => $orders]); // 確保視圖的路徑正確
    }

    public function bookingSuccess()
    {
        // 这里可以检查 session 状态消息
        return view('booking-success');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'selected_plan' => 'required|string|max:255',
            'lessons' => 'required|integer|min:0',
            'price' => 'required|integer',
            'payment_option' => 'required',
            'bank_transfer_proof' => 'required|image|max:2048',
            'duration' => 'required|integer',
            'timezoneOffset' => 'required|integer',  // 驗證 timezoneOffset
        ]);
        
        $filePath = $request->file('bank_transfer_proof')->store('public/payment_proofs');

        $duration = $request->input('duration');
        $expiryDate = Carbon::now()->addDays($duration);

        // 使用時區偏移量調整 created_at 和 updated_at
        $timezoneOffset = $request->input('timezoneOffset');
        $createdAt = Carbon::now()->subMinutes($timezoneOffset);
        $updatedAt = Carbon::now()->subMinutes($timezoneOffset);

        // 创建 OrderPlan 实例
        $orderPlan = OrderPlan::create([
            'user_id' => Auth::id(),
            'last_name' => $request->input('last_name'),
            'first_name' => $request->input('first_name'),
            'payment_option' => $request->input('payment_option'),
            'lessons' => $request->input('lessons'),
            'price' => $request->input('price'),
            'duration' => $duration,
            'expiry_date' => $expiryDate,
            'payment_proof' => $filePath,
            'status' => 'pending',
            'selected_plan' => $request->input('selected_plan'),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ]);

        return redirect()->route('booking-success')->with('orderPlan', $orderPlan)->with('status', 'Order submitted successfully!');
    }
}
