<?php

namespace App\DataTables;

use App\Models\Prospecting;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProspectingDataTable extends DataTable {
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($prospecting) {
                return view('prospecting.prospecting_action', compact('prospecting'))->render();
            }) 
            ->addColumn('phone', function ($data) {
                return $data->customer->user->phone ?? "-";
            }) 
            ->addColumn('cold_call_date', function ($data) {
                return get_date($data->cold_call_date);
            }) 
            ->addColumn('created_by', function ($data) {
                if(isset($data->created_by) && $data->created_by != null){
                    $user = user_info($data->created_by);
                    return $user->name??"-";
                }else{
                    return "-";
                }
                
            }) 
            ->addColumn('serial', function () {
                static $serial = 0;
                return ++$serial;
            })

            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Prospecting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Prospecting $model, Request $request): QueryBuilder {
        if (isset($request->employee) && !empty($request->employee)) {
            $user = User::find($request->employee);
        } else {
            $user = Auth::user();
        }

        if (isset($request->date)) {
            $date       = explode(' - ', $request->date);
            $start_date = date('Y-m-d', strtotime($date[0]));
            $end_date   = date('Y-m-d', strtotime($date[1]));
        } else {
            $start_date = date('Y-m-01');
            $end_date   = date('Y-m-t');
        }

        $user_employee = json_decode($user->user_employee);
        if($user_employee==null){
            $user_employee = [Auth::user()->id];
        }

        if(isset($request->status)){
            if($request->status != 2){
                $model =  $model->where('status', $request->status);
            } 
        }else{
            $model = $model->where('status', 0);
        }

        $prospectings = $model->where(function ($q) use ($user) {
            $q->where('approve_by', '!=', null)
                ->orWhere('employee_id', $user->id)
                ->orWhere('created_by', $user->id);
        })
            ->whereHas('customer', function ($q) use ($user_employee) {
                $q->whereIn('ref_id', $user_employee);
            })
            ->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']) 
            ->with('customer')
            ->newQuery();
        return $prospectings;

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('prospecting-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->pageLength(20)
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('pdf')->title('Prospecting List'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('serial')->title('S/N'),
            Column::make('customer.customer_id')->title('Provable Cus ID'),
            Column::make('customer.name')->title('Customer Name'),
            Column::make('phone')->title('Phone'),
            Column::make('cold_call_date')->title('CC Date'),
            Column::make('created_by')->title('Employee'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string {
        return 'Prospecting_' . date('YmdHis');
    }
}
