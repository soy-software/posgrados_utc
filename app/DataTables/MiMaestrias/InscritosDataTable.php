<?php

namespace App\DataTables\MiMaestrias;

use App\Models\Inscripcion;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InscritosDataTable extends DataTable
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
            ->editColumn('user_id',function($inscri){
                return $inscri->user->apellidos_nombres;
            })
            ->filterColumn('user_id',function($query, $keyword){
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("concat(primer_apellido,' ',segundo_apellido,' ',primer_nombre,' ',segundo_nombre) like ?", ["%{$keyword}%"]);
                });            
            })
            ->editColumn('updated_at',function($inscri){
                return $inscri->user->identificacion;
            })
            ->filterColumn('updated_at',function($query, $keyword){
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("identificacion like ?", ["%{$keyword}%"]);
                });            
            })
            
            ->editColumn('informacionLaborals_id',function($inscri){
                return $inscri->user->email;
            })
            ->filterColumn('informacionLaborals_id',function($query, $keyword){
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("email like ?", ["%{$keyword}%"]);
                });            
            })
            ->editColumn('created_at',function($inscri){
                return $inscri->created_at.' '.$inscri->created_at->diffForHumans();
            })
            ->addColumn('action', function($inscri){
                return view('misMaestrias.accionIncritos',['inscri'=>$inscri])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\MiMaestrias/Inscrito $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Inscripcion $model)
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
                    ->setTableId('mimaestrias-inscritos-table')
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
                  ->addClass('text-center')
                  ->title('Acción'),
            Column::make('updated_at')->title('Identificación'),
            Column::make('user_id')->title('Postulante'),
            Column::make('informacionLaborals_id')->title('Email'),
            // Column::make('informacionAcademicas_id')->title('Factura'),
            Column::make('created_at')->title('Fecha de inscripcion'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MiMaestrias/Inscritos_' . date('YmdHis');
    }
}
