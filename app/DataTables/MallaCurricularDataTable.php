<?php

namespace App\DataTables;

use App\Models\MallaCurricular;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MallaCurricularDataTable extends DataTable
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
            ->editColumn('materia_id',function($malla){
                return $malla->materia->nombre;
            })

            ->filterColumn('materia_id',function($query, $keyword){
                $query->whereHas('materia', function($query) use ($keyword) {
                    $query->whereRaw("nombre like ?", ["%{$keyword}%"]);
                });            
            })

            ->editColumn('user_id',function($malla){
                return $malla->docente->apellidos_nombres;
            })
            

            ->filterColumn('user_id',function($query, $keyword){
                $query->whereHas('docente', function($query) use ($keyword) {
                    $query->whereRaw("concat(primer_apellido,' ',segundo_apellido,' ',primer_nombre,' ',segundo_nombre) like ?", ["%{$keyword}%"]);
                });            
            })

            ->addColumn('action', function($malla){
                return view('mallaCurriculares.accion',['malla'=>$malla])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\MallaCurricular $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MallaCurricular $model)
    {
        return $model->newQuery()->where('paralelo_id',$this->idParalelo);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('mallacurricular-table')
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
            Column::make('materia_id')->title('Matería'),
            Column::make('nivel'),
            Column::make('user_id')->title('Docente'),
            Column::make('categoria')->title('Categoría'),
            Column::make('subindice')->title('subíndice'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MallaCurricular_' . date('YmdHis');
    }
}
