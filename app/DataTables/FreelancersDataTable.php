<?php

namespace App\DataTables;

use App\Models\Freelancer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
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
        })
        ->addColumn('fl_id', function($data){
            if($data->status==1){
                return $data->user->user_id;
            }else{
                return '-';
            } 
        })
        ->addColumn('reporting', function($freelancer){
            $reporting_user_id = @user_reporting($freelancer->user->id)[1];
            if(isset($reporting_user_id) && $reporting_user_id != null){
                $data = user_info($reporting_user_id);
                if(isset($data) && $data != null){
                    $reporting_user = $data['name'].' ('.$data['user_id'].')';
                }else{
                    $reporting_user = "-";
                } 
            }else{
                $reporting_user = "-";
            }
            return $reporting_user; 
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Freelancer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Freelancer $model, Request $request): QueryBuilder 
    {
        if(isset($request->date)){
            $date = explode(' - ',$request->date);
            $start_date = date('Y-m-d',strtotime($date[0]));
            $end_date = date('Y-m-d',strtotime($date[1]));
            $model = $model->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 23:59:59']);
        } 

        if(isset($request->employee)){
            $my_freelancer = my_all_employee((int)$request->employee);
        }else{
            $my_freelancer = my_all_employee(auth()->user()->id);
        }
         $data =  $model
        ->with('user')
        ->whereIn('user_id',$my_freelancer)
        ->where(function($q){
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
            Column::make('serial')->title('S/L')->searchable(true),
            Column::make('user.user_id')->visible(false)->searchable(true), 
            Column::make('fl_id'),
            Column::make('user.name')->title('Name')->searchable(true),
            Column::make('profession'),
            Column::make('thana')->title('Thana/Upazila'),
            Column::make('union'), 
            Column::make('vilage'),
            Column::make('user.phone')->title('Mobile')->searchable(true),  
            Column::make('reporting')->title('Reporting'),
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
