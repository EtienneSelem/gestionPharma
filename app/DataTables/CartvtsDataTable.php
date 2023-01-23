<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CartvtsDataTable extends DataTable
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
            ->editColumn('categories', function ($product) {
                return $this->getCategories($product);
            })   
            ->editColumn('action', function ($product) {

                return  $buttons = $this->button(
                                'produitvt.show', 
                                $product->id, 
                                'success', 
                                __('Show'), 
                                'eye', 
                                '',
                                '_blank'
                            );

        
            })
            ->rawColumns(['categories', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    
    public function query(Product $product)
    {
        $query = isRole('redac') ? dd(auth()->user())->products() : $product->newQuery();

        if(Route::currentRouteNamed('products.indexnew')) {
            $query->has('unreadNotifications');
        }

        return $query->select(
                        'products.id',
                        'name',
                        'price',
                        'forme',
                        'active',
                        'user_id')
                    ->with(
                        'categories:title')
                    ->whereActive(true);;
    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('products-table')
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
        $columns = [
            Column::make('name')->title(__('Name'))
        ];
        
        array_push($columns,
            Column::computed('categories')->title(__('Familles')),
            Column::computed('price')->title(__('Prix')),
            Column::computed('forme')->title(__('Formes')),
            Column::computed('action')->title(__('Action'))->addClass('align-middle text-center')
        );

        return $columns;
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filenam()
    {
        return 'products' . date('YmdHis');
    }

      
    protected function getCategories($product)
    {
        $html = '';

        foreach($product->categories as $category) {
            $html .= $category->title . '<br>';
        }

        return $html;
    }

}
