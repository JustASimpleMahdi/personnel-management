@if ($paginator->hasPages())
    <div class="pagination">
        @if($paginator->hasMorePages())
            <a href="{{$paginator->nextPageUrl() }}" style="transform: scale(0.8) scaleX(-1);"> > </a>
        @endif
        <span class="page-text">صفحه {{$paginator->currentPage()}} از {{$paginator->total()}}</span>
        @if (!$paginator->onFirstPage())
            <a href="{{$paginator->previousPageUrl()}}" style="transform: scale(0.8) scaleX(-1);"> < </a>
        @endif
    </div>
@endif
