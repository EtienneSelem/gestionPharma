<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return View
     */
    public function index()
    {
        return view('front.layout');
    }
}
