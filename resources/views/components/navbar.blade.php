<div id="top-navbar" class="d-flex align-items-center p-2 border-bottom">

  <!-- Left: Sidebar toggle -->
  <button class="btn btn-outline-secondary d-md-none" id="sidebarToggle">
    ☰
  </button>

  <!-- Spacer pushes the next element to the right -->
  <div class="ms-auto dropdown px-3">
    <img src="{{ asset('images/user-img.png') }}" alt="" class="rounded-circle dropdown-toggle" width="40" height="40"
      style="cursor: pointer;" data-bs-toggle="dropdown">

    <ul class="dropdown-menu dropdown-menu-end">
      <li><a class="dropdown-item"
          href="#"><b>{{ Auth::user()->name }}</b><br><small>{{ Auth::user()->email }}</small></b></a></li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="dropdown-item d-flex align-items-center" type="submit">
            Logout <i class="bi bi-door-open ms-2"></i>
          </button>
        </form>
      </li>
    </ul>
  </div>

</div>