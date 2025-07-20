<section class="container mb-5">
  <h2 class="mb-4 text-center">Shop by Category</h2>
  <div class="row g-4">
    @foreach($categories as $cat)
      <div class="col-sm-6 col-md-4 col-lg-3">
        <a href="{{ route('home',['category'=>$cat->id]) }}" class="text-decoration-none">
          <div class="card category-card h-100 text-center border-0 shadow-sm">
            <div class="position-relative overflow-hidden">
              <img 
                src="https://source.unsplash.com/400x300/?{{ Str::slug($cat->name) }},furniture" 
                class="card-img-top" 
                alt="{{$cat->name}}">
              <div class="cat-overlay d-flex align-items-center justify-content-center">
                <i class="bi bi-arrow-right-circle-fill text-white fs-1"></i>
              </div>
            </div>
            <div class="card-body">
              <h5 class="card-title">{{$cat->name}}</h5>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>
</section>