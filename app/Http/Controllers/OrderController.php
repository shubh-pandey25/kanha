<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Show the checkout page, or redirect back if the cart is empty.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $total = collect($cart)
            ->sum(fn($item) => $item['product']->price * $item['quantity']);

        return view('orders.create', compact('cart', 'total'));
    }

    /**
     * Persist the order and its items, then clear the cart.
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('home')
                ->with('error', 'No items to checkout.');
        }

        $total = collect($cart)
            ->sum(fn($item) => $item['product']->price * $item['quantity']);

        // Create the Order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total'   => $total,
        ]);

        // Build OrderItem rows, using getKey() to avoid undefined-property warnings
        $items = collect($cart)->map(fn($item) => [
            'order_id'   => $order->getKey(),
            'product_id' => $item['product']->getKey(),
            'quantity'   => $item['quantity'],
            'price'      => $item['product']->price,
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();

        OrderItem::insert($items);

        // Clear the cart
        session()->forget('cart');

        return redirect()
            ->route('home')
            ->with('success', 'Order placed successfully!');
    }
}