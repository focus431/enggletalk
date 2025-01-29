<?php

namespace App\Http\Controllers;

use App\Models\Essay;
use App\Services\EssayCorrectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EssayController extends Controller
{
    protected $correctionService;

    public function __construct(EssayCorrectionService $correctionService)
    {
        $this->correctionService = $correctionService;
    }

    public function index()
    {
        $essays = Auth::user()->essays()->with('correction')->latest()->paginate(10);
        return view('essays.index', compact('essays'));
    }

    public function create()
    {
        return view('essays.create');
    }

    public function store(Request $request)
    {
        try {
            Log::info('開始處理作文提交', ['user_id' => Auth::id()]);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string|min:100',
                'topic_type' => 'required|string|max:50'
            ]);

            $validated['user_id'] = Auth::id();
            $validated['word_count'] = str_word_count($request->content);

            Log::info('創建作文記錄', ['data' => $validated]);
            $essay = Essay::create($validated);

            // 非同步處理作文批改
            Log::info('開始派發批改任務', ['essay_id' => $essay->id]);
            
            dispatch(function () use ($essay) {
                Log::info('執行批改任務', ['essay_id' => $essay->id]);
                try {
                    $this->correctionService->correctEssay($essay);
                    Log::info('批改任務完成', ['essay_id' => $essay->id]);
                } catch (\Exception $e) {
                    Log::error('批改任務失敗', [
                        'essay_id' => $essay->id,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                }
            })->afterResponse();

            Log::info('作文提交處理完成', ['essay_id' => $essay->id]);

            return redirect()->route('essays.show', $essay)
                ->with('success', '作文已提交，正在進行AI批改，請稍後查看結果。');

        } catch (\Exception $e) {
            Log::error('作文提交處理失敗', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors(['error' => '作文提交失敗，請稍後再試。']);
        }
    }

    public function show(Essay $essay)
    {
        $this->authorize('view', $essay);
        return view('essays.show', compact('essay'));
    }

    public function history()
    {
        $essays = Auth::user()->essays()
            ->with('correction')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('essays.history', compact('essays'));
    }

    public function destroy(Essay $essay)
    {
        // 確保當前用戶只能刪除自己的作文
        if ($essay->user_id !== auth()->id()) {
            return redirect()->back()->with('error', '您沒有權限刪除這篇作文');
        }

        try {
            $essay->delete();
            return redirect()->route('essays.index')->with('success', '作文已成功刪除');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '刪除作文時發生錯誤');
        }
    }
} 