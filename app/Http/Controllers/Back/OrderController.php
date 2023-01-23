<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ {Fournisseur, Product, User };
use Illuminate\Support\Str;
use Cart;

class OrderController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services\Shipping  $ship
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {        
        
        $content = Cart::getContent();
        $total = Cart::getTotal();
        $fournisseurs = Fournisseur::all();

        return view('back.command.index', compact('content', 'fournisseurs', 'total'));
    }

    /**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Services\Shipping  $ship
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        // Vérification du stock
        $items = Cart::getContent();
        //foreach($items as $row) {
            //$product = Product::findOrFail($row->id);
            //if($product->quantity < $row->quantity) {
            //    $request->session()->flash('message', 'Nous sommes désolés mais le produit "' . $row->name . '" ne dispose pas d\'un stock suffisant pour satisfaire votre demande. Il ne nous reste plus que ' . $product->quantity . ' exemplaires disponibles.');
            //    return back();
          //  }
       // }

        // Client
        $user = $request->user();
        
        // Enregistrement commande
        $order = $user->orders()->create([
            'reference' => strtoupper(Str::random(8)),
            'fournisseur_id' => $request->fournisseur,
        ]);
   
        // Enregistrement des produits
        foreach($items as $row) {

            $order->products()->create(
                [
                    'name' => $row->name,
                    'quantity' => $row->quantity,
                ]
            );        
            // Mise à jour du stock
            //$product = Product::findOrFail($row->id);
            //$product->quantity -= $row->quantity;
            //$product->save();
            // Alerte stock
            
        }
        // On vide le panier
        Cart::clear();
        Cart::session($request->user())->clear();
        // Notifications à prévoir pour les administrateurs et l'utilisateur
        return redirect(route('cartcmd.index'));
    }

   
}
