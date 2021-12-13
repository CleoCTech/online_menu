
<div class="loadingx"
    x-cloak
    x-data = "{
        show: @entangle($attributes->wire('model'))
    }"
    x-show="show"
    x-on:keydown.escape.window = "show = false"
    x-on:click.outside = "show = false"
>

    <div x-show="show" class="modal-content">
        <div class="modal-header align-items-center">
            <h4 class="mb-0" id="newchatModalLabel">{{isset($pageTitle) ? $pageTitle:''}}</h4>
            <button
            type="button"
            class="btn-close"
            aria-label="Close"
            x-on:click = "show = false"
            ></button>
        </div>
        <div x-show="show" class="modal-body px-0">
            <div class="card-body">
                {{ $slot }}
                {{--  @if (count($categories)>0)
                    {{dd('yes')}}
                @endif
                {{dd($categories)}}  --}}
                {{--  {{ $categories->links('components.pagination-links') }}  --}}
               
            </div>
        </div>
      
        <div x-show="show" class="modal-footer p-0">
        @if ($list)
            <button type="button" class="btn btn-secondary btn-sm" x-on:click = "show = false">Close</button>
            <button type="button" wire:click='store' class="btn btn-primary btn-sm">Save</button>
        @else
            <button type="button" class="btn btn-secondary btn-sm" wire:click = "back">Back</button>
            <button type="button" wire:click='update' class="btn btn-primary btn-sm">Update</button> 
        @endif
            
        </div>

    </div>
</div>
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