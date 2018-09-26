@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item pagination-prev disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span aria-hidden="true" class="page-link icomoon icon-angle"></span>
            </li>
        @else
            <li class="page-item pagination-prev">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="page-link icomoon icon-angle"></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item pagination-next">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="page-link icomoon icon-angle"></a>
            </li>
        @else
            <li class="page-item pagination-next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span aria-hidden="true" class="page-link icomoon icon-angle"></span>
            </li>
        @endif
    </ul>
@endif
