<?php

namespace App\DataTables;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column; 
use Yajra\DataTables\Services\DataTable; 
use Illuminate\Http\Request;

class InvoiceDataTable extends DataTable
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
                return view('invoice.invoice_action', compact('data'))->render();
            })
            ->addColumn('invoice_id', function ($data) {
                return "INV-".$data->id;
            })
            ->addColumn('name', function ($data) {  
                if($data->user->userContact->type==2){
                    $name = $data->user->userContact->name." (". $data->user->name .") ";
                }else{
                    $name = $data->user->name;
                }
                return $name." [".$data->customer->customer_id."]";
            }) 
            ->addColumn('total_amount', function ($data) {
                return get_price($data->total_amount);
            })
            ->addColumn('due_amount', function ($data) { 
                return get_price($data->due_amount);
            }) 
            ->addColumn('invoice_date', function ($data) { 
                return get_date($data->invoice_date);
            }) 
            ->addColumn('due_date', function ($data) { 
                return get_date($data->due_date);
            }) 
            ->addColumn('status', function ($data) { 
                if ($data->status == 0) {
                    return '<span class="badge badge-warning">Unpaid</span>';
                } else {
                    return '<span class="badge badge-success">Paid</span>';
                }
            })->rawColumns(['status','action']) 
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Invoice $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Invoice $model, Request $request): QueryBuilder
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

        if (isset($request->status)) {
            if ($request->status == "unpaid") { 
                $model = $model->where('status', 0); 

            } elseif ($request->status == "partial") { 
                $model = $model->where('due_amount', '>', 0)
                               ->where('due_amount', '<', DB::raw('total_amount')); 

            } elseif ($request->status == "paid") { 
                $model = $model->where('status', 1); 

            } elseif ($request->status == "overdue") { 
                $model = $model->where('status', 0)  
                               ->where('due_date', '<', now()) 
                               ->where('due_amount', '>', 0);   
                               
            }
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
                    ->setTableId('invoice-table')
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
            Column::make('invoice_id'),  
            Column::make('name')->title("Customer"), 
            Column::make('total_amount'),
            Column::make('due_amount'), 
            Column::make('invoice_date'), 
            Column::make('due_date'),
            Column::make('status')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Invoice_' . date('YmdHis');
    }
}
