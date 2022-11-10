<div class="float_info container" id="product_float_info">
    <div class="float_wrapper" id="product_float_info_wrapper">
        <div class="float__img">
            <img src="{{$product->getImages(0,'images', '/img/logo-gray.png',true)}}" alt="">
            @if($product->is_discount === 1 and $product->discount != null)
                <span class="product-card__sticker product-card__sticker--sale">{{'-'.$product->discount.'%'}}</span>
            @endif
        </div>
        <div class="float_product_info">
            <p class="h5" id="float_product_title"></p>
            <div class="review_rating">
               <span class="rating-group">
                   @foreach([1,2,3,4,5] as $star)
                       <label aria-label="{{ $star }} star" class="rating__label" for="rating-{{ $star }}">
                           <i class="rating__icon rating__icon--star fas fa-star" @if($rating < $star) style="color:#ddd" @endif></i>
                       </label>
                   @endforeach
               </span>
            </div>
        </div>
        <div class="float_product_price">
            @if($product->discount != null)
                <strike class="price__previous mobile_price">
                    {{ number_format($product->price, 0, ',', ' ') }}<span class="currency">тг.</span>
                </strike>
            @endif
            <span class="price__special price_mobile_info @if($product->price == 0) mb-2 @endif">
                @if($product->discount != null)
                    {{ $product->price*(1-$product->discount/100) }}<span class="currency">тг</span>
                @elseif($product->price != 0)
                    @if($product->is_price_from == true)
                        от {{ number_format($product->price, 0, ',', ' ') }}
                    @else
                        {{ number_format($product->price, 0, ',', ' ') }}
                    @endif
                    <span class="currency">тг</span>
                @else
                    <span style="font-size: 14px">{{__('messages.confirm_with_seller')}}</span>
                @endif
        </span>
        </div>

        <button type="submit"
                class="btn_to_basket btn btn-primary font-weight-semibold product__add-to-card ARMADA_PRODUCT_CART_{{ $product->id }}_CH add_to_cart_show"
                data-chosen='false' data-product-information='{{ $product->toJson() }}'>
                            <span class="btn_to_basket"
                                  data-product-information='{{ $product->toJson() }}'>Купить</span>
            <svg class="btn_to_basket" data-product-information='{{ $product->toJson() }}' width="16"
                 height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M15.1783 6.20312C14.8439 5.78438 14.3877 5.55312 13.8939 5.55312H12.7658C12.6596 2.65937 10.5627 0.34375 8.00018 0.34375C5.43768 0.34375 3.34081 2.65937 3.23456 5.55312H2.10643C1.61268 5.55312 1.15643 5.78438 0.822058 6.20312C0.400183 6.72813 0.247058 7.45938 0.406433 8.1625L1.75956 14.125C1.96268 15.025 2.66268 15.6562 3.45956 15.6562H12.5377C13.3346 15.6562 14.0346 15.0281 14.2377 14.125L15.5939 8.1625C15.7533 7.45938 15.6002 6.72813 15.1783 6.20312ZM8.00018 1.61875C9.86268 1.61875 11.3877 3.3625 11.4877 5.55312H4.51268C4.61268 3.36562 6.13768 1.61875 8.00018 1.61875ZM14.3502 7.87813L12.9971 13.8438C12.9283 14.15 12.7314 14.3813 12.5408 14.3813H3.45956C3.26893 14.3813 3.07206 14.15 3.00331 13.8438L1.65018 7.87813C1.57831 7.5625 1.53456 6.82812 2.10643 6.82812H13.8939C14.5096 6.82812 14.4221 7.5625 14.3502 7.87813Z"
                    fill="white"/>
                <path
                    d="M4.83477 8.09668C4.48164 8.09668 4.19727 8.38105 4.19727 8.73418V12.7186C4.19727 13.0717 4.48164 13.3561 4.83477 13.3561C5.18789 13.3561 5.47227 13.0717 5.47227 12.7186V8.73418C5.47539 8.38418 5.18789 8.09668 4.83477 8.09668Z"
                    fill="white"/>
                <path
                    d="M7.9251 8.09668C7.57197 8.09668 7.2876 8.38105 7.2876 8.73418V12.7186C7.2876 13.0717 7.57197 13.3561 7.9251 13.3561C8.27823 13.3561 8.5626 13.0717 8.5626 12.7186V8.73418C8.5626 8.38418 8.2751 8.09668 7.9251 8.09668Z"
                    fill="white"/>
                <path
                    d="M11.0125 8.09668C10.6594 8.09668 10.375 8.38105 10.375 8.73418V12.7186C10.375 13.0717 10.6594 13.3561 11.0125 13.3561C11.3656 13.3561 11.65 13.0717 11.65 12.7186V8.73418C11.65 8.38418 11.3656 8.09668 11.0125 8.09668Z"
                    fill="white"/>
            </svg>
        </button>
        <button type="button" class="button btn-outline-dark product__callback" data-toggle="modal"
                data-target="#callback"><!--  -->
            {{__('messages.product.online_help')}}
        </button>
    </div>
</div>
@push('scripts')
    <script>
        {
            function truncate(str, max) {
                return str.length > max ? str.substr(0, max-1) + '…' : str;
            }

            $('#float_product_title').text(truncate("{{$product->title}}",20))
            const product_vendor_div = $('#product__vendor_scroll')
            $(window).scroll(function() {
                let hT = product_vendor_div.offset().top,
                    hH = product_vendor_div.outerHeight(),
                    wH = $(window).height(),
                    wS = $(this).scrollTop();
                if (wS > (hT+hH-wH)){
                    $('#product_float_info').css("max-height", "500px")

                    if($(window).width() > 1023.98){
                        $('#product_float_info_wrapper').css({"display":"grid","max-height":"unset"})
                    }else{
                        $('#product_float_info_wrapper').css({"display":"flex","max-height":"unset"})
                    }

                }else{
                    $('#product_float_info_wrapper').css("display", "none")
                    $('#product_float_info').css("max-height", "0")
                }
            });
        }
    </script>
@endpush
