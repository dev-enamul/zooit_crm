<?php

namespace App\DataTables;

use App\Models\ApproveFreelaner;
use App\Models\Freelancer;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ApproveFreelanerDataTable extends DataTable
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
             return view('freelancer.approve_freelancer_action',compact('data'))->render();
        })
        ->addColumn('serial', function () {
            static $serial = 0;
            return ++$serial;
        })
        ->addColumn('date', function($data){
            return get_date($data->created_at);
        })
        ->addColumn('area', function($data){
            return $data->user->userAddress->area->name??"-";
        })
        ->addColumn('fl_id', function($data){
            return $data->user->user_id;
        })
        ->addColumn('reporting', function($freelancer){
            $reporting = json_decode($freelancer->user->user_reporting);
            if(isset($reporting) && $reporting!= null){
                $user = User::whereIn('id',$reporting)->whereHas('freelancer',function($q){
                    $q->whereIn('designation_id',[18]);
                })->first();
                if(isset($user) && $user != null){
                    return $user->name.' ['.$user->user_id.']';
                }
            }
            return "-";
        })

        ->addColumn('ex_co_ordinator', function($freelancer){
            $reporting = json_decode($freelancer->user->user_reporting);
            if(isset($reporting) && $reporting!= null){
                $user = User::whereIn('id',$reporting)->whereHas('freelancer',function($q){
                    $q->whereIn('designation_id',[17]);
                })->first();
                if(isset($user) && $user != null){
                    return $user->name.' ['.$user->user_id.']';
                }
            }
            return "-";
        })

        ->addColumn('incharge', function($freelancer){
          return  inChargeEmployee(json_decode($freelancer->user->user_reporting));
        })

        ->addColumn('area_incharge', function($freelancer){
         return   areaInChargeEmployee(json_decode($freelancer->user->user_reporting));
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Freelancer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Freelancer $model) :QueryBuilder
    { 
        $my_employee = my_employee(auth()->user()->id);
        $is_admin = auth()->user()->hasPermission('admin');
        if($is_admin){
            $datas = $model->where('status',0)->with('user')->newQuery();
        }else{
            $datas = $model->where('status',0)->whereIn('last_approve_by',$my_employee)->with('user')->newQuery();
        }  
        return $datas;
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
            ->pageLength(20)
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
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
            Column::make('user.phone')->title('Mobile')->searchable(true),
            Column::make('reporting')->title('Co-Ordinator Name_ID'),
            Column::make('ex_co_ordinator')->title('Executive Co-Ordinator Name_ID'),
            Column::make('incharge')->title('InCharge Sales'),
            Column::make('area_incharge')->title('Area InCharge'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'ApproveFreelaner_' . date('YmdHis');
    }
}
