<?php

namespace App\DataTables;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AttendanceSummaryDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('total_working_hour', function ($user) {
                // মোট কাজের সময় যোগ
                return gmdate('H:i', $user->workTimes->sum('duration') * 60);
            })
            ->addColumn('highest_hour', function ($user) {
                // একদিনে সর্বোচ্চ কাজের ঘণ্টা
                return $user->workTimes->groupBy(function($wt) {
                    return Carbon::parse($wt->start_time)->toDateString();
                })->map(function($daily) {
                    return gmdate('H:i', $daily->sum('duration') * 60);
                })->max();
            })
            ->addColumn('lowest_hour', function ($user) {
                // একদিনে সর্বনিম্ন কাজের ঘণ্টা
                return $user->workTimes->groupBy(function($wt) {
                    return Carbon::parse($wt->start_time)->toDateString();
                })->map(function($daily) {
                    return gmdate('H:i', $daily->sum('duration') * 60);
                })->min();
            })
            ->addColumn('total_working_day', function ($user) {
                // কত দিন কাজ করেছে
                return $user->workTimes->groupBy(function($wt) {
                    return Carbon::parse($wt->start_time)->toDateString();
                })->count();
            })
            ->addColumn('total_absent_day', function ($user) {
                // মোট অনুপস্থিত দিন
                $startDate = Carbon::parse(request()->get('start_date', now()->startOfMonth()));
                $endDate = Carbon::parse(request()->get('end_date', now()));
                $allDates = collect();
                for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                    $allDates->push($date->toDateString());
                }

                $presentDates = $user->workTimes->groupBy(function($wt) {
                    return Carbon::parse($wt->start_time)->toDateString();
                })->keys();

                return $allDates->diff($presentDates)->count();
            })
            ->addColumn('days_present', function ($user) {
                // মোট উপস্থিত দিন (অল্প হলেও)
                return $user->workTimes->groupBy(function($wt) {
                    return Carbon::parse($wt->start_time)->toDateString();
                })->count();
            })
            ->addColumn('late_days', function ($user) {
                // 9 টার পরে শুরু
                $lateCount = 0;
                $user->workTimes->groupBy(function($wt) {
                    return Carbon::parse($wt->start_time)->toDateString();
                })->each(function($daily) use (&$lateCount) {
                    $firstStart = $daily->sortBy('start_time')->first();
                    if (Carbon::parse($firstStart->start_time)->hour >= 9) {
                        $lateCount++;
                    }
                });
                return $lateCount;
            })
            ->addColumn('left_early', function ($user) {
                // 6 টার আগে শেষ
                $earlyCount = 0;
                $user->workTimes->groupBy(function($wt) {
                    return Carbon::parse($wt->start_time)->toDateString();
                })->each(function($daily) use (&$earlyCount) {
                    $lastEnd = $daily->sortByDesc('end_time')->first();
                    if (Carbon::parse($lastEnd->end_time)->hour < 18) {
                        $earlyCount++;
                    }
                });
                return $earlyCount;
            })
            ->addColumn('action', function ($user) {
                $userId = $user->id;
                $startDate = request()->get('start_date', now()->startOfMonth()->toDateString());
                $endDate = request()->get('end_date', now()->toDateString());
                return '<button class="btn btn-sm btn-info view-work-log" data-user-id="' . $userId . '" data-start-date="' . $startDate . '" data-end-date="' . $endDate . '">Log</button>';
            })
            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $startDate = $this->request()->get('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $this->request()->get('end_date', Carbon::now()->toDateString());

        return User::query()->where('user_type', 1)
            ->with(['workTimes' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_time', [$startDate, $endDate]);
            }]);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('attendancesummary-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'dom'     => 'Bfrtip',
                'buttons' => ['pdf', 'excel'],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('name')->title('Employee'),
            Column::computed('total_working_hour')->orderable(true)->searchable(false),
            Column::computed('highest_hour')->orderable(true)->searchable(false),
            Column::computed('lowest_hour')->orderable(true)->searchable(false),
            Column::computed('total_working_day'),
            Column::computed('total_absent_day'),
            Column::computed('days_present'),
            Column::computed('late_days'),
            Column::computed('left_early'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'AttendanceSummary_' . date('YmdHis');
    }
}
