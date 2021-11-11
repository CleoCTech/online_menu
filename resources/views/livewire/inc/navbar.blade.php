<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
   <nav class=" navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
        <div class="container px-5">
            <a class="navbar-brand text-dark" href="index.html">Online Menu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-lg-5">

                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('restraunt-signin') }}">Login</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    </li>
                    @endguest

                    {{-- <li class="nav-item">
                        <a class="nav-link" href="menu.html">Menu</a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>
</div>
