<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoffeesModel;

class SalesController extends Controller
{
    /**
     * Index that shows the sales form and previous sales
     */
    public function index(Request $request) {
        $coffees = CoffeesModel::get();
        return view('coffee_sales', ['coffees' => $coffees]);
    }
}
