<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
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
            ->editColumn('active', function ($order) {
                return $order->active ? '<i class="fas fa-check"></i>' : '';
            })
            ->editColumn('created_at', function ($order) {
                return $order->created_at->format('d/m/Y');
            })
            ->editColumn('updated_at', function ($order) {
                return $order->updated_at->format('d/m/Y');
            })
            
            ->addColumn('user', function ($order) {
                return '<a href="' . route('users.show', $order->user->id) . '">' . $order->user->name . '</a>';
            })
            ->addColumn('fournisseur', function ($order) {
                return '<a href="' . route('commandes.index', $order->user->id) . '">' . $order->fournisseur->name . '</a>';
            })
           
            ->addColumn('action', function ($order) {
                return '<a href="' . route('commandes.show', $order->id) . '" class="btn btn-xs btn-info btn-block">Voir</a>';
            })
            ->rawColumns(['valid','user', 'fournisseur', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model->with('fournisseur', 'user')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('orders-table')
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
            Column::computed('user')->title('User'),
            Column::computed('fournisseur')->title('Fournisseur'),
            Column::make('active')->title(__('Validé'))->addClass('align-middle text-center'), 
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
        return 'Orders_' . date('YmdHis');
    }
}