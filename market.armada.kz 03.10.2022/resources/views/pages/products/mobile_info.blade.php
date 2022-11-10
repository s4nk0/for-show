<style>
    .mobile_product_info{
        display: flex;
        flex-direction: column;
    }
    .mobile_product_price{
        display: flex;
        justify-content: space-between;
        margin: 0.375rem;
        background-color: #B8BDCB;
        width: 113px;
        /* padding: 2px 8px; */
        padding: 10px;
        border-radius: 5px;
    }
    .mobile_product_price .price__previous{
        color: #FFFFFF;
        font-style: normal;
        /*font-weight: 400;*/
        /*font-size: 12.5055px;*/
        /*line-height: 17px;*/
    }
    .price_mobile_info{
        font-weight: 700;
        font-size: 18px;
    }
    .price__previous.mobile_price{
        font-weight: 400;
        font-size: 16px;
        line-height: 17px;
    }
    #mobile_add_to_cart_btn{
        max-width: 100% !important;
        display: flex;
        flex-direction: column;
        margin: 0.375rem;
    }
    .mobile_btn_price_info{
        margin: 0;
        font-weight: 400;
        font-size: 14px;
        text-transform: lowercase;
    }
    .mobile_add_to_cart_btn_text{
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        text-transform: capitalize;
        display: flex;
    }

    .mobile_add_to_cart_btn_text .btn_to_basket{
        text-transform: lowercase
    }
</style>

<div class="mobile_product_info container">
    <div class="mobile_product_price mt-4">
        @if($product->discount != null)
            <strike class="price__previous mobile_price">
                {{ number_format($product->price, 0, ',', ' ') }}<span class="currency">тг</span>
            </strike>
        @endif

    </div>
    <button type="submit"
            id="mobile_add_to_cart_btn"
            class="btn_to_basket btn btn-primary font-weight-semibold product__add-to-card ARMADA_PRODUCT_CART_{{ $product->id }}_CH"
            data-chosen='false' data-product-information='{{ $product->toJson() }}'>
        <div class="mobile_add_to_cart_btn_text">
            <p id="add_cart_dummy_text" style="margin: 0">Добавить&nbsp</p>
            <span class="btn_to_basket"
                  data-chosen='false'
                  data-product-information='{{ $product->toJson() }}'>
           Добавить в козину
       </span>

        </div>

{{--        <img src="{{asset('img/svg/mobile_nav/basket.svg')}}" alt="basket">--}}
        <p class="mobile_btn_price_info">
            @if($product->discount != null)
                {{ $product->price*(1-$product->discount/100) }} тг
            @elseif($product->price != 0)
                @if($product->is_price_from == true)
                    от {{ number_format($product->price, 0, ',', ' ') }}
                @else
                    {{ number_format($product->price, 0, ',', ' ') }}
                @endif
                <p style="margin: 0" class="currency">тг</p>
            @else
                <p style="font-size: 14px;margin: 0">{{__('messages.confirm_with_seller')}}</p>
            @endif
        </p>
    </button>
</div>
