<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">咖啡商城 <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('contactUs') }}">聯絡我們</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/products">Admin(For Demo)</a>
      </li>
    </ul>
    <!-- data-target 用一個 id 去綁定 modal -->
    </div>
      <input class="btn btn-primary mr-2" data-toggle="modal" data-target="#notification" type="button" value="通知">
      <div class="fixed top-0 right-0 px-6 py-4 sm:block">
          @auth
              <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">會員中心</a>
          @else
              <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

              @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
              @endif
          @endauth
      </div>
    </div>
  </div>
</nav>
<!-- 綁定的 modal -->
@include('layouts.modal')