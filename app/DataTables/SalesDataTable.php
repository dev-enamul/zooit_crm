<?php

namespace App\DataTables;

use App\Models\Customer;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column; 
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;

class SalesDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($data){
                return view('salse.salse_action', compact('data'))->render();
            })
            ->addIndexColumn() // replaces manual serial
            ->addColumn('cus_id', function($data){
                return $data->customer_id ?? '';
            })
            ->addColumn('name', function($data){ 
                $customerName = $data->user->name. ' ['. $data->visitor_id .']'; 
                $url = route('customer.profile', encrypt($data->id)); 
                return '<a class="text-primary" href="'.$url.'">'.e($customerName).'</a>';

            })
            ->addColumn('phone', function($data){
                return $data->user->phone ?? '';
            })
            ->addColumn('service', function($data){
                return $data->service->service ?? '';
            })
            ->addColumn('price', function($data){
                return get_price($data->project->price ?? 0, $data->project->currency ?? 'bdt');
            })
            ->addColumn('paid', function($data){ 
                if($data->project)
                return get_price($data->project->paid ?? 0, $data->project->currency ?? 'bdt');
            })
            ->addColumn('submit_date', function($data){
                return get_date($data->project->submit_date ?? '');
            })
            ->rawColumns(['name','action']); 
    }

    public function query(Customer $model, Request $request)
    {
        $query = $model->with(['user','service','project'])
                       ->whereNotNull('customer_id');

        if($request->filled('employee')){
            $query->whereHas('user', function($q) use ($request){
                $q->where('id', $request->employee);
            });
        }

        if($request->filled('date')){
            $dates = explode(' - ', $request->date);
            $start_date = date('Y-m-d', strtotime($dates[0]));
            $end_date = date('Y-m-d', strtotime($dates[1]));
            $query->whereBetween('created_at', [$start_date.' 00:00:00', $end_date.' 23:59:59']);
        }

        return $query;
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('sales-table')
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

    protected function getColumns(): array
    {
        return [
            Column::computed('action')->exportable(false)->printable(false)->width(60)->addClass('text-center'),  
            Column::make('name'),
            Column::make('phone'),
            Column::make('service'),
            Column::make('price'),
            Column::make('paid'),
            Column::make('submit_date')->title('Submit Date'),
        ];
    }

    protected function filename(): string
    {
        return 'Sales_' . date('YmdHis');
    }
}
