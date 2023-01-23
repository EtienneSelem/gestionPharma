<?php

namespace App\Http\Controllers\Back;

use App\Http\{
    Controllers\Controller,
    Requests\Back\ProductRequest
};
use App\Repositories\ProductRepository;
use App\Models\{ Product, Category };
use App\DataTables\ProductsDataTable;

class ProductController extends Controller
{

   
    /**
     * Display a listing of the posts.
     *
     * @param  \App\DataTables\PostsDataTable  $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('back.shared.index');
    }

    /**
     * Show the form for creating a new post.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $product = null; 

        if($id) {
            $product = Product::findOrFail($id);
            if($product->user_id === auth()->id()) {
                $product->name .= ' (2)';
                $product->forme .='-2';
                $product->active = false;
            } else {
                $product = null;
            } 
        }
        
        $categories = Category::all()->pluck('title', 'id');
        // On crée notre array $forme
        $formes = array (
            'comprimer' => 'Comprimer',
            'capsule' => 'Capsule');
        
        return view('back.products.form', compact('product', 'categories', 'formes'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \App\Http\Requests\Back\PostRequest  $request
     * @param  \App\Repositories\PostRepository $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ProductRepository $repository)
    {
        $repository->store($request);

        return back()->with('ok', __('The product has been successfully created'));
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all()->pluck('title', 'id');
       
        return view('back.products.form', compact('product', 'categories'));
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \App\Http\Requests\Back\PostRequest  $request
     * @param  \App\Repositories\PostRepository $repository
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, ProductRepository $repository, Product $product)
    {
        $repository->update($product, $request);

        return back()->with('ok', __('The product has been successfully updated'));
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json();
    }

}
