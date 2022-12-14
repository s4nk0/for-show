<li class="order-item orders__item col-12 col-md-6 col-xxl-12">
    <div class="order-item__wrap bg-light rounded" data-order-status="{{ $order->orderStatus->user_color }}"><!-- completed = green, canceled = red, expect = orange, frozen = blue  -->
        <div class="orders__column order-item__number">
            <div class="order-item__title">{{__('messages.user.order.id')}}</div>
            <span class="order-item__status-bar"></span>
            <span>№ {{ $order->id }}</span>
            <div class="order-item__status">{{-- $order->status->title_ru --}}</div>
        </div>
        <div class="orders__column order-item__customer">
            <div class="order-item__title">{{__('messages.user.order.status')}}</div>
            @if( app()->getLocale() == 'kk')
                <span>{!! $order->orderStatus->title_kz !!}</span>
            @else
                <span>{!! $order->orderStatus->title_ru !!}</span>
            @endif

        </div>
        <div class="orders__column order-item__date">
            <div class="order-item__title">{{__('messages.user.order.date')}}</div>
            <span>{{ $order->created_at->format('d.m.Y') }}</span>
        </div>
{{--        <div class="orders__column order-item__customer">--}}
{{--            <div class="order-item__title">Покупатель</div>--}}
{{--            <span>{!! $order->fio !!}</span>--}}
{{--            <p class="order-item__customer-phone">{!! $order->phone !!}</p>--}}
{{--        </div>--}}
        <div class="orders__column order-item__seller">
            <div class="order-item__title">{{__('messages.user.order.seller')}}</div>
            <span>{{ $order->store->title }}</span>
        </div>
        <div class="orders__column order-item__total-price">
            <div class="order-item__title">{{__('messages.user.order.total')}}</div>
            <span>{{ number_format($order->price, 0, ',', ' ') }} <span class="currency">тг.</span></span>
        </div>
        <div class="orders__column order-item__thumbnails">
            <span class="order-item__title">{{__('messages.user.order.product')}}</span>
            <div class="order-item__thumbnail">
                @if(isset($order->product->id) && isset($order->product->slug))
                    <a href="{{ route('product', ['id' => $order->product->id, 'slug' => $order->product->slug ?? '--']) }}" target="_blank">
                        <img src="{{ $order->product->getImages() }}" alt="">
                    </a>
                @else
                    <img src="{{ $order->product->getImages() }}" alt="">
                @endif

                @if($order->product->slug == null) {{__('messages.user.order.not_found')}} @endif
            </div>
{{--            <ul>--}}
{{--                <li class="order-item__thumbnail">--}}
{{--                    <a href="{{ route('product',$order->product->slug) }}" target="_blank">--}}
{{--                        @foreach($order->product->images as $image)--}}
{{--                            @if($loop->first)--}}
{{--                                <img src="{{ '/storage/'.$image }}" alt="{{ ucfirst(strtolower($order->product->title)) }}">--}}
{{--                            @else--}}
{{--                                @break--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="order-item__thumbnail">--}}
{{--                    <a href="#">--}}
{{--                        <img src="{{ asset('img/products/1.png') }}" alt="">--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
        </div>
    </div>
</li>
