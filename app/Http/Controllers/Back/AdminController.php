<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\{Order, Product, User};
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return View
     */
    public function index(User $user, Product $product, Order $order)
    {
        $users = isRole('admin') ? $this->getUnreads($user) : null;
        $products = isRole('admin') ? $this->getUnreads($product) : null;
        $orders = isRole('admin') ? $this->getUnreads($order) : null;
        $ventes = isRole('admin') ? $this->getUnreads($order) : null;
        
        return view('back.index', compact('users', 'products', 'orders', 'ventes'));
    }

    /**
     * Get the unread notifications.
     *
     * @return boolean
     */
    protected function getUnreads($model, $redac = null)
    {
        $query = $redac ? 
            $model->whereHas('order.user', function ($query) {
                $query->where('users.id', auth()->id());
            }) :
            $model->newQuery();

        return $query->has('unreadNotifications')->count();
    }

    /**
     * Purge notifications.
     *
     * @param  String $model
     * @return \Illuminate\Http\Response
     */
    public function purge($model)
    {
        $model = 'App\Models\\' . ucfirst($model);

        DB::table('notifications')->where('notifiable_type', $model)->delete();

        return back();
    }
}
