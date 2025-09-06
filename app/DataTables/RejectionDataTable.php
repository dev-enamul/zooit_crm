<?php

namespace App\DataTables;

use App\Models\Rejection;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RejectionDataTable extends DataTable
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
            return view('rejection.rejection_action', compact('data'))->render();
        })
        ->addColumn('serial', function () {
            static $serial = 0;
            return ++$serial;
        })  
        ->addColumn('date', function ($data) {
            return get_date($data->created_at);
        }) 
        ->addColumn('name', function ($followUp) { 
            $customerName = '';
            if (isset($followUp->customer) && isset($followUp->customer->user)) {
                $customerName = $followUp->customer->user->name. ' ['. $followUp->customer->visitor_id .']';
            }

            $url = route('customer.profile', encrypt($followUp->customer_id));

            return '<a class="text-primary" href="'.$url.'">'.e($customerName).'</a>';
        }) 
        ->addColumn('phone', function ($data) {
            return $data->customer->user->phone ?? "-";
        }) 

        ->addColumn('reject_reason', function ($data) {
            return $data->reject_reason->name ?? "-";
        }) 
        ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Rejection $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Rejection $model, Request $request): QueryBuilder
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
        ->where('status',0)
        ->with('customer.user.userAddress', 'customer.reference', 'customer.profession')
        ->whereHas('customer', function ($q) use ($my_employee) {
            $q->whereIn('ref_id', $my_employee);
        });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Rejection-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->pageLength(20)
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('pdf')->title('Rejection List'),
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
            Column::make('serial')->title('S/N'),
            Column::make('customer.visitor_id')->title('Visitor ID'),
            Column::make('name')->title('Name'),
            Column::make('phone')->title('Phone'), 
            Column::make('reject_reason')->title('Reject Reason'), 
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Rejection_' . date('YmdHis');
    }
}
