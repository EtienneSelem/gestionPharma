<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\{ Order, State };
use Illuminate\Http\Request;
use App\DataTables\OrdersDataTable;
use App\Services\Facture;

class OrdeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrdersDataTable $dataTable)
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
        $order = Order::with('products','user', 'fournisseur', 'user.orders')->findOrFail($id);

        return view('back.command.show', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $commande)
    {
        $commande->load('state');

        $states = State::all();

        if($request->state_id !== $commande->state_id) {
            // En cas de changement de type de paiement
            $indice_payment = $states->firstWhere('slug', 'cheque')->indice;
            $state_new = $states->firstWhere('id', $request->state_id);
            if($commande->state->indice ===  $indice_payment && $state_new->indice ===  $indice_payment){
                $commande->payment = $states->firstWhere('id', $request->state_id)->slug;
            }

            $commande->state_id = $request->state_id;                      
            $commande->save();          
        }
        
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $commande
     * @return \Illuminate\Http\Response
     */
    public function invoice(Request $request, Facture $facture,  Order $commande)
    {
        $response = $facture->create($commande, $request->has('paid')); 
        
        if($response->successful()) {

            $data = json_decode($response->body());
            $commande->invoice_id = $data->id;
            $commande->invoice_number = $data->number;
            $commande->save();

          } else {
            $request->session()->flash('invoice', 'La création de facture n\'a pas abouti');
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $commande
     * @return \Illuminate\Http\Response
     */
    public function updateNumber(Request $request, Order $commande)
    {
        $request->validate([
            'purchase_order' => 'required|string|max:100'
        ]);

        $commande->purchase_order = $request->purchase_order;
        $commande->save();            

        return back();
    }
}
