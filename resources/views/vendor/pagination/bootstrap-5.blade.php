@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">Sebelumnya</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Sebelumnya</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Selanjutnya</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">Selanjutnya</span>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    Menampilkan
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    hingga
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    dari
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    hasil
                </p>
            </div>

            <div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="Sebelumnya">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Sebelumnya">&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Manual Windowing Logic: onEachSide(2) --}}
                    @php
                        $current = $paginator->currentPage();
                        $last = $paginator->lastPage();
                        $onEachSide = 2;

                        // Calculate base window
                        $start = max(1, $current - $onEachSide);
                        $end = min($last, $current + $onEachSide);

                        // Adjust window to always show at least (onEachSide * 2 + 1) pages when possible
                        // If we're at the start, extend the end
                        if ($current <= $onEachSide + 1) {
                            $end = min($last, $onEachSide * 2 + 1);
                        }

                        // If we're at the end, extend the start
                        if ($current >= $last - $onEachSide) {
                            $start = max(1, $last - ($onEachSide * 2));
                        }

                        // Show dots after first?
                        $showDotsAfterFirst = $start > 2;
                        // Show dots before last?
                        $showDotsBeforeLast = $end < ($last - 1);
                    @endphp

                    {{-- First Page (always show if there are dots after it OR if not in window) --}}
                    @if ($showDotsAfterFirst || $start > 1)
                        @if ($current == 1)
                            <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
                        @endif
                    @endif

                    {{-- Dots After First --}}
                    @if ($showDotsAfterFirst)
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                    @endif

                    {{-- Window Pages --}}
                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == 1 && ($showDotsAfterFirst || $start > 1))
                            {{-- Skip page 1 if already rendered above --}}
                        @elseif ($page == $last && ($showDotsBeforeLast || $end < $last))
                            {{-- Skip last page if will be rendered separately below --}}
                        @else
                            @if ($page == $current)
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                            @endif
                        @endif
                    @endfor

                    {{-- Dots Before Last --}}
                    @if ($showDotsBeforeLast)
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                    @endif

                    {{-- Last Page (always show if there are dots before it OR if not in window) --}}
                    @if ($last > 1 && ($showDotsBeforeLast || $end < $last))
                        @if ($current == $last)
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $last }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $paginator->url($last) }}">{{ $last }}</a></li>
                        @endif
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Selanjutnya">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="Selanjutnya">
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
