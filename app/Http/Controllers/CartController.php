<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
      $product = Product::findOrFail($request->input('name'));
      Cart::add(
        $product->id,
        $product->name,
        $product->quantity,
        $product->Type,
        $product->Desc,
        $product->Price,
        $product->Supplier,
      );
      return redirect()->route('product');
    }
}
