@extends('_layout')

@section('title','ARMADA - Корзина')



@section('content')
    <section class="section container mb-5">
        <h5 class="mt-5">{{__('messages.cart')}}</h5>
        <hr/>
        <div class="cart_checkbox">
            <div class="custom-control custom-checkbox">
                <input type="checkbox"
                       class="custom-control-input"
                       id="cart_select_all"
                >
                <label class="custom-control-label ml-2" for="cart_select_all">Выбрать все</label>
            </div>
            <span class="ml-3" id="cart_clear_select">Удалить выбранные</span>
        </div>
        <div class=" section__content mt-0 d-flex justify-content-between cart">
            <input type="hidden" name="token" value="{{ csrf_token() }}" class="TOKEN">

            <ul class="cart__items bg-light BASKET_PRODUCT_parent">

                <li class="cart-product cart__item BASKET_PRODUCT" style='display: none'>
                    <div class="cart-product__wrap">
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox"
                               name="cart_item[]"
                               class="custom-control-input BASKET_PRODUCT_checkbox"
                               >
                            <label class="custom-control-label ml-2 BASKET_PRODUCT_checkbox_label" for=""></label>
                        </div>
                        <div class="cart-product__image">
                            <img class="BASKET_PRODUCT_image" src="{{ asset('img/categories/17.png') }}"
                                 alt="Product image">
                        </div>
                        <div class="cart-product__content">
                            <div class="cart-product__header">
                                <div>
                                    <h4 class="cart-product__name BASKET_PRODUCT_title"></h4>
                                    <ul class="cart-product__info">
                                        <li class="cart-product__info-item">
                                            <span>{{__('messages.user.order.seller')}}:</span>
                                            <span><a href="#" class="BASKET_PRODUCT_store"></a></span>
                                        </li>
                                        <!--<li class="cart-product__info-item">
                                            <span>Модель:</span>
                                            <span><a href="#">Magic Dreams</a></span>
                                        </li>-->
                                        <li class="cart-product__info-item">
                                            <span>Артикул:</span>
                                            <span><a href="#" class="BASKET_PRODUCT_articul"></a></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="cart-product__delete BASKET_PRODUCT_delete">
                                    <svg class="BASKET_PRODUCT_delete" width="20" height="20" viewBox="0 0 20 20"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle class="BASKET_PRODUCT_delete" cx="10" cy="10" r="10" fill="#E0001A"
                                                fill-opacity="0.5"/>
                                        <path class="BASKET_PRODUCT_delete" fill-rule="evenodd" clip-rule="evenodd"
                                              d="M6.22776 6.22776C6.28001 6.17537 6.34208 6.13381 6.41042 6.10545C6.47876 6.0771 6.55202 6.0625 6.62601 6.0625C6.69999 6.0625 6.77325 6.0771 6.84159 6.10545C6.90993 6.13381 6.972 6.17537 7.02426 6.22776L10.001 9.20563L12.9778 6.22776C13.0301 6.17546 13.0921 6.13397 13.1605 6.10567C13.2288 6.07736 13.302 6.06279 13.376 6.06279C13.45 6.06279 13.5232 6.07736 13.5915 6.10567C13.6599 6.13397 13.722 6.17546 13.7743 6.22776C13.8266 6.28005 13.868 6.34214 13.8963 6.41047C13.9246 6.47881 13.9392 6.55204 13.9392 6.62601C13.9392 6.69997 13.9246 6.77321 13.8963 6.84154C13.868 6.90987 13.8266 6.97196 13.7743 7.02426L10.7964 10.001L13.7743 12.9778C13.8266 13.0301 13.868 13.0921 13.8963 13.1605C13.9246 13.2288 13.9392 13.302 13.9392 13.376C13.9392 13.45 13.9246 13.5232 13.8963 13.5915C13.868 13.6599 13.8266 13.722 13.7743 13.7743C13.722 13.8266 13.6599 13.868 13.5915 13.8963C13.5232 13.9246 13.45 13.9392 13.376 13.9392C13.302 13.9392 13.2288 13.9246 13.1605 13.8963C13.0921 13.868 13.0301 13.8266 12.9778 13.7743L10.001 10.7964L7.02426 13.7743C6.97196 13.8266 6.90987 13.868 6.84154 13.8963C6.77321 13.9246 6.69997 13.9392 6.62601 13.9392C6.55204 13.9392 6.47881 13.9246 6.41047 13.8963C6.34214 13.868 6.28005 13.8266 6.22776 13.7743C6.17546 13.722 6.13397 13.6599 6.10567 13.5915C6.07736 13.5232 6.06279 13.45 6.06279 13.376C6.06279 13.302 6.07736 13.2288 6.10567 13.1605C6.13397 13.0921 6.17546 13.0301 6.22776 12.9778L9.20563 10.001L6.22776 7.02426C6.17537 6.972 6.13381 6.90993 6.10545 6.84159C6.0771 6.77325 6.0625 6.69999 6.0625 6.62601C6.0625 6.55202 6.0771 6.47876 6.10545 6.41042C6.13381 6.34208 6.17537 6.28001 6.22776 6.22776Z"
                                              fill="white"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="cart-product__footer">
                                <span class="quantity cart-product__quantity">
                                    <span class="quantity__title">{{__('messages.count')}}:</span>
                                    <span class="quantity__input-wrap">
                                        <span class="quantity__operation quantity__operation--plus BASKET_PRODUCT_plus">+</span>
                                        <input type="number" class="quantity__input BASKET_PRODUCT_count"
                                               value="1">
                                        <span class="quantity__operation quantity__operation--minus BASKET_PRODUCT_minus">-</span>
                                    </span>
                                </span>
                                <div class="cart-product__total">
                                    <span class="price cart-product__price">
                                        <strike class="price__previous">
                                            <span class="BASKET_PRODUCT_price"></span>
                                            <span class="currency">тг.</span></strike>
                                        <span class="price__special">
                                            <span class="BASKET_PRODUCT_price_2"></span>
                                            <span class="currency">тг.</span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="cart__total bg-light">
                {{--                    <button data-dismiss="modal" aria-label="Close" class="button btn-outline-grey rounded cart__continue">Продолжить покупки</button>--}}
                <div class="cart__total-wrap px-4">
                    <div class="order_btn_wrap ">
                        @auth
                            <a href="{{ route('orders') }}"
                               class="busket_submit button btn-primary w-100 d-flex justify-content-center">{{__('messages.cart.apply_order')}}</a>
                        @else
                            <a href="{{ route('login') }}"
                               id="cart_redirect"
                               class="busket_submit button btn-primary w-100 d-flex justify-content-center">{{__('messages.cart.apply_order')}}</a>
                        @endauth
                    </div>
                    <hr class="w-100"/>

                    <p class="h5 mb-2">{{__('messages.cart.you_cart')}} </p>
                    <div class="cart__total_info mt-3">
                        <span style="font-size: 17px">{{__('messages.count')}}: </span>
                        <span class="price">
                                <span class="price__current"><span class="BASKET_total_count"></span></span>
                            </span>
                    </div>
                    <div class="cart__total_info mt-3">
                        <span style="font-size: 17px">{{__('messages.order.for_pay')}}: </span>
                        <span class="price">
                                <span class="price__current"><span class="BASKET_PRODUCT_final_price"></span> <span
                                        class="currency">тг.</span></span>
                            </span>
                    </div>

                    {{--                            <form action="{{ route('orderPost') }}" class="order__form row" method="POST">--}}
                    {{--                                @csrf--}}

                    <input type="hidden" name="products" class='ALL_ORDERS'>


                    {{--                    @auth data-toggle="modal" data-target="#cardModal" --}}
                    {{--                    @else data-toggle="modal" data-target="#login" --}}
                    {{--                    @endauth--}}
                    {{--                            </form>--}}
                </div>
            </div>
        </div>

    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-info/info.min.css?v.').time() }}">
    <style>
        .cart_checkbox{display: flex;    align-items: center;margin-bottom: 10px}
        .cart_checkbox span {
             text-decoration: underline;
            color: red;
            font-size: 15px;
            cursor: pointer;
        }
        .custom-checkbox .custom-control-label:before {
            background: #c5c4c4;
        }
    </style>
@endpush

@push('scripts')
    <script>
{{--       For Redirecting user to order page after auth, user.info.index-->page.order.index   --}}
        $('#cart_redirect').click(function (){
            sessionStorage.setItem('redirect_cart_order',true)
        })
    </script>
@endpush


