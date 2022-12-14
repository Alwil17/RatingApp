<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
            return datatables()
                ->eloquent($query)
                ->addColumn('edit', function ($user) {
                    return '<a href="' . route('users.edit', $user->id) . '" class="btn btn-xs btn-warning btn-block">Modifier</a>';
                })
                ->addColumn('destroy', function ($user) {
                    return '<a href="' . route('users.destroy.alert', $user->id) . '" class="btn btn-xs btn-danger btn-block ' . ($user->ratings->count() ? 'disabled' : '') .'">Supprimer</a>';
                })
                ->rawColumns(['edit', 'destroy']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->where('id', ">", 1)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->orderBy(0, 'DESC')
            ->lengthMenu()
            ->language('//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('lastname')->title('Nom'),
            Column::make('firstname')->title('Prenoms'),
            Column::make('pseudo')->title('Pseudo'),
            Column::make('type')->title('Type'),
            Column::make('email')->title('Email'),
            Column::make('phone')->title('Tel'),
            Column::computed('edit')
                ->title('')
                ->width(60)
                ->addClass('text-center'),
            Column::computed('destroy')
                ->title('')
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
