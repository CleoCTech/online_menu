<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div wire:loading>
        @livewire('general.loader')
    </div>
    <nav class="navbar-vertical navbar">
        <div class="nav-scroller">
            <!-- Brand logo -->
            <a class="navbar-brand" href="#">
                <img  src="{{ asset('custom-assets/images/brand/logo.svg') }}" alt="Menu" />
                <img  src="{{ Avatar::create(Auth::user()->name )->toBase64() }}" alt="Company Name" />
            </a>
            <!-- Navbar nav -->
            <ul class="navbar-nav flex-column" id="sideNavbar">
                <!-- Nav item -->
                <li class="nav-item">
                    <div class="nav-divider"></div>
                </li>
                <!-- Nav item -->
                <li class="nav-item">
                    <div class="navbar-heading">Apps</div>
                </li>
                @if (Auth::guard('restraunt'))
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fe fe-home me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:click='menuCategories' class="nav-link" href="#">
                        <i class="  nav-icon fe fe-calendar me-2"></i> Menu Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:click='servingTables' class="nav-link" href="#">
                        <i class="nav-icon fe fe-calendar me-2"></i> Serving Tables
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:click='events' class="nav-link" href="#">
                        <i class="nav-icon fe fe-calendar me-2"></i> Dishes
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:click='events' class="nav-link" href="#">
                        <i class="nav-icon fe fe-list me-2"></i> Requests
                    </a>
                </li>
                <li class="nav-item">
                    <a wire:click='orders' class="nav-link" href="#">
                        <i class="nav-icon fe fe-file-text me-2"></i> Orders
                    </a>
                </li>

                <!-- Nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fe fe-settings me-2"></i> Settings
                    </a>
                </li>
                @endif
                @if (! Auth::guard('restraunt'))
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fe fe-slash me-2"></i> Settings
                    </a>
                </li>
                @endif
                <!-- Nav item -->

                <!-- Nav item -->
            </ul>
        </div>
    </nav>
</div>
