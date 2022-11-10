@extends('_layout')

@section('title','ARMADA - 3D Тур')

@section('breadcrumb')
    @php
        $breadcrumbs[] = [  'route'=>route('home'),
                            'title'=>__('messages.main.home') ];
        $breadcrumbs[] = [  'route'=>route('tour'),
                            'title'=>'3D тур'  ];
    @endphp
    @include('layouts.breadcrumb',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    <section class="container mb-5">
        <iframe src="https://my.matterport.com/show/?m=fiSpcG7MMvG" frameborder="0" style="width: 100%; height: 550px"></iframe>
        <iframe src="https://my.matterport.com/show/?m=SvoLZeAVrb2" frameborder="0" style="width: 100%; height: 550px"></iframe>
        <iframe src="https://my.matterport.com/show/?m=CDJxYJV7rKc" frameborder="0" style="width: 100%; height: 550px"></iframe>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-info/info.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dest/page-home/home.min.js') }}"></script>
@endpush


