<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogViewerController extends Controller
{
    // 显示日志列表页面
    public function index()
    {
        // 获取日志文件路径
        $files = File::files(storage_path('logs'));

        return view('log-viewer.index', compact('files'));
    }

    // 查看单个日志文件内容
    public function show($filename)
    {
        // 获取日志文件路径
        $path = storage_path('logs') . '/' . $filename;

        if (!File::exists($path)) {
            return abort(404, 'Log file not found');
        }

        // 读取日志文件内容
        $content = File::get($path);

        // 返回视图并传递内容
        return view('log-viewer.show', compact('content', 'filename'));
    }
}
