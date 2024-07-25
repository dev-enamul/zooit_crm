<?php

namespace App\DataTables;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LeadDataTable extends DataTable {
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($lead) {
                return view('lead.lead_action', compact('lead'))->render();
            }) 
            ->addColumn('phone', function ($data) {
                return $data->customer->user->phone ?? "-";
            })

            ->addColumn('created_by', function ($data) { 
                if(isset($data->employee_id) && $data->employee_id != null){
                    $user = user_info($data->employee_id);
                    return $user->name.' ['.$user->id.']';
                }else{
                    return "-";
                }
            })

            ->addColumn('presentation_date', function ($data) {
                return get_date($data->presentation_date);
            })
            
            ->addColumn('serial', function () {
                static $serial = 0;
                return ++$serial;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Lead $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Lead $model, Request $request): QueryBuilder {
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
        if($user_employee == null){
            $user_employee = [Auth::user()->id];
        }

        if(isset($request->status) && $request->status != 2){
            $model->where('status', $request->status);
        }  

        $datas = $model->where(function ($q) {
            $q->where('approve_by', '!=', null)
                ->orWhere('employee_id', Auth::user()->id)
                ->orWhere('created_by', Auth::user()->id);
        })
            ->whereHas('customer', function ($q) use ($user_employee) {
                $q->whereIn('ref_id', $user_employee);
            })
            ->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']) 
            ->with('customer.reference')
            ->with('customer.user.userAddress')
            ->with('customer.profession')
            ->newQuery();
        return $datas;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('lead-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->pageLength(20)
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('pdf')->title('Lead List'),
            ]);
    }
    public function getColumns(): array {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('serial')->title('S/L'),
            Column::make('customer.customer_id')->title('Provable Cus ID'),
            Column::make('customer.name')->title('Customer Name'),
            Column::make('phone')->title('Mobile Number'),
            Column::make('created_by')->title('Employee'),
            Column::make('presentation_date')->title('Presentation Date'),
           

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string {
        return 'Lead_' . date('YmdHis');
    }
}
