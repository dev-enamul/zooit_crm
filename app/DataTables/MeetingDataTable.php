<?php

namespace App\DataTables;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MeetingDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($data) {
                return view('meeting.meeting_action', compact('data'))->render();
            })
            ->addColumn('serial', function () {
                static $serial = 0;
                return ++$serial;
            })
            ->addColumn('name', function ($data) {
                $customerName = '';
                if (isset($data->customer) && isset($data->customer->user)) {
                    $customerName = $data->customer->user->name . ' [' . $data->customer->visitor_id . ']';
                }
                $url = route('customer.profile', encrypt($data->customer_id));
                return '<a class="text-primary" href="' . $url . '">' . e($customerName) . '</a>';
            })
            ->addColumn('email', function ($data) { 
                $email = $data->customer?->user?->userContacts->first()->email ?? '';
                $title = $data->title;
                $meeting_date = get_date($data->date_time, 'd M Y h:i A');
                $customer_name = $data->customer?->user?->name ?? 'Candidate';
                $mail_button = '<button class="btn btn-primary btn-sm ms-2" onclick="openSendMailModalMeeting(' . $data->customer->user->id . ', \''. addslashes($title) .'\', \''. $meeting_date .'\', \''. addslashes($customer_name) .'\')"><i class="fas fa-paper-plane"></i></button>';
                return $email . $mail_button;
            })
            ->addColumn('contact', function ($data) {
                $phone = @$data->customer->user->phone;
                if ($phone) {
                    return $phone . '
                            <a href="tel:' . $phone . '" class="btn btn-primary btn-sm ms-2" style="margin-right: 5px;">
                                <i class="fas fa-phone"></i>
                            </a>
                             
                            <button class="btn btn-secondary btn-sm copy-phone" data-phone="' . $phone . '" style="margin-right: 5px;">
                                <i class="fas fa-copy"></i>
                            </button>  

                             <a target="blank" href="https://api.whatsapp.com/send/?phone=' . preg_replace('/[^0-9]/', '', $phone) . '" class="btn btn-success btn-sm" style="margin-right: 5px;">
                                <i class="fab fa-whatsapp"></i>
                            </a> 
                    ';
                }
                return $phone;
            })
            ->addColumn('meeting_date', function ($data) {
                return get_date($data->date_time);
            })
            ->addColumn('meeting_time', function ($data) {
                return get_date($data->date_time, 'h:i A');
            })
            ->rawColumns(['action', 'name', 'email', 'contact'])
            ->setRowId('id');
    }

    public function query(Meeting $model, Request $request): QueryBuilder
    {
        if (isset($request->date)) {
            $date       = explode(' - ', $request->date);
            $start_date = date('Y-m-d', strtotime($date[0]));
            $end_date   = date('Y-m-d', strtotime($date[1]));
            $model      = $model->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
        }

        if (isset($request->employee)) {
            $user_id = (int) $request->employee;
        } else {
            $user_id = auth()->user()->id;
        }
        $user        = User::find($user_id);
        $my_employee = json_decode($user->user_employee);
        if ($my_employee == null) {
            $my_employee = [Auth::user()->id];
        }

        return $model->newQuery()
            ->with('customer.user.userContacts')
            ->where('status', 0)
            ->whereHas('customer', function ($q) use ($my_employee) {
                $q->whereIn('ref_id', $my_employee);
            })
            ->orderBy('date_time', 'asc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('meeting-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('serial'),
            Column::make('name'),
            Column::make('email'),
            Column::make('contact'),
            Column::make('meeting_date'),
            Column::make('meeting_time'),
        ];
    }

    protected function filename(): string
    {
        return 'Meeting_' . date('YmdHis');
    }
}