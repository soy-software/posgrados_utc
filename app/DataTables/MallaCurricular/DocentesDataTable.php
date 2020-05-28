<?php

namespace App\DataTables\MallaCurricular;

use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DocentesDataTable extends DataTable
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
            ->editColumn('primer_apellido',function($user){
                return $user->apellidos_nombres;
            })
            ->filterColumn('primer_apellido', function($query, $keyword) {
                $sql = "CONCAT(primer_apellido,' ',segundo_apellido,' ',primer_nombre,' ',segundo_nombre)  like ?";
                return $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', function($user){
                return view('mallaCurriculares.accionDocente',['user'=>$user])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\MallaCurricular/Docente $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->role('Docente');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('mallacurricular-docentes-table')
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
            Column::make('primer_apellido')->title('Apellidos y Nombres'),
            Column::make('email'),
            Column::make('identificacion')->title('Identificación'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Docentes_' . date('YmdHis');
    }
}
