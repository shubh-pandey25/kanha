{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('hero')
  @include('partials.hero')
@endsection

@section('content')
  {{-- Shop by Category --}}
  <section class="container my-5">
    <h2 class="mb-4 text-center">Shop by Category</h2>
    <div class="row g-4">
      @foreach($categories as $cat)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <a href="{{ route('home', ['category' => $cat->id]) }}" class="text-decoration-none">
            <div class="card category-card h-100 border-0 shadow-sm">
              <img
                src="{{ asset("category_images/{$cat->id}.jpg") }}"
                class="card-img-top"
                alt="{{ $cat->name }}"
                style="height:180px; object-fit:cover;"
              >
              <div class="card-body text-center">
                <h5 class="card-title">{{ $cat->name }}</h5>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </section>

  {{-- Products & Search --}}
  <section id="products" class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>All Products</h2>

      <form class="d-flex" method="GET" action="{{ route('home') }}">
        <input
          type="text"
          class="form-control me-2"
          name="q"
          placeholder="Search furniture..."
          value="{{ request('q') }}"
        >

        @if(request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}">
        @endif

        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
    </div>

    @if($products->count())
      <div class="row g-4">
        @foreach($products as $product)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card product-card h-100 shadow-sm">
              @if($product->image)
                <img
                  src="{{ $product->image }}"
                  class="card-img-top"
                  alt="{{ $product->name }}"
                  style="height:200px; object-fit:cover;"
                >
              @endif
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="text-primary fw-bold mb-2">
                  ₹{{ number_format($product->price, 2) }}
                </p>
                <p class="text-muted small mb-3">
                  {{ $product->category->name ?? 'Uncategorized' }}
                </p>
                <div class="mt-auto">
                  <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-primary w-100">
                      Add to Cart
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Pagination --}}
      <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
      </div>
    @else
      <p class="text-center text-muted">No products found.</p>
    @endif
  </section>

  {{-- Testimonials --}}
  <section class="container my-5">
    <h2 class="mb-4 text-center">What Our Customers Say</h2>
    <div class="row g-4">
      @foreach([
        ['name' => 'Rohit S.', 'text' => 'Amazing quality and service!'],
        ['name' => 'Priya M.',  'text' => 'My living room never looked better!'],
        ['name' => 'Ankit P.',  'text' => 'Fast delivery and great prices.']
      ] as $t)
        <div class="col-md-4">
          <div class="testimonial p-4 text-center">
            <p class="mb-3">“{{ $t['text'] }}”</p>
            <strong>{{ $t['name'] }}</strong>
          </div>
        </div>
      @endforeach
    </div>
  </section>
@endsection