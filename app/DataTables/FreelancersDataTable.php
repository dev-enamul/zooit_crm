<?php

namespace App\DataTables;

use App\Models\Freelancer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FreelancersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    { 
        return (new EloquentDataTable($query))->setRowId('id')
        ->addColumn('action',function($data){ 
             return view('freelancer.freelancer_action',compact('data'))->render();
        })
        ->addColumn('serial', function () {
            static $serial = 0;
            return ++$serial;
        })
        ->addColumn('date', function($data){
            return get_date($data->created_at);
        }) 
        ->addColumn('profession', function($data){
            return $data->profession->name??'-';
        })
        ->addColumn('thana', function($data){
            return $data->user->userAddress->upazila->name??"-";
        })
        ->addColumn('union', function($data){
            return $data->user->userAddress->union->name??"-";
        })
        ->addColumn('vilage', function($data){
            return $data->user->userAddress->village->name??"-";
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Freelancer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Freelancer $model): QueryBuilder
    {
        $my_freelancer = my_all_employee(auth()->user()->id);
         $data =  $model
        ->with('user')
        ->whereIn('user_id',$my_freelancer)->where(function($q){
            $q->where('status',1)->orWhereHas('user', function($query){
                $query->Where('approve_by','!=',null)
                ->orWhere('ref_id',auth()->user()->id)
                ->orWhere('created_by',auth()->user()->id);
            });
        })
        ->newQuery();

        return $data;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('employees-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->createdRow('function(row, data, dataIndex) {
                if (data["user"] && data["user"]["approve_by"] === null) {
                    $(row).addClass("table-warning");
                }
            }')
            ->buttons([
                Button::make('excel')->title('Freelancer List'), 
                Button::make('pdf')->title('Freelancer List'), 
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
                  ->searchable(false)
                  ->addClass('text-center'),
            Column::make('serial')->searchable(true),
            Column::make('date'),
            Column::make('user.name')->title('Name')->searchable(true),
            Column::make('profession'),
            Column::make('thana')->title('Thana/Upazila'),
            Column::make('union'), 
            Column::make('vilage'),
            Column::make('user.phone')->title('Mobile')->searchable(true),
            Column::make('user.user_id')->title('FL ID')->searchable(true), 
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Freelancers_' . date('YmdHis');
    }
}
