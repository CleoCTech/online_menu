<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div wire:loading>
        @livewire('general.loader')
    </div>
    <div class="row">
        <!-- Page header -->
        <div class="col-lg-12 col-md-12 col-12" >
            <div class="
                border-bottom
                pb-4
                mb-4
                d-md-flex
                align-items-center
                justify-content-between
                ">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">{{ $title }}</h1>
                    <!-- Breadcrumb -->
                    @if ($pageThread)
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @foreach ($threads  as $key => $item)

                                @if ($key == "Active")
                                <li class="breadcrumb-item active" aria-current="page">
                                   {{ $item }}
                                </li>
                                @else
                                <li class="breadcrumb-item">
                                    <a href="#">{{ $item }}</a>
                                </li>
                                @endif
                            @endforeach
                        </ol>
                    </nav>
                    @endif
                </div>
                @if (! $getModal)
                <div class="">
                    <a wire:click="rightBtnAction('{{ $nextPage }}',  '{{ $pageTitle }}')"
                     href="#" class="{{ $rightBtnClass }}"> {{ $rightActionBtn }}</a>
                </div>
                @else
                <div class="">
                    <a x-data= "{}"
                     {{--  x-on:click = "window.livewire.emitTo('{{ $nextPage }}', 'show', '{{ $pageTitle }}')"  --}}
                     x-on:click="$dispatch('dlg-modal');$wire.rightBtnAction('{{ $nextPage }}', '{{ $pageTitle }}')"
                     href="#" class="{{ $rightBtnClass }}"> {{ $rightActionBtn }}</a>
                </div>
                @endif
            </div>
        </div>
    </div>


    <div class='loadingx'
        x-cloak x-data="{ open: false}"
        x-show="open"
        x-on:dlg-modal.window = "open = true"
        x-on:keyup.escape.window = "open = false"
    >
        {{-- @include('livewire.general.global-modal') --}}
        @livewire('general.global-modal')
    </div>
    @stack('scripts')
    {{--  @livewire('dashboard.components.contac-modal')
    @livewire('dashboard.components.add-allergene-modal')
    @livewire('dashboard.components.add-dish-category-modal')
    @livewire('dashboard.components.add-price-category-modal')
    @livewire('dashboard.components.add-menu-food-category-modal')
    @livewire('dashboard.components.add-menu-category-modal')  --}}

</div>
