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
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LeadDataTable extends DataTable
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
            ->addColumn('action',function($lead){ 
                return view('lead.lead_action',compact('lead'))->render();
            })

            ->addColumn('date', function($data){
                return get_date($data->created_at);
            })
            
            ->addColumn('profession', function($data){
                return $data->customer->profession->name??'-';
            })
            ->addColumn('thana', function($data){
                return $data->customer->user->userAddress->upazila->name??"-";
            })
            ->addColumn('union', function($data){
                return $data->customer->user->userAddress->union->name??"-";
            })
            ->addColumn('vilage', function($data){
                return $data->customer->user->userAddress->village->name??"-";
            })
           
            ->addColumn('project', function($data){
                return $data->project->name??'-';
            })
            ->addColumn('unit', function($data){
                return $data->unit->name??'-';
            }) 
            ->addColumn('phone', function($data){
                return $data->customer->user->phone??"-";
            })
            ->addColumn('fl_id', function($data){
                 return $data->customer->reference->name.' '.$data->customer->reference->user_id??"-";
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
    public function query(Lead $model, Request $request): QueryBuilder
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
        $user = User::find($user_id);
        $user_employee = json_decode($user->user_employee);

        if(isset($request->status) && !empty($request->status)){
            $status = $request->status; 
        }else{
            $status = 0; 
        }

        $datas =$model->where(function ($q){
            $q->where('approve_by','!=',null)
                ->orWhere('employee_id', Auth::user()->id)
                ->orWhere('created_by', Auth::user()->id);
        }) 
        ->whereHas('customer', function($q) use($user_employee){ 
            $q->whereIn('ref_id', $user_employee);
        })
        ->whereBetween('created_at',[$start_date.' 00:00:00',$end_date.' 23:59:59'])
        ->where('status', $status)
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
    public function html(): HtmlBuilder
    {
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
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('serial')->title('S/L'),
            Column::make('date')->title('Date'), 
            Column::make('customer.name')->title('Customer Name'),
            Column::make('profession')->title('Profession'), 
            Column::make('thana')->title('Thana'),
            Column::make('union')->title('Union'),
            Column::make('vilage')->title('Vilage'), 
            Column::make('project')->title('Project'),
            Column::make('unit')->title('Unit'),
            Column::make('phone')->title('Phone'),
            Column::make('fl_id')->title('Freelancer Name & ID'),
           
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Lead_' . date('YmdHis');
    }
}
