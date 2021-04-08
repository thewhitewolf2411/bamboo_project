@if ($paginator->hasPages())
    <nav class="d-flex">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            {{-- @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif --}}

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- <li class="page-number-active" aria-current="page"><span>{{ $page }}</span></li> --}}
                            <div class="d-flex px-3">
                                <a href="{{ $url }}" aria-current="page">
                                    <div class="page-number-active">
                                        {{ $page }}
                                    </div>
                                </a>    
                            <div>
                        @else
                            <div class="d-flex px-3">
                                <a href="{{ $url }}">
                                    <div class="page-number">
                                        {{ $page }}
                                    </div>
                                </a>    
                            <div>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            {{-- @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif --}}
        </ul>
    </nav>
@endif
