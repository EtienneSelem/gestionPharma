<?php

namespace App\Http\Controllers\Back;

use App\DataTables\VentesDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ {Fournisseur, Product, User, VariationProduct, Vente};
use Illuminate\Support\Str;
use Cart;

class VenteController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VentesDataTable $dataTable)
    {
        return $dataTable->render('back.shared.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vente = Vente::with('products','user', 'user.ventes')->findOrFail($id);
        
        return view('back.ventes.show', compact('vente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services\Shipping  $ship
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {        
        
        $contentvt = Cart::getContent();
        $totalvt = Cart::getTotal();
        
        return view('back.ventes.index', compact('contentvt', 'totalvt'));
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
        
        // Enregistrement de la vente
        $vente = $user->ventes()->create([
            'reference' => strtoupper(Str::random(8)),
            'total' => Cart::getTotal(),
            'invoice_number' => strtoupper(Str::random(5)),
            'fournisseur_id' => $request->fournisseur,
        ]);
   
        // Enregistrement des produits
        foreach($items as $row) {

            $vente->products()->create(
                [
                    'name' => $row->name,
                    'total_price_gross' => ($row->price * $row->quantity),
                    'quantity' => $row->quantity,
                ]
            );        
            // Mise à jour du stock
            $variat = VariationProduct::where('product_id', '=', $request->product)->get();
            $variat->qte_entre -= $row->quantity;
            $variat->save();
        
        }
        // On vide le panier
        Cart::clear();
        Cart::session($request->user())->clear();
        // Notifications à prévoir pour les administrateurs et l'utilisateur
        return redirect(route('cartvente.index'));
    }

   
}
