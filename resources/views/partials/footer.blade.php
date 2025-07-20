<footer class="bg-dark text-white py-5 mt-5">
  <div class="container">

    <div class="row">
      <div class="col-md-4 mb-3">
        <h5>Kanha Creation</h5>
        <p>Quality furniture crafted for your home.</p>
      </div>

      <div class="col-md-4 mb-3">
        <h6>Quick Links</h6>
        <ul class="list-unstyled">
          <li>
            <a href="{{ route('home') }}" class="text-white">Home</a>
          </li>
          <li>
            <a href="{{ route('home') }}#products" class="text-white">Products</a>
          </li>
          <li>
            <a href="#" class="text-white">Contact</a>
          </li>
        </ul>
      </div>

      <div class="col-md-4 mb-3">
        <h6>Contact Us</h6>
        <p>
          +91-XXXXXXXXXX<br>
          info@kanhacreation.com
        </p>
      </div>
    </div>

    <div class="text-center mt-3">
      &copy; {{ date('Y') }} Kanha Creation. All rights reserved.
    </div>

  </div>
</footer>