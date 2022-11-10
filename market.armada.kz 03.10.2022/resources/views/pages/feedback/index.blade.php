@extends('_layout')

@section('title','ARMADA - Блог')

{{--@section('breadcrumb')
    @php
        $breadcrumbs[] = [  'route'=>route('home'),
                            'title'=>__('messages.main.home') ];
        $breadcrumbs[] = [  'route'=>route('news.index'),
                            'title'=>__('messages.main.news') ];
    @endphp
    @include('layouts.breadcrumb',['breadcrumbs'=>$breadcrumbs])
@endsection--}}

@section('content')
    <section class="news page-news__news container">
        <h2 class="page-title mt-5">{{__('messages.product.leave_review')}}</h2>
        <form action="{{ route('site.feedback') }}" class="callback needs-validation mb-5" method="POST">
            @csrf

            <div class="add-review reviews__add-review pb-0">
                <div class="d-flex align-items-center mb-4">

                    <div class="review_rating">
                            <span class="rating-group">
                                @foreach([1,2,3,4,5] as $star)
                                    <label aria-label="{{ $star }} star" class="mb-0 rating__label" for="add-review-{{ $star }}"><i class="rating__icon rating__icon--star fas fa-star"></i></label>
                                    <input class="rating__input" name="rating" id="add-review-{{ $star }}" value="{{ $star }}" type="radio">
                                @endforeach
                            </span>
                    </div>
                </div>
                <div class="mt-0">


                    <div>
                        <div class="md-form mb-0 md-outline input-with-pre-icon">
                            <svg class="input-prefix" width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.5 0C5.0187 0 3 2.01871 3 4.50002C3 6.98133 5.0187 9 7.5 9C9.9813 9 12 6.98129 12 4.49998C12 2.01867 9.9813 0 7.5 0ZM7.5 7.87503C5.63903 7.87503 4.125 6.36099 4.125 4.50002C4.125 2.63904 5.63903 1.125 7.5 1.125C9.36097 1.125 10.875 2.63904 10.875 4.50002C10.875 6.36099 9.36097 7.87503 7.5 7.87503Z" fill="#737373"/>
                                <path d="M7.50018 8.36719C3.57849 8.36719 0.387939 11.5577 0.387939 15.4794V15.9999H14.6124V15.4795C14.6124 11.5577 11.4219 8.36719 7.50018 8.36719ZM1.45084 14.959C1.7157 11.854 4.32769 9.40801 7.50018 9.40801C10.6727 9.40801 13.2847 11.8539 13.5495 14.959H1.45084Z" fill="#737373" stroke="#737373" stroke-width="0.2"/>
                            </svg>
                            <input type="text" name="name" placeholder="{{__('messages.your_name')}}" required class="form-control">
                        </div>
                    </div>
                    
                    <div>
                        <div class="md-form mb-0 pink-textarea">
                            <textarea name="comment" placeholder="{{__('messages.product.review.comment')}}" rows="5" required class="mt-3 md-textarea form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="application__error-messages color--accent" style="display: none"></div>
                </div>
            </div>
            <button  type="submit" class="button btn-success">{{__('messages.send')}}</button>
        </form>
    </section>
@endsection




