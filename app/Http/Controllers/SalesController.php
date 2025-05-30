<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\CoffeesModel;
use App\Models\SalesModel;
use Akaunting\Money\Currency;
use Akaunting\Money\Money;

class SalesController extends Controller
{
    /**
     * Index that shows the sales form and previous sales
     */
    public function index(Request $request) {
        $coffees = CoffeesModel::get();
        $sales = SalesModel::orderBy('updated_at', 'DESC')->get();
        return view('coffee_sales', ['coffees' => $coffees, 'sales' => $sales]);
    }

    /**
     * Insert new sale
     */
    public function insert(Request $request) {
        $validatedData = $request->validate([
            'coffee_id' => 'required|integer',
            'quantity' => 'required|integer',
            'cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'sales_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $params = $request->all();
        $item = SalesModel::make();
        $item->coffee_id = $params['coffee_id'];
        $item->quantity = $params['quantity'];
        $item->cost = $params['cost'];
        $item->sales_price = $params['sales_price'];
        $item->save();

        $coffees = CoffeesModel::get();
        $sales = SalesModel::orderBy('updated_at', 'DESC')->get();

        return redirect()->route('coffee.sales', ['coffees' => $coffees, 'sales' => $sales]);
    }

    /**
     * Calculate the sales price
     */
    public function calculate(Request $request) {
        $params = $request->all();
        $coffee = CoffeesModel::findOrFail($params['coffee']);
        $shipping = 10;
        $cost = $params['quantity'] * $params['cost'];
        $price = ($cost / ( 1 - $coffee->profit_margin ) ) + $shipping;
        return response()->json(Money::GBP($price));
    }
}
