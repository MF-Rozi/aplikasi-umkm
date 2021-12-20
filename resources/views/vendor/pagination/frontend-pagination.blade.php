@if ($paginator->hasPages())
<ul>

    @if ($paginator->onFirstPage())
    <li><a href="#">← Prev</a></li>
    @else
    <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Prev</a></li>
    @endif



    @foreach ($elements as $element)

    @if (is_string($element))
    <li><a href="#"><span>{{ $element }}</span></a></li>
    @endif



    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li><a class="active" href="#">{{ $page }}</a></li>
    @else
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach



    @if ($paginator->hasMorePages())
    <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li>
    @else
    <li><a href="#">Next →</a></li>
    @endif
</ul>
@endif
