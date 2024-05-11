<?php

namespace App\DataTables;

use App\Models\Freelancer;
use App\Models\ReportingUser;
use App\Models\User;
use Carbon\Carbon;
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
            $reporting = json_decode($freelancer->user->user_reporting);
            if(isset($reporting) && $reporting!= null){
                $user = User::whereIn('id',$reporting)->whereHas('employee',function($q){
                    $q->whereIn('designation_id',[12, 13, 14, 15]);
                })->first();
                if(isset($user) && $user != null){
                    return $user->name.' ['.$user->user_id.']';
                }
            }
            return "-";
        })
        ->addColumn('area_incharge', function($freelancer){
            $reporting = json_decode($freelancer->user->user_reporting);
            if(isset($reporting) && $reporting!= null){
                $user = User::whereIn('id',$reporting)->whereHas('employee',function($q){
                    $q->whereIn('designation_id',[11]);
                })->first();
                if(isset($user) && $user != null){
                    return $user->name.' ['.$user->user_id.']';
                }
            }
            return "-";
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
        if(isset($request->status) && $request->status != 0){
            $model = $model->where('created_at','<',Carbon::parse('2024-03-30'));
        }else{
            $model = $model->where('created_at','>',Carbon::parse('2024-03-30'));
            if(isset($request->date)){
                $date = explode(' - ',$request->date);
                $start_date = date('Y-m-d',strtotime($date[0]));
                $end_date = date('Y-m-d',strtotime($date[1]));
                $model = $model->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 23:59:59']);
            }else{
                $model = $model->whereBetween('created_at',[date('Y-m-01').' 00:00:00',date('Y-m-t').' 23:59:59']);
            }
        }

        $user = User::find(auth()->user()->id);
        $is_admin = $user->hasPermission('admin');
        if(!$is_admin){
            if(isset($request->employee)){
                $filter_user = User::find($request->employee);
                $my_freelancer = json_decode($filter_user->user_employee);
                $model = $model->whereIn('user_id',$my_freelancer);
            }else{
                $my_freelancer = json_decode($user->user_employee);
                $model = $model->whereIn('user_id',$my_freelancer);
            }

            $model =  $model
            ->where(function($q){
                $q->where('freelancers.status',1)->orWhereHas('user', function($query){
                    $query->Where('approve_by','!=',null)
                    ->orWhere('ref_id',auth()->user()->id)
                    ->orWhere('created_by',auth()->user()->id);
                });
            });

        }


        $data =  $model->with('user')
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
            ->pageLength(20)
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
//            ->createdRow('function(row, data, dataIndex) {
//                if (data["user"] && data["user"]["approve_by"] === null) {
//                    $(row).addClass("table-warning");
//                }
//            }')
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
        return 'Freelancers_' . date('YmdHis');
    }
}
