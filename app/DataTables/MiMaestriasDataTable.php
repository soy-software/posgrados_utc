<?php

namespace App\DataTables;

use App\Models\Cohorte;
use App\Models\CohorteCoordinador;
use App\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MiMaestriasDataTable extends DataTable
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
            ->editColumn('maestria_id',function($coh){
                return $coh->maestria->nombre;
            })
            ->filterColumn('maestria_id',function($query, $keyword){
                $query->whereHas('maestria', function($query) use ($keyword) {
                    $query->whereRaw("nombre like ?", ["%{$keyword}%"]);
                });            
            })
            ->addColumn('action', function($coh){
                return view('misMaestrias.accion',['coh'=>$coh]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\MiMaestria $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Cohorte $model)
    {
        $model=Auth::user()->cohortesCoordinador();
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('mimaestrias-table')
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
            Column::make('maestria_id')->title('Maestría'),
            Column::make('numero')->title('Cohorte'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MiMaestrias_' . date('YmdHis');
    }
}
