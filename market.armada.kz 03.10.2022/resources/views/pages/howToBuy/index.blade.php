@extends('_layout')

@section('title','ARMADA - Как покупать на ARMADA.KZ')

@section('breadcrumb')
    @php
        $breadcrumbs[] = [  'route'=>route('home'),
                           'title'=>__('messages.main.home') ];
        $breadcrumbs[] = [  'route'=>route('howToBuy'),
                            'title'=>__('messages.main.buyer.howToBuy')  ];
    @endphp
    @include('layouts.breadcrumb',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')

    <div class="container">
        <h2 class="page-title mb-4">{{__('messages.howToBuy.title')}}</h2>

        <div class="care row my-5">
            <div class="col-lg-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-care-1-list" data-toggle="list" href="#list-care-1" role="tab" aria-controls="care-">{{__('messages.howToBuy.tab1')}}</a>
                    <a class="list-group-item list-group-item-action" id="list-care-3-list" data-toggle="list" href="#list-care-3" role="tab" aria-controls="care-">{{__('messages.howToBuy.tab2')}}</a>
                    <a class="list-group-item list-group-item-action" id="list-care-4-list" data-toggle="list" href="#list-care-4" role="tab" aria-controls="care-">{{__('messages.howToBuy.tab3')}}</a>
                    <a class="list-group-item list-group-item-action" id="list-care-5-list" data-toggle="list" href="#list-care-5" role="tab" aria-controls="care-">{{__('messages.howToBuy.tab4')}}</a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-care-1" role="tabpanel" aria-labelledby="list-care-1">
                        {!!__('messages.howToBuy.tab1.content1')!!}
                        <img src="{{ asset('img/instructions/for-buyer/1.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        {!!__('messages.howToBuy.tab1.content2')!!}
                        <img src="{{ asset('img/instructions/for-buyer/2.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        {!!__('messages.howToBuy.tab1.content3')!!}
                        <img src="{{ asset('img/instructions/for-buyer/3.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        {!!__('messages.howToBuy.tab1.content4')!!}
                        <img src="{{ asset('img/instructions/for-buyer/4.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        {!!__('messages.howToBuy.tab1.content5')!!}
                        <img src="{{ asset('img/instructions/for-buyer/5.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        {!!__('messages.howToBuy.tab1.content6')!!}</div>
                    <div class="tab-pane fade" id="list-care-3" role="tabpanel" aria-labelledby="list-care-3">
                        {!!__('messages.howToBuy.tab2.content1')!!}
                        <img src="{{ asset('img/instructions/for-buyer/7.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        {!! __('messages.howToBuy.tab2.content2') !!}
                        <img src="{{ asset('img/instructions/for-buyer/8.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        {!! __('messages.howToBuy.tab2.content3') !!}
                        <img src="{{ asset('img/instructions/for-buyer/12.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        {!! __('messages.howToBuy.tab2.content4') !!}
                        <img src="{{ asset('img/instructions/for-buyer/9.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        <img src="{{ asset('img/instructions/for-buyer/10.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        <img src="{{ asset('img/instructions/for-buyer/11.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                    </div>
                    <div class="tab-pane fade" id="list-care-4" role="tabpanel" aria-labelledby="list-care-4">
                        <p>{{__('messages.howToBuy.tab3.content1')}}</p>
                        <ul class="custom-ul">
                            {!! __('messages.howToBuy.tab3.content2') !!}
                        </ul>
                        <img src="{{ asset('img/instructions/for-buyer/13.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        <img src="{{ asset('img/instructions/for-buyer/14.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        <p>{{__('messages.howToBuy.tab3.content3')}}</p>
                        <img src="{{ asset('img/instructions/for-buyer/15.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        <p>{!! __('messages.howToBuy.tab3.content4') !!}</p>
                        <img src="{{ asset('img/instructions/for-buyer/16.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                    </div>
                    <div class="tab-pane fade" id="list-care-5" role="tabpanel" aria-labelledby="list-care-5">
                        <p>{{__('messages.howToBuy.tab4.content1')}}</p>
                        <img src="{{ asset('img/instructions/for-buyer/17.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        <p>{{__('messages.howToBuy.tab4.content2')}}</p>
                        <img src="{{ asset('img/instructions/for-buyer/18.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        <img src="{{ asset('img/instructions/for-buyer/19.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        {!! __('messages.howToBuy.tab4.content3') !!}
                        <img src="{{ asset('img/instructions/for-buyer/20.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        <p>{{__('messages.howToBuy.tab4.content4')}}</p>
                        <img src="{{ asset('img/instructions/for-buyer/21.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
                        <p>{{__('messages.howToBuy.tab4.content5')}}</p>
                        <img src="{{ asset('img/instructions/for-buyer/22.png') }}" alt="Стандартная страница входа" class="img-responsive border my-4">
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
