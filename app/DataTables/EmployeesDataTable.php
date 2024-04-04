<?php

namespace App\DataTables;

use App\Models\Designation;
use App\Models\Employee;
use App\Models\ReportingUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
 
use CarlosMeneses\LaravelMpdf\Facades\LaravelMpdf as PDF;
 
 
 
 
 


class EmployeesDataTable extends DataTable
{ 
     
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action',function($employee){
                $data = $employee;
                 return view('employee.employee_action',compact('data'))->render();
            })
            ->addColumn('serial', function () {
                static $serial = 0;
                return ++$serial;
            }) 
            ->addColumn('email', function($employee){
                return $employee->userContact->office_email??$employee->userContact->personal_email??"-";
            }) 
            ->addColumn('designation', function($employee){
                $designations = json_decode($employee->employee->designations);
                $des = '';
                if(isset($designations) && is_array($designations) && count($designations)>0){ 
                    foreach($designations as $key => $des_id){
                        $designation = Designation::find($des_id);
                        if(isset($designation) && $designation != null){
                            if($key > 0)
                                $des .= ', '.$designation->title;
                            else
                                $des = $designation->title;
                        } 
                    } 
                } 
                return $des;
            })
            ->addColumn('area', function($employee){
                return  $employee?->userAddress?->area?->name??"-";
            })
            ->addColumn('reporting', function($employee){
                // $reporting_user_id = user_reporting($employee->id);
                $data = ReportingUser::where('user_id',$employee->id)->where('statis',1)->latest()->first();
                // if(isset($reporting_user_id) && $reporting_user_id != null){
                //     $data = user_info($reporting_user_id);
                //     if(isset($data) && $data != null){
                //         $reporting_user = $data['name'].' ('.$data['user_id'].')';
                //     }else{
                //         $reporting_user = "-";
                //     } 
                // }else{
                //     $reporting_user = "-";
                // }
                // return $reporting_user_id; 
                return $data->id??"-";
            });
            
    }

    
    public function query(User $model): QueryBuilder
        {
            return $model->newQuery()
            ->where('user_type', 1)
            ->where('status', 1)
            ->orderBy('serial', 'asc');
        }

   
    public function html(): HtmlBuilder
        {
            return $this->builder()
                        ->setTableId('employees-table')
                        ->columns($this->getColumns())
                        ->minifiedAjax()
                        ->pageLength(20)
                        ->dom('Bfrtip')
                        ->orderBy(1)
                        ->selectStyleSingle()
                        ->buttons([
                            Button::make('excel')->title('Employee List'), 
                            // Button::make('pdf')->title('Employee List'), 
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
                Column::make('serial')->title('S/N')->exportable(true), 
                Column::make('user_id')->title('Emp ID')->searchable(true),
                Column::make('name')->title('Name')->searchable(true), 
                Column::make('phone')->searchable(true),
                Column::make('email'),
                Column::make('designation'), 
                Column::make('area'),
                Column::make('reporting')->title('Reporting Name & ID'),
            ];
        }
 
    protected function filename(): string
        {
            return 'Employees_' . date('YmdHis');
        }
}
