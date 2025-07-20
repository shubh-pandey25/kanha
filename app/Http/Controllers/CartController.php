<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    /**
     * Display current cart.
     */
    public function index(): View
    {
        $cart = session('cart', []);
        $total = collect($cart)
                 ->sum(fn($item) => $item['product']->price * $item['quantity']);

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Add a product to cart (or increment).
     */
    public function add(Product $product): RedirectResponse
{
    $cart = session('cart', []);

    $id = $product->id;
    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            'product'  => $product,
            'quantity' => 1,
        ];
    }

    session(['cart' => $cart]);

    // Redirect to cart view instead of “back()”
    return redirect()
           ->route('cart.index')
           ->with('success', 'Product added to cart');
}

    /**
     * Update product quantity in cart.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $qty = (int) $request->input('quantity', 1);
        $cart = session('cart', []);
        $id   = $product->getKey();

        if ($qty > 0 && isset($cart[$id])) {
            $cart[$id]['quantity'] = $qty;
            session(['cart' => $cart]);
            return back()->with('success', 'Cart updated');
        }

        return back()->with('error', 'Invalid quantity');
    }

    /**
     * Remove a product from cart.
     */
    public function remove(Product $product): RedirectResponse
    {
        $cart = session('cart', []);
        $id   = $product->getKey();

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Item removed');
    }
}