<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoCallController extends Controller
{
    public function index(Request $request)
    {
        // 获取 Room ID，如果没有提供，则使用默认值
        $roomId = $request->input('roomId', 'default-room');

        // 返回视图并传递 Room ID
        return view('video-call', compact('roomId'));
    }
}
