<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; // 这里导入 Log 类
use Ecpay\Sdk\Factories\Factory;
use Ecpay\Sdk\Services\UrlService;
use App\Models\PaymentPlan;
use App\Models\OrderPlan; // 这里导入 OrderPlan 模型
use App\Models\User; // 这里导入 User 模型
use Illuminate\Support\Facades\Auth;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\App;

class EcpayController extends Controller
{
    protected $currencyService;

    /**
     * 构造函数，注入 CurrencyService
     *
     * @param CurrencyService $currencyService
     */
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * 处理结账请求
     *
     * @param Request $request
     * @return void
     */
    public function checkout(Request $request)
    {
        // 加入除錯記錄
        Log::info('ECPAY_MERCHANT_ID value:', ['merchant_id' => env('ECPAY_MERCHANT_ID')]);
        
        $planId = $request->input('card_id'); // 获取选择的计划ID
        $plan = PaymentPlan::find($planId); // 查找计划

        $language = App::getLocale(); // 获取当前语言
        Log::info("Current language: {$language}");
        $currency = $this->currencyService->getCurrencyByLanguage($language); // 获取对应货币
        Log::info("Currency: {$currency}");
        $exchangeRateToTWD = $this->currencyService->getExchangeRate('TWD'); // 获取美金到台币的汇率

        $priceInTWD = $plan->price * $exchangeRateToTWD; // 将价格转换为台币

        // 初始化 ECPay SDK 工厂
        $factory = new Factory([
            'hashKey' => env('ECPAY_HASH_KEY'),
            'hashIv' => env('ECPAY_HASH_IV'),
        ]);

        $autoSubmitFormService = $factory->create('AutoSubmitFormWithCmvService');

        // 设置交易信息
        $input = [
            'MerchantID' => env('ECPAY_MERCHANT_ID'),
            'MerchantTradeNo' => 'Test' . time(),
            'MerchantTradeDate' => Carbon::now()->format('Y/m/d H:i:s'),
            'PaymentType' => 'aio',
            'TotalAmount' => round($priceInTWD), // 使用转换后的台币价格
            'TradeDesc' => UrlService::ecpayUrlEncode("Purchase of {$plan->name} plan"),
            'ItemName' => $plan->name . " ({$plan->lessons} 课程/50分鐘)",
            'ReturnURL' => route('ecpay.notify'),
            'ClientBackURL' => route('ecpay.return'),
            'ChoosePayment' => 'ALL',
            'EncryptType' => 1,
            'CustomField1' => $plan->id,
            'CustomField2' => Auth::id(),
        ];

        // 生成支付表单并自动提交
        echo $autoSubmitFormService->generate($input, 'https://payment.ecpay.com.tw/Cashier/AioCheckOut/V5');
    }

    public function notify(Request $request)
    {
        Log::info('ECPay notify received:', $request->all());
        $data = $request->all();

        if ($data['RtnCode'] == '1') { // 支付成功
            $planId = $data['CustomField1']; // 从通知数据中获取 plan_id
            $userId = $data['CustomField2']; // 从通知数据中获取 user_id
            $plan = PaymentPlan::find($planId);
            $user = User::find($userId); // 获取用户实例

            if ($plan && $user) {
                // 创建一个新的订单
                $order = new OrderPlan();
                $order->user_id = $userId;
                $order->last_name = $user->last_name;
                $order->first_name = $user->first_name;
                $order->selected_plan = $plan->name;
                $order->lessons = $plan->lessons;
                $order->price = $plan->price;
                $order->duration = $plan->duration;
                $order->expiry_date = now()->addDays($plan->duration);
                $order->status = 'paid';
                $order->payment_option = $data['PaymentType'] ?? 'Unknown'; // 设置 payment_option 字段

                $order->save();

                // 激活用户并添加课程数量
                $user->activated = 1; // 激活用户账户
                $user->remaining_classes += $plan->lessons; // 添加购买的课程数量
                Log::info('User remaining classes after purchase:', ['user_id' => $user->id, 'remaining_classes' => $user->remaining_classes]);
                $user->save();

                return response('1|OK');
            }
        }

        return response('0|Fail');
    }

    public function return(Request $request)
    {
        // 支付完成后，用户重定向回商店页面
        return view('ecpay_success');
    }
}