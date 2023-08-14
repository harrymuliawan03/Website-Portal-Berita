<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/">HM News</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ $active === "home" ? 'active' : '' }}" href="/">Home</a>
          </li>
          @foreach ($categories as $item)
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="/category/{{ $item->category_name }}"> {{ $item->category_name }} </a>
                <ul class="dropdown-menu">
                  @foreach ($item->category_details as $item2)
                  <li><a class="dropdown-item" href="/sub_category/{{ $item2->category_detail_name }}"><i class='bx bxs-chevron-right-circle'></i> {{ $item2->category_detail_name }}</a></li>
                  @endforeach
                </ul>
              </li>
            </ul>
          @endforeach
        </ul>
        <ul class="navbar-nav ms-auto mx-2">
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/user"><i class="bi bi-layout-text-window-reverse"></i> My Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="logout" method="post">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
              </li>
            </ul>
          </li>
          @else
          <li class="nav-item">
            <a href="/login" class="nav-link 
            "><i class="bi bi-box-arrow-in-right"></i> Login</a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
