<?php

namespace App\Http\Controllers\Back;

use App\DataTables\CartsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\{ Product, LivrerFournisseur, VariationProduct};
use Cart;

class CmdsController extends Controller
{
     /**
     * Display a listing of the posts.
     *
     * @param  \App\DataTables\PostsDataTable  $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(CartsDataTable $dataTable)
    {
        return $dataTable->render('back.shared.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $produit)
    {
        if($produit->active || $request->user()->admin) {
            $fournisseurs = Fournisseur::all()->pluck('name', 'id');
            return view('back.products.show', compact('produit', 'fournisseurs'));
        }

        return redirect(route('home'));
    }

    public function livraison()
    {
        $content = Cart::getContent();
        $total = Cart::getTotal();
        $fournisseurs = Fournisseur::all()->pluck('name', 'id');;;
        $products = Product::all()->pluck('name', 'id', 'forme');

        return view('back.livraisons.form', compact('content', 'fournisseurs', 'total', 'products'));
    }

    public function store(Request $request, LivrerFournisseur $livraison, VariationProduct $variation)
    {
        // Enregistrement commande 
        $livraison->create([
            'product_id' => $request->product,
            'prix_uni' => $request->prix,
            'qt_livrer' => $request->quantity,
            'total_net' => $request->total,
            'fournisseur_id' => $request->fournisseur,
        ]);

       // $variation = VariationProduct:: findOrFail($row->id);
       // $variat = VariationProduct::findOrFail($request->product);
       // $qtEntrer =  ($variat->qte_entre + $request->quantity);
       // $qtReel = ($variat->qte_reel + $request->quantity);
        
         // Mise à jour du stock
         if (VariationProduct::where('product_id', $request->product)->exists()) {

            $product = VariationProduct::where('product_id', $request->product)->get();
            $entree = ($product->qte_entre + $request->quantity);
            $reel = ($product->qte_reel + $request->quantity);
            
            $variation->create([
                'product_id' => $request->product,
                'qte_entre' => $entree,
                'qte_reel' => $reel,
            ]);

         }else {
            $variation->create([
                'product_id' => $request->product,
                'qte_entre' => $request->quantity,
            ]);
         }



        
        return back()->with('alert', config('messages.rangesupdated'));
        
    }
}
