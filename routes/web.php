<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\{
    HomeController as FrontHomeController,
};
use App\Http\Controllers\Back\{
    AdminController,
    ResourceController as BackResourceController,
    UserController as BackUserController,
    FournisseurController as BackFounisseurController,
    ProductController as BackProductController,
    CmdsController as BackCmdsController,
    CartController as BackCartController,
    CartvtController as BackCartvtController,
    OrderController as BackOrderController,
    OrdeController as BackOrdeController,
    VtsController as BackVtsController,
    VenteController as BackVenteController,
    
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home
Route::name('home')->get('/', [FrontHomeController::class, 'index']);

   //administration
Route::prefix('/admin')->group(function () {
    Route::middleware('redac')->group(function () {
        Route::name('admin')->get('/', [AdminController::class, 'index']);
        Route::name('purge')->put('purge/{model}', [AdminController::class,'purge']);

         // Products
       Route::resource('products', BackProductController::class)->except(['show', 'create']);
       Route::get('products/create/{id?}', [BackProductController::class, 'create'])->name('products.create');
       Route::resource('panier', BackCartController::class)->except(['show']); 
       //Catégories
       Route::resource('paniervente', BackCartvtController::class)->except(['show']);
       //operation de vente
       Route::resource('ventes', BackVenteController::class);
    });

    Route::middleware('admin')->group(function () {
         // Products
         Route::get('newproducts', [BackProductController::class, 'index'])->name('products.indexnew');
        //Catégories
        Route::resource('categories', BackResourceController::class)->except(['show']);
        // Users*
        Route::resource('users', BackUserController::class)->except(['create', 'store']);
        Route::get('newusers', [BackResourceController::class, 'index'])->name('users.indexnew');
        // Fournisseurs
        Route::resource('fournisseurs', BackFounisseurController::class)->except(['show', 'create', 'store']);
        Route::get('newfournisseurs', [BackResourceController::class, 'index'])->name('fournisseurs.indexnew');
        Route::resource('fournisseurs', BackResourceController::class)->except(['show']);
        //pannier cmd
        Route::get('cartcmd', [BackCmdsController::class, 'index'])->name('cartcmd.index');
        //processus vente
        Route::get('cartvente', [BackVtsController::class, 'index'])->name('cartvente.index');
        Route::get('produitventes/{produit}', [BackVtsController::class, 'show'])->name('produitvt.show');
         // Liste commande
         Route::get('commande/livrée', [BackCmdsController::class, 'livraison'])->name('produits.livrer');
         Route::post('commande/livré', [BackCmdsController::class, 'store'])->name('livraison.store');
         Route::get('produits/{produit}', [BackCmdsController::class, 'show'])->name('produits.show');
         Route::get('commande', [BackOrderController::class, 'create'])->name('commandes.create');
         Route::post('commandes', [BackOrderController::class, 'store'])->name('commandes.store');

         //commandes
        Route::get('commandes', [BackOrdeController::class, 'index'])->name('commandes.index');
        Route::get('commandes/{id}', [BackOrdeController::class, 'show'])->name('commandes.show');
        
    });
  
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
