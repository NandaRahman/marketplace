<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Product;
use Cart;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'qty' => 'required|numeric'
        ]);
        $data = $request->all();
        $data['options'] = ['image' => $request['image']];
        Cart::add($data);
        return redirect()->route('cartShow');
    }

    public function show()
    {
        $types = Type::all();
        $carts = Cart::content();
        return view('carts.cart')
            ->with('types', $types)
            ->with('carts', $carts);
    }
    public function update(Request $request, $rowId)
    {
        $this->validate($request, [
            'qty' => 'required|numeric'
        ]);
        $qty = $request['qty'];
        Cart::update($rowId, $qty);
        return redirect()->route('cartShow');
    }
}
