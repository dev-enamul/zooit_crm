<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\WorkTime;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Carbon\CarbonPeriod;
use Yajra\DataTables\CollectionDataTable;

class DailyAttendanceDataTable extends DataTable
{
    public function dataTable()
    {
        $startDate = $this->request()->get('start_date', Carbon::now()->toDateString());
        $endDate = $this->request()->get('end_date', Carbon::now()->toDateString());

        $period = CarbonPeriod::create($startDate, $endDate);
        $users = User::where('user_type', 1)->get();

        $allWorkTimes = WorkTime::whereBetween('start_time', [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()])
            ->get()
            ->groupBy(function($item) {
                return $item->user_id . '_' . Carbon::parse($item->start_time)->toDateString();
            });

        $data = collect();

        foreach ($period as $date) {
            foreach ($users as $user) {
                $key = $user->id . '_' . $date->toDateString();
                $workTimes = $allWorkTimes->get($key, collect());

                $data->push([
                    'user' => $user,
                    'date' => $date->toDateString(),
                    'workTimes' => $workTimes,
                ]);
            }
        }

        return (new CollectionDataTable($data))
            ->addColumn('name', function ($row) {
                return $row['user']->name;
            })
            ->addColumn('date', function ($row) {
                return $row['date'];
            })
            ->addColumn('start_time', function ($row) {
                $workTimes = $row['workTimes'];
                if ($workTimes->isEmpty()) return null;
                return Carbon::parse($workTimes->sortBy('start_time')->first()->start_time)->format('h:i A');
            })
            ->addColumn('end_time', function ($row) {
                $workTimes = $row['workTimes'];
                if ($workTimes->isEmpty()) return 'continue';
                $lastEndTime = $workTimes->sortByDesc('end_time')->first()->end_time;
                if ($lastEndTime === null) return 'continue';
                return Carbon::parse($lastEndTime)->format('h:i A');
            })
            ->addColumn('duration', function ($row) {
                $workTimes = $row['workTimes'];
                if ($workTimes->isEmpty()) return 0;
                $durationInMinutes = $workTimes->sum('duration');
                $durationInHours = $durationInMinutes / 60;
                return number_format($durationInHours, 2) . ' hours';
            })
            ->addColumn('status', function ($row) {
                $workTimes = $row['workTimes'];
                if ($workTimes->isEmpty()) return 'absent';

                $firstStart = Carbon::parse($workTimes->sortBy('start_time')->first()->start_time);
                $lastEnd = Carbon::parse($workTimes->sortByDesc('end_time')->first()->end_time);

                $late = $firstStart->hour >= 9;
                $early = $lastEnd->hour < 18;

                if ($late && $early) return 'late_early';
                if ($late) return 'late_present';
                if ($early) return 'early_leave';
                return 'present';
            })
            ->addColumn('action', function ($row) {
                $userId = $row['user']->id;
                $date = $row['date'];
                return '<button class="btn btn-sm btn-info view-work-log" data-user-id="' . $userId . '" data-date="' . $date . '">Log</button>';
            })
            ->setRowId(function ($row) {
                return $row['user']->id . '_' . $row['date'];
            })
            ->setRowClass(function ($row) {
                $workTimes = $row['workTimes'];
                $lastWorkTimeEntry = $workTimes->sortByDesc('start_time')->first();
                $lastEndTime = $lastWorkTimeEntry ? $lastWorkTimeEntry->end_time : null;

                if ($lastEndTime === null) {
                    return 'highlight-row';
                }
                return '';
            });
    }

    public function query(): QueryBuilder
    {
        // This is a dummy query to satisfy the type hint and the service container.
        // The actual data is prepared and loaded in the dataTable method.
        return User::query()->whereRaw('1 = 0');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('dailyattendance-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['pdf', 'excel'],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('name')->title('Employee'),
            Column::computed('date')->title('Date')->orderable(true),
            Column::computed('start_time')->title('Start Time')->orderable(true),
            Column::computed('end_time')->title('End Time')->orderable(true),
            Column::computed('duration')->title('Duration'),
            Column::computed('status')->title('Status')->orderable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'DailyAttendance_' . date('YmdHis');
    }
}