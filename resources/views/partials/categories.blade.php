<section class="container mb-5">
  <h2 class="mb-4 text-center">Shop by Category</h2>
  <div class="row g-4">
    @foreach(App\Models\Category::all() as $cat)
      <div class="col-sm-6 col-md-4 col-lg-3">
        <a href="{{ route('home', ['category'=>$cat->id]) }}">
          <div class="card category-card h-100 border-0">
            <img
              src="/category_images/{{ $cat->id }}.jpg"
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