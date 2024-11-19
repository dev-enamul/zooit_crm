<?php

namespace App\DataTables;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CustomersDataTable extends DataTable {
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($data) {
                return view('customer.customer_action', compact('data'))->render();
            })
            ->addColumn('serial', function () {
                static $serial = 0;
                return ++$serial;
            })  
            ->addColumn('project', function ($data) { 
                return $data->project->name??"-";
            })
            ->addColumn('sub_project', function ($data) { 
                return $data->sub_project->name??"-";
            })   
            ->addColumn('created_by', function ($data) { 
                if(isset($data->created_by) && $data->created_by!=null){
                    $user = user_info($data->created_by);
                    return $user->name.' ['.$user->user_id.']';
                }else{
                    return "-";
                }
            })      
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model, Request $request): QueryBuilder {
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

        if (!is_array($my_employee)) {
            $my_employee = [Auth::user()->id]; 
        } 

        if(isset($request->status)){
            if($request->status != 2){
                $model =  $model->where('status', $request->status);
            } 
        }else{
            $model = $model->where('status', 0);
        }

        return $model->newQuery()
            ->whereIn('ref_id', $my_employee) 
            ->with(['reference', 'user', 'profession', 'user.userAddress.village', 'user.userAddress.union', 'user.userAddress.upazila']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('customers-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->pageLength(20)
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('pdf')->title('Customer List'),
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
                ->addClass('text-center'),
            Column::make('serial')->title('S/L'),
            Column::make('customer_id')->title('Provable CUS ID')->searchable(true),
            Column::make('user.name')->title('Company Name')->searchable(true),
            Column::make('user.phone')->title('Phone Number')->searchable(true),  
            Column::make('project')->title('Product'), 
            Column::make('sub_project')->title('Sub Product'), 
            Column::make('created_by')->title('Created By'), 
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string {
        return 'Customers_' . date('YmdHis');
    }
}
