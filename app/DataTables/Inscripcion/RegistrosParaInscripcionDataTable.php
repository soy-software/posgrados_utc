<?php

namespace App\DataTables\Inscripcion;

use App\Models\Cohorte;
use App\Models\Registro;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RegistrosParaInscripcionDataTable extends DataTable
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
        ->editColumn('created_at',function($reg){
            return $reg->created_at.' '.$reg->created_at->diffForHumans();
        })
        ->editColumn('estado',function($reg){
            return view('validarRegistros.estado',['reg'=>$reg])->render();
        })
        ->editColumn('user_id',function($reg){
            return $reg->user->apellidos_nombres;
        })
        ->filterColumn('user_id',function($query, $keyword){
            $query->whereHas('user', function($query) use ($keyword) {
                $query->whereRaw("concat(primer_apellido,' ',segundo_apellido,' ',primer_nombre,' ',segundo_nombre) like ?", ["%{$keyword}%"]);
            });            
        })
        ->editColumn('cohorte_id',function($reg){
            return $reg->user->email;
        })
        ->filterColumn('cohorte_id',function($query, $keyword){
            $query->whereHas('user', function($query) use ($keyword) {
                $query->whereRaw("email like ?", ["%{$keyword}%"]);
            });            
        })
        ->filterColumn('updated_at',function($query, $keyword){
            $query->whereHas('user', function($query) use ($keyword) {
                $query->whereRaw("identificacion like ?", ["%{$keyword}%"]);
            });            
        })
        ->editColumn('updated_at',function($reg){
            return $reg->user->identificacion;
        })
        ->editColumn('foto',function($reg){
            return view('validarRegistros.foto',['reg'=>$reg])->render();
        })
        ->addColumn('action', function($reg){
            return view('inscripciones.accion',['reg'=>$reg])->render();
        })
        ->rawColumns(['foto','action','estado']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Inscripcion/RegistrosParaInscripcion $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Registro $model)
    {
        $cohorte=Cohorte::findOrFail($this->idCohorte);
        $inscripciones_ids=$cohorte->inscripciones->pluck('registro_id');   
        return $model->newQuery()->where(['cohorte_id'=>$this->idCohorte,'estado'=>'Validado'])->whereNotIn('id',$inscripciones_ids);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('inscripcion-registrosparainscripcion-table')
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
                  ->searchable(false)
                  ->title('Inscribir')
                  ->addClass('text-center'),
            Column::make('updated_at')->title('Identificación'),
            Column::make('user_id')->title('Postulante'),
            Column::make('cohorte_id')->title('Email'),
            Column::make('factura')->title('Factura'),
            Column::make('estado')->title('Registro'),
            Column::make('valor')->title('Valor'),
            Column::make('foto')->title('Comprobante')->searchable(false),
            Column::make('created_at')->title('Fecha de registro'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Inscripcion-RegistrosParaInscripcion_' . date('YmdHis');
    }
}
