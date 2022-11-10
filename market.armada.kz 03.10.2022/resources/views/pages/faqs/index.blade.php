@extends('_layout')

@section('title','ARMADA - Вопрос/Ответ')

@section('breadcrumb')
    @php
        $breadcrumbs[] = [  'route'=>route('home'),
                            'title'=>__('messages.main.home') ];
        $breadcrumbs[] = [  'route'=>route('faqs'),
                            'title'=>__('messages.main.faqs')];
    @endphp
    @include('layouts.breadcrumb',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    <section class="section container mb-5">
        <div class="section__header d-block">
            <h5 class=" text-center d-block w-100">{{__('messages.faqs.title')}}</h5>
            <h3 class="section__subtitle text-center d-block w-100">{{__('messages.faqs.subtitle')}}</h3>
        </div>
        <div class=" section__content">
           {!!__('messages.faqs.content')!!}
            <ul class="faq__items mt-4 mb-4">
                @foreach($faqs->where('type','general') as $faq)
                    <li class="faq__item rounded">
                        <b class="faq__question font-weight-semibold">
                            <span>{{ $faq->title }}</span>
                            <span class="faq__expand"></span>
                        </b>
                        <div class="faq__response mt-md-2 mb-0">
                            {!! $faq->description !!}
                        </div>
                    </li>
                @endforeach
            </ul>

            <h3 class="d-block w-100 mt-5 ">Маркетплейс «ARMADA»</h3>

            <ul class="faq__items mt-5 mb-5">
                @foreach($faqs->where('type','marketplace') as $faq)
                    <li class="faq__item rounded">
                        <b class="faq__question font-weight-semibold">
                            <span>{{ $faq->title }}</span>
                            <span class="faq__expand"></span>
                        </b>
                        <div class="faq__response mt-md-2 mb-0">
                            {!! $faq->description !!}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-info/info.min.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/dest/page-info/info-min.js') }}"></script>
@endpush


