<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
class TranslationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $lang = $request->query('lang', 'zh_TW');
            
            // 讀取 JSON 翻譯檔
            $jsonPath = resource_path("lang/{$lang}.json");
            $translations = [];
            
            if (File::exists($jsonPath)) {
                $translations = json_decode(File::get($jsonPath), true);
            }
            
            // 讀取 PHP 翻譯檔
            $phpPath = resource_path("lang/{$lang}");
            if (File::isDirectory($phpPath)) {
                $phpFiles = File::files($phpPath);
                foreach ($phpFiles as $file) {
                    $key = basename($file, '.php');
                    $values = require $file->getPathname();
                    $translations[$key] = $values;
                }
            }

            return response()->json($translations);
            
        } catch (\Exception $e) {
            Log::error('Translation loading failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => '無法載入翻譯檔案',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
