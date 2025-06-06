@if ($paginator->hasPages())
    <nav class="custom-pagination">
        {{-- 前へ --}}
        @if ($paginator->onFirstPage())
            <span class="arrow disabled">&lt;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="arrow">&lt;</a>
        @endif

        {{-- ページ番号 --}}
        @foreach ($elements as $element)
            {{-- 省略記号（...） --}}
            @if (is_string($element))
                <span class="page disabled">{{ $element }}</span>
            @endif

            {{-- ページ番号リンク --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- 次へ --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="arrow">&gt;</a>
        @else
            <span class="arrow disabled">&gt;</span>
        @endif
    </nav>
@endif
