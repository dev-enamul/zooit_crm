<?php

namespace App\DataTables;

use App\Models\Deposit;
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

class DepositDataTable extends DataTable
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
            ->addColumn('serial', function () {
                static $serial = 0;
                return ++$serial;
            })
            
            ->addColumn('invoice_id', function ($data) { 
                return "INVOICE# ".$data->invoice_id;
            }) 

            ->addColumn('name', function ($data) {
                if(@$data->user->userContact->type==2){
                    $name = $data->user->userContact->name." (". $data->user->name .") ";
                }else{
                    $name = $data->user->name;
                }
                return $name;
            }) 

            ->addColumn('amount', function ($data) { 
                return get_price($data->amount);
            })  
            ->addColumn('bank', function ($data) { 
                return $data->bank->name;
            }) 

            ->addColumn('date', function ($data) {
                return get_date($data->created_at);
            })  
              
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Deposit $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Deposit $model): QueryBuilder
        {
            if (isset($request->date)) {
                $date       = explode(' - ', $request->date);
                $start_date = date('Y-m-d', strtotime($date[0]));
                $end_date   = date('Y-m-d', strtotime($date[1]));
                $model      = $model->whereBetween('date', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
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

            if (isset($request->status) && $request->status !=2) {
                $model->where('status',$request->status);
            }

            return $model->newQuery()
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
                        ->setTableId('deposit-table')
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
            Column::make('serial'),  
            Column::make('name')->title("Customer"), 
            Column::make('invoice_id'),
            Column::make('amount'),
            Column::make('bank'),
            Column::make('date'), 
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Deposit_' . date('YmdHis');
    }
}
