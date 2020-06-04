<?php

namespace App\DataTables;

use App\Models\Admision;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ValidarMatriculaDataTable extends DataTable
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
            ->editColumn('inscripcion_id',function($adm){
                return $adm->user->identificacion;
            })
            ->filterColumn('inscripcion_id',function($query, $keyword){
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("identificacion like ?", ["%{$keyword}%"]);
                });            
            })
            ->editColumn('user_id',function($adm){
                return $adm->user->apellidos_nombres;
            })
            ->filterColumn('user_id',function($query, $keyword){
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("concat(primer_apellido,' ',segundo_apellido,' ',primer_nombre,' ',segundo_nombre) like ?", ["%{$keyword}%"]);
                });            
            })
            ->editColumn('cohorte_id',function($adm){
                return $adm->user->email;
            })
            ->filterColumn('cohorte_id',function($query, $keyword){
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("email like ?", ["%{$keyword}%"]);
                });            
            })
            ->editColumn('estado',function($adm){
                if($adm->estado=='Aprobado'){
                    return '<span class="badge badge-pill badge-success">'.$adm->estado.'</span>';
                }else{
                    return '<span class="badge badge-pill badge-danger">'.$adm->estado.'</span>';
                }
                
            })
            ->editColumn('estado_factura',function($adm){
                if($adm->estado_factura=='Validado'){
                    return '<span class="badge badge-pill badge-success">'.$adm->estado_factura.'</span>';
                }else{
                    return '<span class="badge badge-pill badge-danger">'.$adm->estado_factura.'</span>';
                }
            })
            ->addColumn('action', function($admi){
                return view('validarMatriculas.accion',['admi'=>$admi]);
            })
            ->rawColumns(['action','estado','estado_factura']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\ValidarMatricula $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admision $model)
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
                    ->setTableId('validarmatricula-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
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
            Column::make('inscripcion_id')->title('Identificación'),
            Column::make('user_id')->title('Postulante'),
            Column::make('cohorte_id')->title('Email'),
            Column::make('estado')->title('Estado admisión'),
            Column::make('estado_factura')->title('Estado factura'),
            Column::make('factura')->title('Número de factura'),
            Column::make('valor_factura')->title('Valor matrícula'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ValidarMatricula_' . date('YmdHis');
    }
}
