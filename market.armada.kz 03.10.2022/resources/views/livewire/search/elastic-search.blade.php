<span>
<form action="{{ route('search') }}" class="search" >
    <input wire:model="search" name="q" id="search" type="search" placeholder="{{__('messages.main.header.search.product.placeholder')}}..." >

    <button type="submit">
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.60568 0C2.96341 0 0 2.96341 0 6.60568C0 10.2482 2.96341 13.2114 6.60568 13.2114C10.2482 13.2114 13.2114 10.2482 13.2114 6.60568C13.2114 2.96341 10.2482 0 6.60568 0ZM6.60568 11.9919C3.63577 11.9919 1.21951 9.57563 1.21951 6.60571C1.21951 3.6358 3.63577 1.21951 6.60568 1.21951C9.5756 1.21951 11.9919 3.63577 11.9919 6.60568C11.9919 9.5756 9.5756 11.9919 6.60568 11.9919Z"
                  fill="#8B8B8B"/>
            <path d="M14.8215 13.9593L11.3255 10.4633C11.0873 10.2251 10.7015 10.2251 10.4633 10.4633C10.2251 10.7013 10.2251 11.0875 10.4633 11.3255L13.9593 14.8215C14.0784 14.9406 14.2343 15.0001 14.3904 15.0001C14.5463 15.0001 14.7024 14.9406 14.8215 14.8215C15.0597 14.5835 15.0597 14.1973 14.8215 13.9593Z"
                  fill="#8B8B8B"/>
        </svg>
        <span>Найти</span>
    </button>

</form>
<div class="autosearch header__search-autosearch" style="z-index: 1; @if($search == "") display: none; @else display: block; @endif">

    <div class="autosearch__wrap custom-scrollbar" >
        @isset($suggest[0])
            <p>возможно вы имели ввиду
                                @foreach($suggest as $test)
                    <a href="#" wire:click="goTo('{{ $test['text'] }}')">
                                        {!! $test['highlighted'] !!}
                                    </a>,
                @endforeach
                            </p>
        @endisset

        @isset($histories)
                <div class="autosearch__column autosearch__HISTORY">

                <ul>
                    @foreach($histories as $history)

                        <li style="color: gray; display: flex; align-items: center" ><svg height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M232 120C232 106.7 242.7 96 256 96C269.3 96 280 106.7 280 120V243.2L365.3 300C376.3 307.4 379.3 322.3 371.1 333.3C364.6 344.3 349.7 347.3 338.7 339.1L242.7 275.1C236 271.5 232 264 232 255.1L232 120zM256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0zM48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256z"/></svg>
                            <a href="https://market.armada.kz/search?q={{$history}}" class="px-2 p-1">
                            {{$history}}
                        </a>
                    </li>
                    @endforeach
                </ul>

        </div>
        @endisset


        @if(count($items)>0)
        <div class="autosearch__column autosearch__CATEGORIES">
            <span class="autosearch__column-title">{{__('messages.search.auto.category')}} </span>
            <div class="autosearch__column-wrap">
                <ul>
                    @foreach($items as $item)
                    <li><a href="https://armada.kz/item/{{$item->slug}}">
                            {{$item->title}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{--                        @if(Auth::check() and Auth::user()->role_id == \App\Models\UserRole::ADMIN)--}}
            {{--                            <div class="autosearch__SHOPS">--}}
            {{--                                <span class="autosearch__column-title">Магазины </span>--}}
            {{--                                <div class="autosearch__column-wrap" style="height:150px;overflow-y:scroll;"><!-- custom-scrollbar -->--}}
            {{--                                    <ul>--}}
            {{--                                        <li><a href="#" target="_blank"></a></li>--}}
            {{--                                    </ul>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        @endif--}}
        </div>
        @endisset
        <div class="autosearch__column">

               @if(count($products)>0)
            <div class="autosearch__PRODUCTS">
                <span class="autosearch__column-title">{{__('messages.search.auto.product')}} </span>
                <div class="autosearch__column-wrap"><!-- custom-scrollbar -->
                    <ul>

                        @foreach($products as $product)

                        <li class="product-card product-card--vertical" style="">
                            <article class="product-card__wrap">
                                <a href="https://armada.kz/product/{{$product->id}}-{{$product->slug}}" class="product-card__link">
                                    <div class="product-card__image">
{{--                                        <img class="lazy" src="" alt="Advantage image">--}}
                                        <picture>
                                            <source srcset="{{$product->getImages(0,'images','/img/logo-gray.png',true)}}" type="image/webp">
                                            <source srcset="{{$product->getImages(0,'images','/img/logo-gray.png',true)}}" type="image/png">
                                            <img class="lazy" src="" data-src="{{$product->getImages(0,'images','/img/logo-gray.png',true)}}" alt="Advantage image">
                                        </picture>
                                    </div>
                                    <div class="product-card__content product-card__content--wp">
                                        <h4 class="product-card__title">{{$product->title}}</h4>
                                        <span class="product-card__vendor">{{$product->store()->get()->pluck('title')->implode('')}}</span>
                                        <div class="price product-card__price">
                                            @if($product->is_discount == 1)
                                                @isset($product->discount)
                                            <strike class="price__previous"><span></span> <span
                                                        class="price__currency">{{$product->price}}</span></strike>
                                                    <span class="price__special"><span></span> <span
                                                                class="price__currency">{{$product->price-($product->price*($product->discount/100))}}</span></span>
                                                @endisset
                                            @else
                                                <span class="price__special"><span></span> <span
                                                            class="price__currency">{{$product->price}}</span></span>
                                            @endisset

                                        </div>
                                    </div>
                                </a>
                            </article>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>

        @if(count($stores)>0 && $stores != null)
                <div class="autosearch__column autosearch__SHOPS">
                        <span class="autosearch__column-title">{{__('messages.search.auto.store')}} </span>
                        <div class="autosearch__column-wrap">
                            <!-- custom-scrollbar -->
                            <ul>
                                  <li><a href="#">
                                    </a>
                                </li>

                                @foreach($stores as $store)

                                    <li>
                                    <a href="https://armada.kz/prodavcy/{{$store->slug}}" target="_blank">
                                        <div class="store_search_result">
{{--                                            <img class="search_image" width="65" height="48" src="{{'https://armada.kz/storage/'.$store->mini_img[0]}}" alt="logo">--}}
                                            <div class="d-flex flex-column product-card__content p-0">
                                                <span class="store_title">
                                                    {{$store->title}}
                                                </span>
                                                <span class="store_desc">
                                                    {{$store->mini_desc}}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
            @endif
</div>
</div>
</span>
