<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Back\UserRequest;

class UserController extends ResourceController
{
    public function show($id)
    {
        $user = User::with('orders', 'orders.fournisseur')->findOrFail($id);

        return view('back.users.show', compact('user'));
    }
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

        $request->merge([
            'valid' => $request->has('valid'),
        ]);

        User::findOrFail($id)->update($request->all());

        return back()->with('ok', __('The user has been successfully updated'));
    }

     /**
     * Valid the user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function valid(User $user)
    {
        $user->valid = true;
        $user->save();

        return response()->json();
    }

    /**
     * Unvalid the user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function unvalid(User $user)
    {
        $user->valid = true;
        $user->save();

        return response()->json();
    }
}
