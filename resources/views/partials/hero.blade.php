<div id="heroCarousel" class="carousel slide carousel-fade mb-5" data-bs-ride="carousel">
  <div class="carousel-inner">
    @foreach([
      [
        'img'   => 'https://source.unsplash.com/1600x900/?living-room,furniture',
        'title' => 'Live Beautifully',
        'text'  => 'Handcrafted pieces that tell your story.',
        'cta'   => ['text'=>'Shop Sofas','link'=>route('home',['category'=>1])]
      ],
      [
        'img'   => 'https://source.unsplash.com/1600x900/?bedroom,furniture',
        'title' => 'Dream in Comfort',
        'text'  => 'Explore our range of premium beds.',
        'cta'   => ['text'=>'Shop Beds','link'=>route('home',['category'=>4])]
      ]
    ] as $i => $slide)
      <div class="carousel-item @if($i==0) active @endif" 
           style="background:url('{{$slide['img']}}') center/cover no-repeat;">
        <div class="overlay"></div>
        <div class="carousel-caption text-start text-white">
          <h1 class="display-3 fw-bold">{{$slide['title']}}</h1>
          <p class="lead">{{$slide['text']}}</p>
          <a href="{{$slide['cta']['link']}}" class="btn btn-lg btn-accent">
            {{$slide['cta']['text']}}
          </a>
        </div>
      </div>
    @endforeach
  </div>
  <button class="carousel-control-prev" type="button"
          data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button"
          data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>