<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentPlan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use App\Services\CurrencyService;

class PaymentPlanController extends Controller
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
     * 显示所有支付计划
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $plans = PaymentPlan::all();
        $isLoggedIn = Auth::check();
        $isMentee = false;

        if ($isLoggedIn) {
            $user = Auth::user();
            $isMentee = $user->role === 'mentee';
        }

        // 獲取當前語言
        $language = App::getLocale();
        // 根據當前語言獲取貨幣
        $currency = $this->currencyService->getCurrencyByLanguage($language);
        // 獲取匯率
        $exchangeRate = $this->currencyService->getExchangeRate($currency);

        // 將所有計畫的價格轉換為用戶的本地貨幣
        $convertedPlans = $plans->map(function($plan) use ($exchangeRate) {
            $plan->converted_price = $plan->price * $exchangeRate;
            return $plan;
        });

        return view('paymentplan', [
            'plans' => $convertedPlans,
            'isLoggedIn' => $isLoggedIn,
            'isMentee' => $isMentee,
            'currency' => $currency,
        ]);
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $plan = PaymentPlan::find($request->input('card_id'));

        // 获取当前的语言和相应的汇率
        $language = App::getLocale();
        $currency = $this->getCurrencyByLanguage($language);
        
        // 获取美金到台币的汇率
        $exchangeRateToTWD = config("currency.exchange_rates.TWD");

        // 将美金直接转换为台币进行结算
        $priceInTWD = $plan->price * $exchangeRateToTWD;

        // 使用台币进行结算
        $totalAmount = round($priceInTWD);

        // ECPay SDK 工厂初始化
        $factory = new \Ecpay\Sdk\Factories\Factory([
            'hashKey' => env('ECPAY_HASH_KEY'),
            'hashIv' => env('ECPAY_HASH_IV'),
        ]);

        // 创建自动提交表单服务
        $autoSubmitFormService = $factory->create('AutoSubmitFormWithCmvService');

        // 交易信息设置
        $input = [
            'MerchantID' => env('ECPAY_MERCHANT_ID'),
            'MerchantTradeNo' => 'Test' . time(),
            'MerchantTradeDate' => now()->format('Y/m/d H:i:s'),
            'PaymentType' => 'aio',
            'TotalAmount' => $totalAmount, // 使用台币金额
            'TradeDesc' => \Ecpay\Sdk\Services\UrlService::ecpayUrlEncode("Purchase of {$plan->name} plan"),
            'ItemName' => $plan->name . " ({$plan->lessons} 课程)",
            'ReturnURL' => route('ecpay.notify'),
            'ClientBackURL' => route('ecpay.return'),
            'ChoosePayment' => 'ALL', // 支付方式
            'EncryptType' => 1,
            'CustomField1' => $plan->id, // 传递 Plan ID
            'CustomField2' => $user->id, // 传递 User ID
            'CustomField3' => $plan->lessons, // 添加课程数量
        ];

        // 生成支付表单并自动提交
        echo $autoSubmitFormService->generate($input, 'https://payment.ecpay.com.tw/Cashier/AioCheckOut/V5');

        // 返回支付表单
        $html = $autoSubmitFormService->generate($input, 'https://payment.ecpay.com.tw/Cashier/AioCheckOut/V5');
        return view('ecpay_checkout')->with('html', $html);
    }

    private function getCurrencyByLanguage($language)
    {
        switch ($language) {
            case 'en':
                return 'USD'; // 美金
            case 'ja':
                return 'JPY'; // 日元
            case 'ko':
                return 'KRW'; // 韩元
            case 'zh-CN':
                return 'CNY'; // 人民币
            case 'zh_TW':
                return 'TWD'; // 新台币
            case 'vi':
                return 'VND'; // 越南盾
            default:
                return 'USD'; // 默认货币
        }
    }
}
