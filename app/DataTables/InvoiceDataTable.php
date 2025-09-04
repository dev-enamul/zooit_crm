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
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($data) {
                return view('invoice.invoice_action', compact('data'))->render();
            })
            ->addColumn('invoice_id', function ($data) {
                return '<a target="_blank" href="'.route('invoice.show', encrypt($data->id)).'" class="text-primary">INV-'.$data->id.'</a>';
            })
            ->addColumn('name', function ($data) {  
                $name = $data->user->name ." ".$data?->user?->userContact?->name??''; 
                $customerLink = '<a href="'.route('customer.profile', encrypt($data->customer->id)).'">'.$name.' ['.$data->customer->customer_id.']</a>';
                return $customerLink;
            })
            ->addColumn('total_amount', function ($data) {
                $currency = @$data->project->currency ?? 'bdt'; 
                if($currency == 'usd'){
                    $price = get_price($data->total_amount_usd, $currency) 
                            . ' = ' . $data->total_amount_usd 
                            . ' x ' . $data->usd_rate 
                            . ' = ' . get_price($data->total_amount);
                } else {
                    $price = get_price($data->total_amount);
                }

                return $price;
            })

            ->addColumn('due_amount', function ($data) { 
                return get_price($data->due_amount);
            })

            ->addColumn('notify', function ($data) { 
                if ($data->due_amount <= 0) {
                    return "-";
                }

                if ($data->notification_count > 0) {
                    $date = $data->last_notification_date 
                        ? \Carbon\Carbon::parse($data->last_notification_date)->diffForHumans()
                        : '-';
                    return $date . ' (' . $data->notification_count . ')';
                }

                return "No";
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
                } elseif($data->status == 1) {
                    return '<span class="badge badge-success">Paid</span>';
                }else{
                    return '<span class="badge badge-info">Partial</span>';
                }
            })->rawColumns(['name','invoice_id','status','action']) 
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

        if(isset($request->project_id) && $request->project_id != null){
            $model = $model->where('project_id', $request->project_id);
        }
       
        return $model->latest()->newQuery();
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
            Column::make('notify'), 
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
