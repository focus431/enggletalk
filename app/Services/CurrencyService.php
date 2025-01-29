<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CurrencyService
{
    
    /**
     * 获取指定货币的汇率
     *
     * @param string $currency 目标货币代码
     * @return float 汇率
     */
    public function getExchangeRate($currency)
    {
        
        // 使用缓存来存储汇率，缓存时间为86400秒（1天）
        return Cache::remember("exchange_rate_{$currency}", 86400, function () use ($currency) {
            $apiKey = config('currency.api_key'); // 从配置中获取API密钥
            $baseCurrency = config('currency.base_currency'); // 获取基准货币

            // 使用正确的 API URL 格式
            $url = "https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$baseCurrency}";

            Log::info("Attempting to fetch exchange rate for {$currency} with base {$baseCurrency} using URL: {$url}");

            try {
                $response = Http::get($url);

                if ($response->successful()) {
                    $rates = $response->json()['conversion_rates'] ?? [];
                    $rate = $rates[$currency] ?? 1;
                    Log::info("Successfully fetched exchange rate: {$rate} for currency: {$currency}");
                    return $rate;
                } else {
                    Log::error("Failed to fetch exchange rate. HTTP Status: " . $response->status());
                    Log::error("Response: " . json_encode($response->json()));
                }
            } catch (\Exception $e) {
                Log::error("Exception occurred while fetching exchange rate: " . $e->getMessage());
            }

            return 1; // 默认返回1
        });
    }

    /**
     * 根据语言获取对应的货币代码
     *
     * @param string $language 语言代码
     * @return string 货币代码
     */
    public function getCurrencyByLanguage($language)
    {
        switch ($language) {
            case 'en':
                return 'USD'; // 美元
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
                return 'USD'; // 默认货币为美元
        }
    }
}

