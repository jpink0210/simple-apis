<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link">咖啡商城 <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/contactUs">聯絡我們</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/products">Admin(For Demo)</a>
      </li>
    </ul>
    <!-- data-target 用一個 id 去綁定 modal -->
    </div>
      <input class="btn btn-primary" data-toggle="modal" data-target="#notification" type="button" value="通知">
    </div>
  </div>
</nav>
<!-- 綁定的 modal -->
@include('layouts.modal')