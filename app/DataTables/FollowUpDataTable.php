<?php

namespace App\DataTables;

use App\Models\FollowUp;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FollowUpDataTable extends DataTable {
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($followUp) {
                return view('followup.followup_action', compact('followUp'))->render();
            })

            ->addColumn('created_by', function ($followUp) {
                if(isset($followUp->employee_id) && $followUp->employee_id != null){
                    $user = user_info($followUp->employee_id);
                    return $user->name.' ['.$user->user_id.']';
                }else{
                    return "-";
                }
            })

            ->addColumn('followup_date', function ($followUp) {
                return get_date($followUp->next_followup_date);
            }) 

            ->addColumn('purchase_possibility', function ($followUp) {
                return $followUp->purchase_possibility."%";
            })  

            ->addColumn('name', function ($followUp) {
                if($followUp->customer->user->userContact->type==2){
                    $name = $followUp->customer->user->userContact->name." (". $followUp->customer->user->name .") ";
                }else{
                    $name = $followUp->customer->user->name;
                }
                return $name;
            })
 
            ->addColumn('serial', function () {
                static $serial = 0;
                return ++$serial;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FollowUp $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    
     public function query(FollowUp $model, Request $request): QueryBuilder
        {
            if (isset($request->employee) && !empty($request->employee)) {
                $user_id = (int) $request->employee;
            } else {
                $user_id = Auth::user()->id;
            }

            if (isset($request->date)) {
                $date       = explode(' - ', $request->date);
                $start_date = date('Y-m-d', strtotime($date[0]));
                $end_date   = date('Y-m-d', strtotime($date[1]));
            } else {
                $start_date = date('Y-m-01');
                $end_date   = date('Y-m-t');
            }

            $user          = User::find($user_id);
            $user_employee = json_decode($user->user_employee);
            if ($user_employee == null) {
                $user_employee = [Auth::user()->id];
            } 
            $datas = $model
                ->select('follow_ups.*')
                ->where('status',0)
                ->where(function ($q) {
                    $q->where('approve_by', '!=', null)
                        ->orWhere('employee_id', Auth::user()->id)
                        ->orWhere('created_by', Auth::user()->id);
                })
                ->whereHas('customer', function ($q) use ($user_employee) {
                    $q->whereIn('ref_id', $user_employee);
                })
                ->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
                ->with(['customer.reference', 'customer.user.userAddress', 'customer.profession'])
                ->join(
                    DB::raw('(SELECT MAX(id) as latest_id FROM follow_ups GROUP BY customer_id) latest'),
                    'follow_ups.id',
                    '=',
                    DB::raw('latest.latest_id')
                )
                ->orderBy('next_followup_date', 'asc')  
                ->newQuery();

            $datas->user_reporting = $user->user_reporting;
            return $datas;
        }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('leadanalysis-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('pdf')->title('Lead List'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->sortable(false),
            Column::make('serial')->title('S/L')->sortable(false),
            Column::make('customer.visitor_id')->title('Visitor')->sortable(false),
            Column::make('name')->title('Name')->sortable(false),
            Column::make('customer.user.phone')->title('Phone')->sortable(false), 
            // Column::make('created_by')->title('Employee')->sortable(false), 
            Column::make('followup_date')->title('Next Followup')->sortable(false), 
            Column::make('purchase_possibility')->title('Possibility')->sortable(false), 
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string {
        return 'FollowUp_' . date('YmdHis');
    }
}
