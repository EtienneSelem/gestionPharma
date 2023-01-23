<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
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
            ->editColumn('products_count', function ($category) {
                return $this->badge($category->products_count, 'secondary');
            })
            ->editColumn('action', function ($category) {
                return $this->button(
                          'categories.edit', 
                          $category->id, 
                          'warning', 
                          __('Edit'), 
                          'edit'
                      ). $this->button(
                          'categories.destroy', 
                          $category->id, 
                          'danger', 
                          __('Delete'), 
                          'trash-alt', 
                          __('Really delete this category?')
                      );
            })
            ->rawColumns(['products_count', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $category)
    {
        return $category->withCount('products');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('categories-table')
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
            Column::make('title')->title(__('Title')),
            Column::make('slug')->title(__('Slug')),
            Column::computed('products_count')->title(__('Products'))->addClass('text-center align-middle'),
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
        return 'Categories_' . date('YmdHis');
    }
}
