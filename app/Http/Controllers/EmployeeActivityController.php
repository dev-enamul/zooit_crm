<?php

namespace App\Http\Controllers;

use App\DataTables\DailyAttendanceDataTable;
use App\DataTables\AttendanceSummaryDataTable;
use Illuminate\Http\Request;
use App\Models\WorkTime;
use App\Models\User;
use Carbon\Carbon;

class EmployeeActivityController extends Controller
{
    public function attendanceSummary(AttendanceSummaryDataTable $dataTable)
    {
        return $dataTable->render('admin.reports.attendance_summary');
    }
    public function dailyAttendance(DailyAttendanceDataTable $dataTable)
    {
        return $dataTable->render('admin.reports.daily_attendance');
    }

    public function getWorkLogs(Request $request)
    {
        $userId = $request->input('user_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $workLogs = WorkTime::with(['project', 'task'])
            ->where('user_id', $userId)
            ->whereBetween('start_time', [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()])
            ->orderBy('start_time')
            ->get();

        return view('admin.reports.partials.work_log_table', compact('workLogs'));
    }
}
