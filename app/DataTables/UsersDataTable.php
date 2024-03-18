<?php

namespace App\DataTables;

use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{ 
 
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))->setRowId('id')
        ->addColumn('action', function($user){
            return '
                <div class="dropdown">
                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="rounded avatar-2xs p-0" src="'.$user->image().'">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                        <li><a class="dropdown-item" href="/users/'.$user->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                   
                    </ul>
                </div>
            ';
        });
    }

   
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }
 
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['pdf', 'excel'],
                    ]);
    }

     
    public function getColumns(): array
    {
        return [
            Column::make('action'),
            Column::make('id'),
            Column::make('name'),
            Column::make('phone')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_'.date('YmdHis');
    }
}
