<section class="section container">
    <div class="section__header">
        <nav aria-label="breadcrumb" class="d-flex align-items-center flex-wrap">
            <ol class="breadcrumb">
                @foreach($breadcrumbs as $breadcrumb)
                    <li class="breadcrumb-item text-crop @if($loop->last) active @endif" @if($loop->last) aria-current="page" @endif data-crop-size="100">
                        @if(!$loop->last)
                            <a href="{{ $breadcrumb['route'] }}">
                                {!! $breadcrumb['title'] !!}
                            </a>
                        @else
                            {!! $breadcrumb['title'] !!}
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
        <div class="section__header-text section__header-text--search">
            <span>{{__('messages.cannot_find')}}</span>
            <span>
                <span>{{__('messages.use_search')}}</span>
                <svg width="29" height="8" viewBox="0 0 29 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M28.3536 4.35355C28.5488 4.15829 28.5488 3.84171 28.3536 3.64645L25.1716 0.464466C24.9763 0.269204 24.6597 0.269204 24.4645 0.464466C24.2692 0.659728 24.2692 0.976311 24.4645 1.17157L27.2929 4L24.4645 6.82843C24.2692 7.02369 24.2692 7.34027 24.4645 7.53553C24.6597 7.7308 24.9763 7.7308 25.1716 7.53553L28.3536 4.35355ZM0 4.5H28V3.5H0V4.5Z"
                          fill="#EC6676"/>
                </svg>
            </span>
        </div>
    </div>
</section>
