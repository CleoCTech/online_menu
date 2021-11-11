<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="header">
        <!-- navbar -->
        <nav class="navbar-default navbar navbar-expand-lg">
            <a id="nav-toggle" href="#">
                <i class="fe fe-menu"></i>
            </a>
            <div class="ms-lg-3 d-none d-md-none d-lg-block"></div>
            <!--Navbar nav -->
            <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
                <!-- List -->
                <li class="dropdown ms-2">
                    <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-md avatar-indicators avatar-online">
                            <img alt="avatar"  src="{{ Avatar::create(Auth::user()->name )->toBase64() }}" class="rounded-circle" />
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                        <div class="dropdown-item">
                            <div class="d-flex">
                                <div class="avatar avatar-md avatar-indicators avatar-online">
                                    <img alt="avatar" src="{{ Avatar::create(Auth::user()->name )->toBase64() }}" class="rounded-circle" />
                                </div>
                                <div class="ms-3 lh-1">
                                    <h5 class="mb-1"> {{ Auth::user()->name }}</h5>
                                    <p class="mb-0 text-muted"> {{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <ul class="list-unstyled">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fe fe-user me-2"></i> Profile
                                </a>
                            </li>
                        </ul>
                        <div class="dropdown-divider"></div>
                        <ul class="list-unstyled">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fe fe-power me-2"></i> Sign Out
                                </a>
                            </li>
                        </ul>
                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
