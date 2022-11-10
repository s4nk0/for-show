<style>
    .categories__items_container {
        position: relative;
    }

    .categories__items {
        overflow-x: hidden;
        display: flex;
        margin: 0px 0px 20px 0px;
        justify-content: center;
    }

    .section__arrow {
        position: absolute;
        top: 50%;
        z-index: 30;

    }
    .slideshow__items .slick-slide{
        margin: 0;
    }

    .slideshow__items .slick-slide{
        margin: 0;
    }

    .section__arrow--prev {
        left: 10px;
    }

    .section__arrow--next {
        right: 10px;
    }
    .category__content{
        margin: 0 10px;
    }
    /*.slideshow__items .slick-slide{*/
    /*    margin: 0 12.5px 0 0;*/
    /*}*/

    .category__content{
        margin: 0 10px;
    }

    .slick-list{
        width: 100%;
    }
    /*.slick-track{*/
    /*    display: flex;*/
    /*    justify-content: center;*/
    /*}*/
</style>

<section class="categories page-catalog__categories slideshow section--slideshow">
    <div class="container categories__items_container">
        {{--        row justify-content-center--}}
        <div class="section__arrow section__arrow--prev slideshow__arrow--prev slick-arrow" id="arrow_prev">
            <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="18.5" cy="18.5" r="18.5" fill="#F5F5F5"></circle>
                <path
                    d="M14.2929 18.2929C13.9024 18.6834 13.9024 19.3166 14.2929 19.7071L20.6569 26.0711C21.0474 26.4616 21.6805 26.4616 22.0711 26.0711C22.4616 25.6805 22.4616 25.0474 22.0711 24.6569L16.4142 19L22.0711 13.3431C22.4616 12.9526 22.4616 12.3195 22.0711 11.9289C21.6805 11.5384 21.0474 11.5384 20.6569 11.9289L14.2929 18.2929ZM16 18L15 18L15 20L16 20L16 18Z"
                    fill="black"></path>
            </svg>
        </div>
        <ul class="categories__items slideshow__items">

            @forelse($items as $item)
                <li class="category categories__item slideshow__item col-6 col-md-4 col-lg-3">
                    <a href="{{ route('item',$item->slug) }}">
                        <div class="category__wrap">
                            <div class="category__header">
                                <div class="category__image">
                                    <img src="{{ $item->getImages() }}" alt="{{ $item->title }}">
                                </div>
                            </div>
                            <div class="category__content text-center">
                                <h4 class="category__title">{{ $item->title }}</h4>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                {{-- @foreach($products as $product)
                    @include('pages.home.__card',['item'=>$product,'col'=>true])
                @endforeach --}}
            @endforelse

        </ul>
        <div class="section__arrow section__arrow--next slideshow__arrow--next slick-arrow" id="arrow_next">
            <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="18.5" cy="18.5" r="18.5" fill="#F5F5F5"></circle>
                <path
                    d="M14.2929 18.2929C13.9024 18.6834 13.9024 19.3166 14.2929 19.7071L20.6569 26.0711C21.0474 26.4616 21.6805 26.4616 22.0711 26.0711C22.4616 25.6805 22.4616 25.0474 22.0711 24.6569L16.4142 19L22.0711 13.3431C22.4616 12.9526 22.4616 12.3195 22.0711 11.9289C21.6805 11.5384 21.0474 11.5384 20.6569 11.9289L14.2929 18.2929ZM16 18L15 18L15 20L16 20L16 18Z"
                    fill="black"></path>
            </svg>
        </div>

        {{-- @empty(!$products)
            @include('layouts._paginate',['pagination'=>$products])
        @endempty --}}

    </div>
</section>
@push('scripts')
{{--    <script>--}}
{{--        const itemScroll = $('.categories__items');--}}
{{--        const item_card = $('.category__wrap');--}}
{{--        const scrollbarWidth = itemScroll[0].scrollWidth;--}}
{{--        $('#arrow_prev').click(function () {--}}
{{--            itemScroll.scrollLeft(itemScroll.scrollLeft() - item_card.width());--}}
{{--        })--}}
{{--        $('#arrow_next').click(function () {--}}
{{--            itemScroll.scrollLeft(itemScroll.scrollLeft() + item_card.width());--}}
{{--            let factor = itemScroll.scrollLeft() / (scrollbarWidth - itemScroll.width());--}}
{{--            if (factor > 0.9) {--}}
{{--                itemScroll.scrollLeft(0) ;--}}
{{--            }--}}
{{--        })--}}

{{--    </script>--}}
{{--<script defer src="{{ asset('js/dest/parts/slideshow-min.js') }}"></script>--}}

@endpush
