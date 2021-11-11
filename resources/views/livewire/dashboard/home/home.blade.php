<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div wire:loading>
        @livewire('general.loader')
    </div>
    <div class="container-fluid p-4">
        <!-- Page header -->
        @livewire('dashboard.home.components.page-haeder',
        ['title' => 'Dashboard',
        'rightActionBtn' => 'Add Menu',
        'rightBtnClass' => 'btn btn-primary',
        'pageThread' => false,
        'getModal' => false,
        'nextPage' => 'create-event',
        'pageTitle' => '',
        'icon' => true,
        'threads' => []])
        <!-- Page header End -->

        <!--summary -->
        @livewire('dashboard.home.components.summary', ['undefined' => ''])
        <!--summary end-->

        <!--graphs -->
        @livewire('dashboard.home.components.graph-summary')
        <!--graphs end-->

        <div class="row">
            {{-- @livewire('admin-dashboard.home.components.popular-organisers')
            @livewire('admin-dashboard.home.components.recent-events')
            @livewire('admin-dashboard.home.components.recent-orders') --}}
        </div>

    </div>

</div>
