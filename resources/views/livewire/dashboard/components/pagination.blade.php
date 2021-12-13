<div>
   @if ($paginator->hasPages())
    <div class="card-footer border-top-0">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mb-0">
                @if ($paginator->onFirstPage())
                {{-- <li class="page-item disabled">
                    <a class="page-link mx-1 rounded" href="#" tabindex="-1" aria-disabled="true"><i
                            class="mdi mdi-chevron-left"></i></a>
                </li> --}}
                @else
                <li  class="page-item">
                    <a dusk="previousPage"  wire:click="previousPage" wire:loading.attr="disabled" rel="prev"  class="page-link mx-1 rounded" href="#" ><i
                            class="mdi mdi-chevron-left"></i></a>
                </li>
                @endif


                @foreach ($elements as $element)
                    @if (is_string($element))
                    <li class="page-item ">
                        <a class="page-link mx-1 rounded" href="#" >{{ $element }}</a>
                    </li>
                    @endif
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                {{-- <li class="page-item active" wire:key="paginator-page-{{ $page }}" aria-current="page"><span class="page-link">{{ $page }}</span></li> --}}
                                <li class="page-item active">
                                    <a class="page-link mx-1 rounded"  wire:key="paginator-page-{{ $page }}" aria-current="page">{{ $page }}</a>
                                </li>
                            @else
                                {{-- <li class="page-item" wire:key="paginator-page-{{ $page }}"><button type="button" class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</button></li> --}}
                                <li class="page-item ">
                                    <a class="page-link mx-1 rounded" href="#" wire:click='gotoPage({{ $page }})'>{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                {{-- <li class="page-item active">
                    <a class="page-link mx-1 rounded" href="#">1</a>
                </li> --}}

                @if ($paginator->hasMorePages())
                <li wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="page-item">
                    <a class="page-link mx-1 rounded" href="#"><i class="mdi mdi-chevron-right"></i></a>
                </li>
                @else
                {{-- <li class="page-item disabled">
                    <a class="page-link mx-1 rounded" aria-disabled="true"><i class="mdi mdi-chevron-right"></i></a>
                </li> --}}
                @endif

            </ul>
        </nav>
    </div
    @endif

</div>
