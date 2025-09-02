<?php

namespace App\DataTables;

use App\Models\Designation;
use App\Models\Employee;
use App\Models\ReportingUser;
use App\Models\User;
use App\Models\WorkTime;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
 
use CarlosMeneses\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ->addColumn('employee', function ($employee) {
                $name = $employee->name.' ['.$employee->user_id.']';
                return $name;
            })  
            ->addColumn('designation', function($employee){
                 
                return $employee->employee->designation->title??"-";
            })
            ->addColumn('area', function($employee){
                return  $employee?->userAddress?->area?->name??"-";
            })
            ->addColumn('working', function($employee) {
                $workTime = WorkTime::where('user_id', $employee->id)
                            ->whereDate('created_at', date('Y-m-d'))
                            ->whereNull('end_time')
                            ->latest()
                            ->first();

                if ($workTime) {
                    $taskTitle = $workTime->task->title ?? 'Unknown Task';
                    $projectTitle = $workTime->project->title ?? 'Unknown Project'; 
                    return '<i class="fas fa-check-circle text-success"></i> ' . "{$taskTitle} [{$projectTitle}]";
                }

                // Red cross icon for not working
                return '<i class="fas fa-times-circle text-danger"></i> Free now';
            })


            ->addColumn('reporting', function($employee){ 
                if($employee->id==187){
                    return "-";
                } 
                $data = ReportingUser::where('user_id',$employee->id)->where('status',1)->latest()->first();
                if(isset($data->id) && $data->id !=null){
                    $reporting = ReportingUser::find($data->reporting_user_id);
                    $user = User::find($reporting?->user_id);
                    if(isset($user) && $user != null){
                        return $user->name.' ['.$user->user_id.']';
                    }else{
                        return "-";
                    }

                }else{
                    return "-";
                }
                return $data->id??"-";
            })
            ->rawColumns(['working', 'action']);;
            
    }

    
    public function query(User $model, Request $request): QueryBuilder
        {
            $is_admin = Auth::user()->hasPermission('admin');

            // if(!$is_admin){
            //     $my_freelancer = json_decode(Auth::user()->user_employee);
            //     if(auth()->user()->id!=1){
            //         $model = $model->whereIn('id',$my_freelancer);
            //     }
            // }
            

            if($request->designation){
                $model = $model->whereHas('employee', function($query) use ($request){
                    $query->where('designation_id', $request->designation);
                });
            }
            

            return $model->newQuery()
            ->where('user_type', 1)
            ->with('employee')
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
                            Button::make('pdf')->title('Employee List'), 
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
                // Column::make('serial')->title('S/N')->exportable(true),  
                Column::make('employee')->title('Employee')->searchable(true), 
                Column::make('phone')->searchable(true), 
                Column::make('working')->searchable(true),
                Column::make('designation'),  
                Column::make('reporting')->title('Reporting Name & ID'),
            ];
        }
 
    protected function filename(): string
        {
            return 'Employees_' . date('YmdHis');
        }
}
