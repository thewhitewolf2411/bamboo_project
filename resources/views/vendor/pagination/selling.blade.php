@if ($paginator->hasPages())
    <nav class="d-flex">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">
                        <img class="pagination-icon disabled" src="{{asset('/images/front-end-icons/black_arrow_left.svg')}}">
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <img class="pagination-icon" src="{{asset('/images/front-end-icons/black_arrow_left.svg')}}">
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))

                    @foreach ($element as $page => $url)
                        {{-- Use three dots when current page is greater than 4. --}}
                        @if ($paginator->currentPage() > 4 && $page === 2)
                            <li class="d-flex px-2"><span class="page-number">...</span></li>
                        @endif

                        {{-- Show active page else show the first and last two pages from current page. --}}
                        @if ($page == $paginator->currentPage())
                            <li class="d-flex px-2">
                                <span class="page-number-active">{{ $page }}</span>
                            </li>
                        @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2 || $page === $paginator->lastPage() || $page === 1)
                            <li class="d-flex px-2">
                                <a class="page-number" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif

                        {{-- Use three dots when current page is away from end. --}}
                        @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
                            <li class="d-flex px-2">
                                <span class="page-number">...</span>
                            </li>
                        @endif
                    @endforeach


                    {{-- @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <!--<li class="page-number-active" aria-current="page"><span>{{ $page }}</span></li>-->
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
                    @endforeach --}}

                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item ml-3">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <img class="pagination-icon" src="{{asset('/images/front-end-icons/black_arrow_next.svg')}}">
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">
                        <img class="pagination-icon disabled" src="{{asset('/images/front-end-icons/black_arrow_next.svg')}}">
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
