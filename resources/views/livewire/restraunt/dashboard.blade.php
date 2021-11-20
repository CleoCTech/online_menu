<div>
    @if ($page == 'dashboard')
    @livewire('dashboard.home.home')
    @elseif($page == 'menu-cat')
    @livewire('dashboard.menu.menu-categories')
    @elseif($page == 'tables')
    @livewire('dashboard.tables.restaurant-tables')
    @elseif($page == 'create-dish')
    @livewire('dashboard.menu.create-dish')
    @elseif($page == 'menu-list')
    @livewire('dashboard.menu.menu-list')
    @endif
</div>
