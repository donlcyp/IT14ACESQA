@if ($paginator->hasPages())
    <div class="pagination-container" style="display: flex; flex-direction: column; align-items: center; gap: 16px; padding: 20px 0;">
        <div class="pagination-info" style="color: #6b7280; font-size: 14px; text-align: center;">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} purchase history records
        </div>
        
        <div class="pagination-controls" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="page-btn disabled" style="opacity: 0.5; color: #9ca3af; cursor: not-allowed; pointer-events: none; padding: 8px 12px; border-radius: 6px; border: 1px solid #e5e7eb; background: #f9fafb; font-size: 14px;">‹</span>
            @else
                <a class="page-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev" style="color: #374151; text-decoration: none; padding: 8px 12px; border-radius: 6px; border: 1px solid #e5e7eb; background: white; font-size: 14px; transition: all 0.2s ease;">‹</a>
            @endif

            {{-- Pagination Elements --}}
            @php
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();
                $pageNumbers = [];
                
                if ($lastPage <= 7) {
                    // Show all pages if 7 or fewer
                    for ($i = 1; $i <= $lastPage; $i++) {
                        $pageNumbers[] = $i;
                    }
                } else {
                    // Always show first page
                    $pageNumbers[] = 1;
                    
                    // Add ellipsis if current page is far from start
                    if ($currentPage > 4) {
                        $pageNumbers[] = '...';
                    }
                    
                    // Show pages around current page
                    $start = max(2, $currentPage - 1);
                    $end = min($lastPage - 1, $currentPage + 1);
                    
                    for ($i = $start; $i <= $end; $i++) {
                        if (!in_array($i, $pageNumbers)) {
                            $pageNumbers[] = $i;
                        }
                    }
                    
                    // Add ellipsis if current page is far from end
                    if ($currentPage < $lastPage - 3) {
                        $pageNumbers[] = '...';
                    }
                    
                    // Always show last page
                    if (!in_array($lastPage, $pageNumbers)) {
                        $pageNumbers[] = $lastPage;
                    }
                }
            @endphp

            <div class="pagination-nav" style="display: flex; align-items: center; gap: 4px;">
                @foreach ($pageNumbers as $page)
                    @if ($page === '...')
                        <span class="page-btn ellipsis" style="color: #9ca3af; padding: 8px 4px; font-size: 14px;">…</span>
                    @elseif ($page == $currentPage)
                        <span class="page-btn active" style="background: #1e40af; color: white; font-weight: 600; border-radius: 6px; padding: 8px 12px; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; font-size: 14px; border: 1px solid #1e40af;">{{ $page }}</span>
                    @else
                        <a class="page-btn" href="{{ $paginator->url($page) }}" style="color: #374151; text-decoration: none; padding: 8px 12px; border-radius: 6px; border: 1px solid #e5e7eb; background: white; font-size: 14px; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s ease;">{{ $page }}</a>
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="page-btn" href="{{ $paginator->nextPageUrl() }}" rel="next" style="color: #374151; text-decoration: none; padding: 8px 12px; border-radius: 6px; border: 1px solid #e5e7eb; background: white; font-size: 14px; transition: all 0.2s ease;">›</a>
            @else
                <span class="page-btn disabled" style="opacity: 0.5; color: #9ca3af; cursor: not-allowed; pointer-events: none; padding: 8px 12px; border-radius: 6px; border: 1px solid #e5e7eb; background: #f9fafb; font-size: 14px;">›</span>
            @endif
        </div>
    </div>

    <style>
        .page-btn.active {
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
    </style>
@endif
