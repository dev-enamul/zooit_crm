<?php

namespace App\DataTables;

use App\Models\Prospecting;
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

class ProspectingDataTable extends DataTable
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
            ->addColumn('action',function($prospecting){ 
                return view('prospecting.prospecting_action',compact('prospecting'))->render();
            })
            ->addColumn('profession', function($prospecting){
                return $prospecting->customer->profession->name??'-';
            })
            ->addColumn('thana', function($prospecting){
                return $prospecting->customer->user->userAddress->upazila->name??"-";
            })
            ->addColumn('union', function($prospecting){
                return $prospecting->customer->user->userAddress->union->name??"-";
            })
            ->addColumn('vilage', function($prospecting){
                return $prospecting->customer->user->userAddress->village->name??"-";
            })
            ->addColumn('media', function($prospecting){
                return $prospecting->media == 1 ? 'Phone' : ($prospecting->media == 2 ? 'Meet' : '-');

            })
            ->addColumn('phone', function($prospecting){
                return $prospecting->customer->user->phone??"-";
            })
            ->addColumn('fl_id', function($prospecting){
                 return $prospecting->customer->reference->name.' '.$prospecting->customer->reference->user_id??"-";
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Prospecting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Prospecting $model, Request $request): QueryBuilder
    {  
        if(isset($request->employee) && !empty($request->employee)){
            $user_id = (int)$request->employee;
        }else{
            $user_id = Auth::user()->id;
        } 
        if(isset($request->date)){
            $date = explode(' - ',$request->date);
            $start_date = date('Y-m-d',strtotime($date[0]));
            $end_date = date('Y-m-d',strtotime($date[1])); 
        }else{
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-t');
        } 
        $user_employee = my_all_employee($user_id);

        if(isset($request->status) && !empty($request->status)){
            $status = $request->status; 
        }else{
            $status = 0; 
        }

        $prospectings =$model->where(function ($q){
            $q->where('approve_by','!=',null)
                ->orWhere('employee_id', Auth::user()->id)
                ->orWhere('created_by', Auth::user()->id);
        }) 
        ->whereHas('customer', function($q) use($user_employee){ 
            $q->whereIn('ref_id', $user_employee);
        })
        ->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 23:59:59'])
        ->where('status', $status)
        ->with('customer')
        ->newQuery(); 
        return $prospectings;

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                ->setTableId('prospecting-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom('Bfrtip')
                ->orderBy(1)
                ->selectStyleSingle()
                ->buttons([
                    Button::make('excel'), 
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
            Column::make('id')->title('S/N'),
            Column::make('customer.name')->title('Full Name'), 
            Column::make('profession')->title('Profession'),
            Column::make('thana')->title('Thana'),
            Column::make('union')->title('Union'),
            Column::make('vilage')->title('Village'),
            Column::make('media')->title('Media'),
            Column::make('phone')->title('Phone'),
            Column::make('fl_id')->title('FL ID'), 
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Prospecting_' . date('YmdHis');
    }
}
