<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ledger;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RemittanceController extends Controller
{
    public function index(Request $request)
    {
        // 获取当前登录用户的 ID
        $userId = Auth::id();
        
        $month = $request->input('month', now()->month); // 当前月份
        $year = $request->input('year', now()->year);    // 当前年份
    
        // 获取从1月到当前月的每个老师每个月的汇总数据
        $remittances = Ledger::selectRaw('teacher_id, month, year(created_at) as year, sum(total_lessons) as total_lessons, sum(total_amount) as total_amount, max(status) as status, max(paid_on) as paid_on')
                            ->where('teacher_id', $userId) // 只获取当前用户的记录
                            ->whereYear('created_at', $year)
                            ->whereMonth('created_at', '<=', $month) // 只获取1月到当前月份的数据
                            ->groupBy('teacher_id', 'month', 'year')
                            ->orderByRaw('FIELD(month, "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December")')
                            ->get();
    
        return view('remittance', compact('remittances', 'month', 'year'));
    }
    

    



    public function show($year, $userId)
{
    $sortField = request()->get('sort', 'schedule_date'); // 默认按日期排序
    $sortDirection = request()->get('direction', 'asc'); // 默认升序

    // 获取请求中的年份和月份参数，默认显示当前月份和年份
    $selectedMonth = request()->get('month', now()->month);
    $selectedYear = request()->get('year', $year); // 如果没有传入年份，则使用当前年份

    // 检查是否是要根据mentee的名字排序
    if ($sortField === 'mentee_name') {
        $sortField = 'users.last_name'; // 或者 'users.first_name'，具体看你需要排序的字段
    }

    $user = User::find($userId);
    $userTimezone = $user->timezone;

    // 查询指定月份的数据
    $details = ClassSchedule::with('mentee')
                            ->join('users', 'class_schedules.mentee_id', '=', 'users.id')
                            ->where('class_schedules.user_id', $userId)
                            ->where('class_schedules.status', 'Completed')
                            ->whereYear('class_schedules.schedule_date', $selectedYear)
                            ->whereMonth('class_schedules.schedule_date', $selectedMonth)
                            ->orderBy($sortField, $sortDirection)
                            ->select('class_schedules.*')
                            ->get();

    // 转换每条记录的时间为用户的本地时间
    $details->transform(function ($detail) use ($userTimezone) {
        $detail->start_time = \Carbon\Carbon::createFromFormat('H:i:s', $detail->start_time, 'UTC')
                                            ->setTimezone($userTimezone)
                                            ->format('H:i');
        $detail->end_time = \Carbon\Carbon::createFromFormat('H:i:s', $detail->end_time, 'UTC')
                                          ->setTimezone($userTimezone)
                                          ->format('H:i');
        return $detail;
    });

    return view('remittance_detail', compact('details', 'year', 'userId', 'selectedYear', 'selectedMonth'));
}











}
