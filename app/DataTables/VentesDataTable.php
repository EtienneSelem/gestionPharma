<?php

namespace App\DataTables;

use App\Models\Vente;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VentesDataTable extends DataTable
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
           
            ->editColumn('created_at', function ($vente) {
                return $vente->created_at->format('d/m/Y');
            })
            ->editColumn('updated_at', function ($vente) {
                return $vente->updated_at->format('d/m/Y');
            })
            
            ->addColumn('user', function ($vente) {
                return '<a href="' . route('users.show', $vente->user->id) . '">' . $vente->user->name . '</a>';
            })
            ->addColumn('facture', function ($vente) {
                return '<a href="' . route('users.show', $vente->user->id) . '">' . $vente->invoice_number . '</a>';
            })
            
            ->addColumn('action', function ($vente) {
                return '<a href="' . route('ventes.show', $vente->id) . '" class="btn btn-xs btn-info btn-block">Voir</a>';
            })
            ->rawColumns(['user', 'facture','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\vente $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Vente $vente)
    {
        return $vente->with('user')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('ventes-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(1)
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['excel', 'print', 'csv'],
                    ])
                    ->lengthMenu()
                    ->language('//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('reference')->title('Référence'),
            Column::computed('total')->title('Total'),
            Column::computed('user')->title('User'),
            Column::make('invoice_number')->title('Numéro Facture'),
            Column::make('created_at')->title('Date'),
            Column::make('updated_at')->title('Changement'),
            Column::computed('action')->title('')->width(60)->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filenam()
    {
        return 'Ventes_' . date('YmdHis');
    }
}