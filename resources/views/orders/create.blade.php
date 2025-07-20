@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Checkout</h2>
  <ul class="list-group mb-3">
    @foreach($cart as $item)
      <li class="list-group-item d-flex justify-content-between">
        <span>{{ $item['product']->name }} (x{{ $item['quantity'] }})</span>
        <strong>₹{{ $item['product']->price * $item['quantity'] }}</strong>
      </li>
    @endforeach
    <li class="list-group-item d-flex justify-content-between">
      <strong>Total</strong>
      <strong>₹{{ $total }}</strong>
    </li>
  </ul>
  <form action="{{ route('order.store') }}" method="POST">
    @csrf
    <button class="btn btn-success">Place Order</button>
  </form>
</div>
@endsection