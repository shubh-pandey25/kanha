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
          <a href="{{ route('home', ['category' => $cat->id]) }}"
             class="text-decoration-none">
            <div class="card category-card h-100 border-0 shadow-sm">
              <div class="position-relative overflow-hidden">
                <img
                  src="{{ asset("category_images/{$cat->id}.jpg") }}"
                  class="card-img-top"
                  alt="{{ $cat->name }}"
                  style="height:180px; object-fit:cover;"
                >
                <div class="cat-overlay position-absolute top-0 start-0 w-100 h-100
                              d-flex align-items-center justify-content-center">
                  <i class="bi bi-arrow-right-circle-fill text-white fs-1"></i>
                </div>
              </div>
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
        @foreach($products as $p)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card product-card h-100 shadow-sm">
              <img
                src="{{ $p->image ?: 'https://source.unsplash.com/400x300/?chair,furniture' }}"
                class="card-img-top"
                alt="{{ $p->name }}"
                style="height:200px; object-fit:cover;"
              >
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $p->name }}</h5>

                {{-- Star Rating --}}
                <div class="mb-2">
                  @for($i = 1; $i <= 5; $i++)
                    <i class="bi {{ $i <= rand(3,5)
                         ? 'bi-star-fill text-warning'
                         : 'bi-star text-muted' }}"></i>
                  @endfor
                </div>

                <p class="text-primary fw-bold mb-3">
                  ₹{{ number_format($p->price,2) }}
                </p>

                <div class="mt-auto d-grid gap-2">
                  {{-- Quick View --}}
                  <button
                    class="btn btn-outline-secondary"
                    data-bs-toggle="modal"
                    data-bs-target="#quickViewModal{{ $p->id }}"
                  >
                    Quick View
                  </button>

                  {{-- Add to Cart --}}
                  <form action="{{ route('cart.add', $p) }}" method="POST">
                    @csrf
                    <button class="btn btn-accent">Add to Cart</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          {{-- Quick View Modal --}}
          <div class="modal fade" id="quickViewModal{{ $p->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                      <img
                        src="{{ $p->image }}"
                        class="img-fluid"
                        alt="{{ $p->name }}"
                      >
                    </div>
                    <div class="col-md-6">
                      <h3>{{ $p->name }}</h3>
                      <p>{{ $p->description }}</p>
                      <p class="fw-bold">
                        ₹{{ number_format($p->price,2) }}
                      </p>
                      <form action="{{ route('cart.add', $p) }}" method="POST">
                        @csrf
                        <button class="btn btn-accent">Add to Cart</button>
                      </form>
                    </div>
                  </div>
                </div>
                <button
                  type="button"
                  class="btn-close position-absolute top-0 end-0 m-3"
                  data-bs-dismiss="modal"
                ></button>
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

  {{-- Testimonials Carousel --}}
  <section class="container my-5">
    <h2 class="mb-4 text-center">What Our Customers Say</h2>
    <div id="testiCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        @foreach($testimonials as $i => $t)
          <div class="carousel-item @if($i==0) active @endif">
            <div class="d-flex justify-content-center">
              <div class="testimonial p-4 text-center">
                <p>“{{ $t['text'] }}”</p>
                <strong>- {{ $t['name'] }}</strong>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button"
              data-bs-target="#testiCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button"
              data-bs-target="#testiCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </section>
@endsection