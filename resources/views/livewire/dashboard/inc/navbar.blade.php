<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div wire:loading>
        @livewire('general.loader')
    </div>
    <nav class="navbar-vertical navbar">
        <div class="nav-scroller">
            <!-- Brand logo -->
            <a class="navbar-brand" href="#">
                {{-- <img  src="{{ asset('custom-assets/images/brand/logo.svg') }}" alt="Menu" /> --}}
                <img  src="{{ Avatar::create(Auth::user()->name )->toBase64() }}" alt="Company Name" />
            </a>
            <!-- Navbar nav -->
            <ul class="navbar-nav flex-column" id="sideNavbar" x-data="{ show_list: false }">
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

                    <a class="nav-link" href="#" @click="show_list = ! show_list" data-bs-toggle="collapse" data-bs-target="#navDashboard" :aria-expanded="show_list ? 'true' : 'false'"
                        aria-controls="navDashboard">
                        <i class="nav-icon fe fe-menu me-2"></i> Dishes
                    </a>
                    <div id="navDashboard" class="collapse" data-bs-parent="#sideNavbar" x-show="show_list">
                        <ul class="nav flex-column" x-data="{}">
                            <li class="nav-item" >
                                <a wire:click='menuList' class="nav-link active" href="#"> All Dishes/Drinks </a>
                            </li>
                            <!-- Nav item -->
                            <li  class="nav-item">
                                <a x-on:click="$dispatch('dlg-modal');$wire.openModal('dashboard.components.add-dish-category-modal', 'Add Dish Category')" class="nav-link" href="#"> Add Dish/Drink Category </a>
                            </li>
                            <li class="nav-item">
                                <a x-on:click="$dispatch('dlg-modal');$wire.openModal('dashboard.components.add-price-category-modal', 'Add Price Category')" class="nav-link" href="#"> Add Price Category  </a>
                            </li>
                            <li class="nav-item">
                                <a x-on:click="$dispatch('dlg-modal');$wire.openModal('dashboard.components.add-allergene-modal', 'Add Allergenes')" class="nav-link" href="#"> Add Allergenes  </a>
                            </li>
                        </ul>
                    </div>
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
                {{-- <div class='loadingx'
                    x-cloak x-data="{ open: false}"
                    x-show="open"
                    x-on:dlg-modal.window = "open = true"
                    x-on:keyup.escape.window = "open = false"
                    >
                    @livewire('general.global-modal')
                </div> --}}
            </ul>
        </div>
    </nav>
    <style>
        .rotate{
            transform: rotate(180deg);
        }
    </style>
</div>
