<?php

namespace App\DataTables;

use App\Models\Cohorte;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CohortesDataTable extends DataTable
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
            ->addColumn('action', function($cohorte){
                return view('cohortes.accion',['cohorte'=>$cohorte])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Cohorte $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Cohorte $model)
    {
        return $model->newQuery()->where('maestria_id',$this->idMaestria)->orderBy('numero','desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('cohortes-table')
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
                  ->title('Acción')
                  ->addClass('text-center'),
            Column::make('numero')->title('Número'),
            Column::make('sede'),
            Column::make('modalidad'),
            Column::make('paralelo'),
            Column::make('estado')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Cohortes_' . date('YmdHis');
    }
}
