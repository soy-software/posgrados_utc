<?php

namespace App\DataTables;

use App\Models\Paralelo;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ParalelosDataTable extends DataTable
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
            ->addColumn('action', function($paralelo){
                return view('paralelos.accion',['paralelo'=>$paralelo])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Paralelo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Paralelo $model)
    {
        return $model->newQuery()->where('cohorte_id',$this->idCohorte);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('paralelos-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('nombre'),
            Column::make('fecha_inicio'),
            Column::make('fecha_fin'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Paralelos_' . date('YmdHis');
    }
}
