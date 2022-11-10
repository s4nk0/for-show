@extends('_layout')

@section('title','ARMADA - Создать кабинет на ARMADA.KZ')

@section('breadcrumb')
    @php
        $breadcrumbs[] = [  'route'=>route('home'),
                            'title'=>__('messages.main.home') ];
        $breadcrumbs[] = [  'route'=>route('forSeller'),
                            'title'=>__('messages.main.footer.seller.link.create_account')  ];
    @endphp
    @include('layouts.breadcrumb',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')

    <div class="container">
        <h2 class="page-title mb-4">{{__('messages.forSeller.title')}}</h2>

        <div class="care row my-5">
            <div class="col-lg-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-care-1-list" data-toggle="list" href="#list-care-1" role="tab" aria-controls="care-">{{__('messages.forSeller.tab1')}}</a>
                    <a class="list-group-item list-group-item-action" id="list-care-3-list" data-toggle="list" href="#list-care-3" role="tab" aria-controls="care-">{{__('messages.forSeller.tab2')}}</a>
                    <a class="list-group-item list-group-item-action" id="list-care-4-list" data-toggle="list" href="#list-care-4" role="tab" aria-controls="care-">{{__('messages.forSeller.tab3')}}</a>
                    <a class="list-group-item list-group-item-action" id="list-care-5-list" data-toggle="list" href="#list-care-5" role="tab" aria-controls="care-">{{__('messages.forSeller.tab4')}}</a>
                    <a class="list-group-item list-group-item-action" id="list-care-6-list" data-toggle="list" href="#list-care-6" role="tab" aria-controls="care-">{{__('messages.forSeller.tab5')}}</a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-care-1" role="tabpanel" aria-labelledby="list-care-1">
                        <p>{{__('messages.forSeller.tab1.content1.first')}}<a target="_blank" class="link-primary" href="{{route('login')}}">{{route('login')}}</a> {!! __('messages.forSeller.tab1.content1.second') !!}</p>
                        <img src="{{ asset('img/instructions/for-seller/1.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        <p>{!! __('messages.forSeller.tab1.content2') !!}</p>
                        <img src="{{ asset('img/instructions/for-seller/2.png') }}" alt="Страница входа для продавца" class="img-responsive border my-4">
                        <p>{!!__('messages.forSeller.tab1.content3')  !!}</p>
                        <img src="{{ asset('img/instructions/for-seller/3.png') }}" alt="Страница регистрации продавца" class="img-responsive border my-4">
                    </div>
                    <div class="tab-pane fade" id="list-care-3" role="tabpanel" aria-labelledby="list-care-3">
                        <p>
                            {!! __('messages.forSeller.tab2.content1') !!}
                        </p>
                        <img src="{{ asset('img/instructions/for-seller/4.png') }}" alt="Создание магазина" class="img-responsive border my-4">
                        <p>{!! __('messages.forSeller.tab2.content2') !!}</p>
                        <img src="{{ asset('img/instructions/for-seller/5.png') }}" alt="Создание магазина" class="img-responsive border my-4">
                        <p>
                            {!! __('messages.forSeller.tab2.content3') !!}
                        </p>
                        <img src="{{ asset('img/instructions/for-seller/6.png') }}" alt="Создание магазина" class="img-responsive border my-4">
                        <p>
                            {!! __('messages.forSeller.tab2.content4') !!}
                        </p>
                        <img src="{{ asset('img/instructions/for-seller/7.png') }}" alt="Создание магазина" class="img-responsive border my-4">
                        {!!  __('messages.forSeller.tab2.content5') !!}
                        <img src="{{ asset('img/instructions/for-seller/8.png') }}" alt="Создание магазина" class="img-responsive border my-4">
                        <p>{!!  __('messages.forSeller.tab2.content6') !!}</p>
                        <img src="{{ asset('img/instructions/for-seller/9.png') }}" alt="Редактирование магазина" class="img-responsive border my-4">
                        <p>{!!  __('messages.forSeller.tab2.content7') !!}</p>
                        <img src="{{ asset('img/instructions/for-seller/10.png') }}" alt="Редактирование магазина" class="img-responsive border my-4">
                        <p>{!!  __('messages.forSeller.tab2.content8') !!}</p>
                        <img src="{{ asset('img/instructions/for-seller/11.png') }}" alt="Редактирование магазина" class="img-responsive border my-4">
                        <p>{!!  __('messages.forSeller.tab2.content9') !!}</p>
                        <img src="{{ asset('img/instructions/for-seller/12.png') }}" alt="Редактирование магазина" class="img-responsive border my-4">
                    </div>
                    <div class="tab-pane fade" id="list-care-4" role="tabpanel" aria-labelledby="list-care-4">
                        <p>{!! __('messages.forSeller.tab3.content1') !!}</p>
                        <img src="{{ asset('img/instructions/for-seller/13.png') }}" alt="Редактирование товара" class="img-responsive border my-4">
                        <p>{!! __('messages.forSeller.tab3.content2') !!}</p>
                        <p>
                            {!! __('messages.forSeller.tab3.content3') !!}
                        </p>
                        <img src="{{ asset('img/instructions/for-seller/14.png') }}" alt="Редактирование товара" class="img-responsive border my-4">
                        <p>
                            {!! __('messages.forSeller.tab3.content4') !!}
                        </p>
                        <img src="{{ asset('img/instructions/for-seller/15.png') }}" alt="Редактирование товара" class="img-responsive border my-4">
                        <p>
                            {!! __('messages.forSeller.tab3.content5') !!}
                        </p>
                        <img src="{{ asset('img/instructions/for-seller/16.png') }}" alt="Редактирование товара" class="img-responsive border my-4">
                        <p> {!! __('messages.forSeller.tab3.content6') !!}</p>
                        <img src="{{ asset('img/instructions/for-seller/17.png') }}" alt="Редактирование товара" class="img-responsive border my-4">
                        <p>{!! __('messages.forSeller.tab3.content7') !!}</p>
                        <img src="{{ asset('img/instructions/for-seller/18.png') }}" alt="Редактирование товара" class="img-responsive border my-4">
                        <p>{!! __('messages.forSeller.tab3.content8') !!}</p>
                        <img src="{{ asset('img/instructions/for-seller/19.png') }}" alt="Редактирование товара" class="img-responsive border my-4">
                    </div>
                    <div class="tab-pane fade" id="list-care-5" role="tabpanel" aria-labelledby="list-care-5">
                        <p>{!!__('messages.forSeller.tab4.content1')!!}</p>
                        <img src="{{ asset('img/instructions/for-seller/20.png') }}" alt="Редактирование товара" class="img-responsive border my-4">
                    </div>
                    <div class="tab-pane fade" id="list-care-6" role="tabpanel" aria-labelledby="list-care-6">
                        <p>{!! __('messages.forSeller.tab5.content1') !!}</p>
                        <img src="{{ asset('img/instructions/for-seller/21.png') }}" alt="Редактирование товара" class="img-responsive border my-4">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-info/info.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dest/page-info/info-min.js') }}"></script>
@endpush
