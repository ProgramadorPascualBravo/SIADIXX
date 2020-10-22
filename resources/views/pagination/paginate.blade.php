
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination text-center" role="navigation">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-previous disabled">Atrás</li>
            @else
                <li class="pagination-previous"><a wire:click="previousPage" aria-label="Prev page">Atrás</a></li>
            @endif

            {{-- Pagination Element --}}
            @foreach ($elements as $element)
            <!-- "Three Dots" Separator -->
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

            <!-- Array Of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="current"><span class="show-for-sr">You're on page</span>{{ $page }}</li>
                        @else
                            <li><a wire:click="gotoPage({{ $page }})" aria-label="Page {{ $page }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-next"><a wire:click="nextPage" aria-label="Next page">Siguiente</a></li>
            @else
                <li class="pagination-next disabled">Siguiente</li>
            @endif
        </ul>
    </nav>
@endif
