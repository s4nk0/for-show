@extends('_layout')

@section('title',"ARMADA - поиск" )

@section('breadcrumb')
    @php
        $breadcrumbs[] = [ 'route'=>route('home'),
                           'title'=>__('messages.main.home') ];
        $breadcrumbs[] = [ 'route'=>route('searchGet'),
                           'title'=>__('messages.search') ];
    @endphp
    @include('layouts.breadcrumb',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    {{--    @include('pages.catalogs._subcategories')--}}
    @include('pages.search._catalog')
{{--    @include('pages.search._viewed')--}}
{{--    @include('pages.catalogs._about')--}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-catalog/catalog.min.css?v=').time() }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dest/page-catalog/catalog-min.js') }}"></script>
@endpush


