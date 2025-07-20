<!-- resources/views/cart/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container my-5">
  <h1 class="mb-4">Your Cart</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(empty($cart))
    <p>Your cart is empty. <a href="{{ route('home') }}">Continue shopping.</a></p>
  @else
    <table class="table table-hover align-middle">
      <thead class="table-light">
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Subtotal</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($cart as $id => $item)
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <img src="{{ $item['product']->image }}"
                     class="me-3"
                     style="width:60px;height:60px;object-fit:cover;"
                     alt="{{ $item['product']->name }}">
                <span>{{ $item['product']->name }}</span>
              </div>
            </td>
            <td>₹{{ number_format($item['product']->price,2) }}</td>
            <td>
              <form action="{{ route('cart.update', $item['product']) }}"
                    method="POST" class="d-flex">
                @csrf @method('PATCH')
                <input type="number"
                       name="quantity"
                       value="{{ $item['quantity'] }}"
                       min="1"
                       class="form-control form-control-sm me-2"
                       style="width:70px;">
                <button class="btn btn-sm btn-outline-secondary">Update</button>
              </form>
            </td>
            <td>₹{{ number_format($item['product']->price * $item['quantity'],2) }}</td>
            <td>
              <form action="{{ route('cart.remove', $item['product']) }}"
                    method="POST">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Remove</button>
              </form>
            </td>
          </tr>
        @endforeach

        <tr>
          <td colspan="3" class="text-end"><strong>Total:</strong></td>
          <td><strong>₹{{ number_format($total,2) }}</strong></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <div class="d-flex justify-content-between">
      <a href="{{ route('home') }}" class="btn btn-outline-primary">
        Continue Shopping
      </a>
      <a href="{{ route('checkout') }}" class="btn btn-primary">
        Proceed to Checkout
      </a>
    </div>
  @endif
</div>
@endsection