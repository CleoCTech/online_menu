<div>
    {{-- Stop trying to control. --}}

    @if ($modal == null)
        @livewire('general.loader')
    @else
    <div class="modal-content" x-data x-on:click.outside = "open = false">
        <div class="modal-header align-items-center">
            <h4 class="mb-0" id="newchatModalLabel">{{isset($pageTitle) ? $pageTitle:''}}</h4>
            <button
              type="button"
              class="btn-close"
              aria-label="Close"
              x-on:click = "open = false"
            ></button>
        </div>
        @if ($modal == 'dashboard.components.add-allergene-modal')
            @livewire('dashboard.components.add-allergene-modal')
        @elseif($modal == 'dashboard.components.add-dish-category-modal')
            @livewire('dashboard.components.add-dish-category-modal')
        @elseif($modal == 'dashboard.components.add-price-category-modal')
            @livewire('dashboard.components.add-price-category-modal')
        @elseif($modal == 'dashboard.components.add-menu-category-modal')
            @livewire('dashboard.components.add-menu-category-modal')
        @elseif($modal == 'dashboard.components.edit-menu-category-modal')
            @livewire('dashboard.components.edit-menu-category-modal', ['id'=>$editId])
        @elseif($modal == 'dashboard.components.edit-table-modal')
            @livewire('dashboard.components.edit-table-modal', ['id'=>$editId])
        @elseif($modal == 'dashboard.components.edit-price-category-modal')
            @livewire('dashboard.components.edit-price-category-modal', ['id'=>$editId])
        @else
            @livewire($modal)
        @endif
        {{--  @livewire($modal)  --}}
    </div>
    @endif
    <style>

        .page-link{
            font-size: x-small !important;
        }
        [x-cloak] { display: none }          /* Absolute Center Spinner */
        .loadingx {
        position: fixed;
        z-index: 999;
        height: fit-content;
        width: fit-content;
        overflow: show;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        }

        /* Transparent Overlay */
        .loadingx:before {
        content: '';
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
            background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

        background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loadingx:not(:required) {
        /* hide "loading..." text */
        font: 0/0 a;
        color: transparent;
        text-shadow: none;
        background-color: transparent;
        border: 0;
        }

        .loadingx:not(:required):after {
        content: '';
        display: block;
        font-size: 10px;
        width: 1em;
        height: 1em;
        margin-top: -0.5em;

        }
    </style>
</div>
