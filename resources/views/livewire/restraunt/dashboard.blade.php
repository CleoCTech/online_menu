<div>
    @if ($page == 'dashboard')
    @livewire('dashboard.home.home')
    @elseif($page == 'menu-cat')
    @livewire('dashboard.menu.menu-categories')
    @elseif($page == 'tables')
    @livewire('dashboard.tables.restaurant-tables')
    @endif
</div>
