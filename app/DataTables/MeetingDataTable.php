<?php

namespace App\DataTables;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MeetingDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
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
                if(@$data->customer->user->userContact->type==2){
                    $name = $data->customer->user->userContact->name." (". $data->customer->user->name .") ";
                }else{
                    $name = @$data->customer->user->name;
                }
                return $name;
            })
            ->addColumn('visitor_id', function ($data) { 
                return $data->customer->visitor_id;
            })  
            ->addColumn('meeting_date', function ($data) {  
                return get_date($data->date_time);
            })
            ->addColumn('meeting_time', function ($data) { 
                return get_date($data->date_time, 'h:i A');  
            })             
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Meeting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Meeting $model): QueryBuilder
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
        if($my_employee == null){
            $my_employee = [Auth::user()->id];
        }   

        return $model->newQuery()
        ->where('status', 0)
        ->whereHas('customer', function ($q) use ($my_employee) {
            $q->whereIn('ref_id', $my_employee);
        })
        ->orderBy('date_time', 'asc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('meeting-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
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

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'), 
            Column::make('serial'),
            Column::make('visitor_id'), 
            Column::make('name'), 
            Column::make('meeting_date'), 
            Column::make('meeting_time'),     
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Meeting_' . date('YmdHis');
    }
}
