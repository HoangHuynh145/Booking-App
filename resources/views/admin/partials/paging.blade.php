@if ($paginator->hasPages())
<ul class="pagination pagination-rounded pagination-outline-primary justify-content-end">
    @foreach($elements as $element)
        @if (is_array($element))
            @foreach($element as $page => $url)
                @if($page == $paginator->currentPage())

                    <li class="page-item active">
                        <a class="page-link">{{ $page }}</a>
                    </li>
{{--                @elseif($page == $paginator->onFirstPage())--}}
{{--                    <li class="page-item first">--}}
{{--                        <a class="page-link" href="{{ $url }}">--}}
{{--                            <i class="tf-icon mdi mdi-chevron-double-left"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @elseif($page == $paginator->onLastPage())--}}
{{--                    <li class="page-item last">--}}
{{--                        <a class="page-link" href="{{$url}}">--}}
{{--                            <i class="tf-icon mdi mdi-chevron-double-right"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach
{{--    <li class="page-item first">--}}
{{--        <a class="page-link" href="javascript:void(0);"--}}
{{--        ><i class="tf-icon mdi mdi-chevron-double-left"></i--}}
{{--            ></a>--}}
{{--    </li>--}}
{{--    <li class="page-item prev">--}}
{{--        <a class="page-link" href="javascript:void(0);"--}}
{{--        ><i class="tf-icon mdi mdi-chevron-left"></i--}}
{{--            ></a>--}}
{{--    </li>--}}
{{--    <li class="page-item">--}}
{{--        <a class="page-link" href="javascript:void(0);">1</a>--}}
{{--    </li>--}}
{{--    <li class="page-item">--}}
{{--        <a class="page-link" href="javascript:void(0);">2</a>--}}
{{--    </li>--}}
{{--    <li class="page-item active">--}}
{{--        <a class="page-link" href="javascript:void(0);">3</a>--}}
{{--    </li>--}}
{{--    <li class="page-item">--}}
{{--        <a class="page-link" href="javascript:void(0);">4</a>--}}
{{--    </li>--}}
{{--    <li class="page-item">--}}
{{--        <a class="page-link" href="javascript:void(0);">5</a>--}}
{{--    </li>--}}
{{--    <li class="page-item next">--}}
{{--        <a class="page-link" href="javascript:void(0);"--}}
{{--        ><i class="tf-icon mdi mdi-chevron-right"></i--}}
{{--            ></a>--}}
{{--    </li>--}}
{{--    <li class="page-item last">--}}
{{--        <a class="page-link" href="javascript:void(0);"--}}
{{--        ><i class="tf-icon mdi mdi-chevron-double-right"></i--}}
{{--            ></a>--}}
{{--    </li>--}}
</ul>
@endif
