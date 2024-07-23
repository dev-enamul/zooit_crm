<?php

namespace App\DataTables;

use App\Models\Presentation;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PresentationDataTable extends DataTable {
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($presentation) {
                return view('presentation.presentation_action', compact('presentation'))->render();
            }) 

            ->addColumn('created_by', function ($presentation) {
                if(isset($presentation->employee_id) && $presentation->employee_id != null){
                    $user = user_info($presentation->employee_id);
                    return @$user->name.' ['. @$user->user_id.']';
                }else{
                    return "-";
                } 
            }) 

            ->addColumn('followup_date', function ($presentation) { 
                return get_date($presentation->followup_date);
            }) 
         
            ->addColumn('serial', function () {
                static $serial = 0;
                return ++$serial;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Presentation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Presentation $model, Request $request): QueryBuilder {
        if (isset($request->employee) && !empty($request->employee)) {
            $user_id = (int) $request->employee;
        } else {
            $user_id = Auth::user()->id;
        } 

        if (isset($request->date)) {
            $date       = explode(' - ', $request->date);
            $start_date = date('Y-m-d', strtotime($date[0]));
            $end_date   = date('Y-m-d', strtotime($date[1]));
        } else {
            $start_date = date('Y-m-01');
            $end_date   = date('Y-m-t');
        } 

        $user          = User::find($user_id);
        $user_employee = json_decode($user->user_employee);
        if($user_employee==null){
            $user_employee = [Auth::user()->id];
        }

         
        if(isset($request->status) && $request->status != 2){
            $model->where('status', $request->status);
        }  

        $datas = $model->where(function ($q) {
            $q->where('approve_by', '!=', null)
                ->orWhere('employee_id', Auth::user()->id)
                ->orWhere('created_by', Auth::user()->id);
            })
            ->whereHas('customer', function ($q) use ($user_employee) {
                $q->whereIn('ref_id', $user_employee);
            })
            ->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']) 
            ->with('customer.reference')
            ->with('customer.user.userAddress')
            ->with('customer.profession')
            ->newQuery();

        $datas->user_reporting = $user->user_reporting;
        return $datas;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('leadanalysis-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('pdf')->title('Lead List'),
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
            Column::make('serial')->title('S/L'),
            Column::make('customer.customer_id')->title('Provable Cus ID'),
            Column::make('customer.name')->title('Customer Name'),
            Column::make('customer.user.phone')->title('Mobile Number'),  
            Column::make('created_by')->title('Employee'),  
            Column::make('followup_date')->title('Followup Date'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string {
        return 'Presentation_' . date('YmdHis');
    }
}
