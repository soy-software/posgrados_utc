<?php

namespace App\DataTables\MiMaestrias;

use App\Models\Admision;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdmisionDataTable extends DataTable
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

            ->editColumn('user_id',function($adm){
                return $adm->user->apellidos_nombres;
            })
            ->filterColumn('user_id',function($query, $keyword){
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("concat(primer_apellido,' ',segundo_apellido,' ',primer_nombre,' ',segundo_nombre) like ?", ["%{$keyword}%"]);
                });            
            })
            ->editColumn('inscripcion_id',function($adm){
                return $adm->user->identificacion;
            })
            ->filterColumn('inscripcion_id',function($query, $keyword){
                $query->whereHas('user', function($query) use ($keyword) {
                    $query->whereRaw("identificacion like ?", ["%{$keyword}%"]);
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
            
            ->editColumn('updated_at',function($adm){
                return number_format($adm->examen+$adm->entrevista+$adm->ensayo,2);
            })

            ->addColumn('action', function($adm){
                return view('misMaestrias.admisionAccion',['adm'=>$adm])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\MiMaestrias/Admision $model
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
                    ->setTableId('mimaestrias-admision-table')
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
            Column::make('inscripcion_id')->title('Identificación'),
            Column::make('user_id')->title('Postulante'),
            Column::make('cohorte_id')->title('Email'),
            Column::make('estado')->title('Estado'),
            Column::make('examen'),
            Column::make('entrevista'),
            Column::make('ensayo'),
            Column::make('updated_at')->title('Total')->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MiMaestrias_Admision_' . date('YmdHis');
    }
}
