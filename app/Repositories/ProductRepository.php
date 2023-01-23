<?php

namespace App\Repositories;

use App\Models\{Category, Product};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductRepository
{
    /**
     * Create a query for Post.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function queryActive()
    {
        return Product::select(
                      'id',
                      'name',
                      'price',
                      'forme',
                      'date_peremption',
                      'user_id')
                    ->with(
                        'categories:title')
                    ->whereActive(true);
    }


    public function store($request)
    {
        $request->merge([
            'active' => $request->has('active')
        ]);
        $product = $request->user()->products()->create($request->all());
        
        $this->saveCategories($product, $request);
    }

    

      /**
     * Save categories and tags.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    protected function saveCategories($product, $request)
    {
        // Categorie
        $product->categories()->sync($request->categories);
        
    }

    /**
     * Update post.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Http\Requests\PostRequest  $request
     * @return void
     */
    public function update($product, $request)
    {
        $request->merge([
            'active' => $request->has('active'),
        ]);

        $product->update($request->all());

        $this->saveCategories($product, $request);
    }
    
}
