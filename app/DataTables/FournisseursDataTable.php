<?php

namespace App\DataTables;

use App\Models\Fournisseur;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FournisseursDataTable extends DataTable
{
    use DataTableTrait;

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
            ->editColumn('action', function ($fournisseur) {
                return $this->button(
                          'fournisseurs.edit', 
                          $fournisseur->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ). $this->button(
                          'fournisseurs.destroy', 
                          $fournisseur->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this Provider?')
                      );
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Follow $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Fournisseur $fournisseur)
    {
        return $fournisseur->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('fournisseurs-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['print', 'reload', 'export'],
                    ])
                    ->lengthMenu();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name')->title(__('Name')),
            Column::make('adresse')->title(__('Adresse')),
            Column::make('telephone')->title(__('Téléphone')),
            Column::computed('action')->title(__('Action'))->addClass('align-middle text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filenam()
    {
        return 'Fournisseurs_' . date('YmdHis');
    }
}
