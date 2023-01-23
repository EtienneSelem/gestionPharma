<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
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
            ->editColumn('active', function ($product) {
                return $product->active ? '<i class="fas fa-check"></i>' : '';
            })
            ->editColumn('categories', function ($product) {
                return $this->getCategories($product);
            })
            ->editColumn('created_at', function ($product) {
                return $this->getDate($product);
            })
           
            ->editColumn('action', function ($product) {

                $buttons = $this->button(
                                'products.edit', 
                                $product->name, 
                                'success', 
                                __('Show'), 
                                'eye', 
                                '',
                                '_blank'
                            );

                if(Route::currentRouteName() === 'products.indexnew') {
                    return $buttons;
                }

                $buttons .= $this->button(
                    'products.edit', 
                    $product->id, 
                    'warning', 
                    __('Edit'), 
                    'edit'
                );

                if($product->user_id === auth()->id()) {
                    $buttons .= $this->button(
                        'products.create', 
                        $product->id, 
                        'info', 
                        __('Clone'), 
                        'clone'
                    );
                }
                
                return $buttons . $this->button(
                            'products.destroy', 
                            $product->id, 
                            'danger', 
                            __('Delete'), 
                            'trash-alt', 
                            __('Really delete this product?')
                        );
            })
            ->rawColumns(['active','categories', 'action', 'created_at']);
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
                        'description',
                        'date_fabrication',
                        'date_peremption',
                        'active',
                        'products.created_at',
                        'products.updated_at',
                        'user_id')
                    ->with(
                        'user:id,name',
                        'categories:title');
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
        
        if(auth()->user()->role === 'admin') {
            array_push($columns, 
                Column::make('user.name')->title(__('Author'))
            );
        }

        array_push($columns,
            Column::computed('categories')->title(__('Familles')),
            Column::computed('price')->title(__('Prix')),
            Column::computed('forme')->title(__('Formes')),
            Column::computed('active')->title(__('Active'))->addClass('align-middle text-center'),
            Column::computed('date_fabrication')->title(__('Date Fabrication')),
            Column::computed('date_peremption')->title(__('Date Peremption')),
            Column::make('created_at')->title(__('Date')),
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

        /**
     * Get zone date.
     *
     * @param \App\Models\Post $post
     * @return string
     */
    protected function getDate($product)
    {
        if(!$product->active) {
            return $this->badge('Not published', 'warning');
        }

        $updated = $product->updated_at > $product->created_at;
        $html = $this->badge($updated ? 'Last update' : 'Enregistrer', 'success');

        $html .= '<br>' . formatDate($updated ? $product->updated_at : $product->created_at) . __(' at ') . formatHour($updated ? $product->updated_at : $product->created_at);

        return $html;
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
