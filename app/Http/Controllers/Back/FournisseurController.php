<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Http\Requests\Back\UserRequest;

class FournisseurController extends ResourceController
{
    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Back\UserRequest  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
    */
    public function update($id)
    {
        $request = app()->make(UserRequest::class);

        Fournisseur::findOrFail($id)->update($request->all());

        return back()->with('ok', __('The provider has been successfully updated'));
    }

    
}
