@extends('_layout')

@section('title', ( $subcatalog->meta_title ?? 'Информация о продукте' ) . " - ARMADA" )
@section('meta_description',( $subcatalog->meta_desc ?? 'ARMADA - мебельный торговый комплекс' ) )

@section('breadcrumb')
    @php
        $breadcrumbs[] = [  'route'=>route('home'),
                            'title'=>__('messages.main.home') ];
        $breadcrumbs[] = [  'route'=>route('catalogs',$subcatalog->catalog->slug),
                            'title'=>$subcatalog->catalog->title ];
        $breadcrumbs[] = [  'route'=>route('subcatalog',['slug'=>$subcatalog->slug]),
                            'title'=>$subcatalog->title ];
    @endphp
    @include('layouts.breadcrumb',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    @php
        $likesCount = Auth::check() ? \App\Http\Services\Service::likesCount() : null;
        $userBasket = Auth::check() ? \App\Http\Services\Service::userBasket() : null;
    @endphp
    @include('pages.catalogs._index_banners_subcatalog',['bannerList'=>$banner_subcategories,'height'=>'min-content'])
    @include('pages.catalogs._items')
    {{--    @include('pages.catalogs._subcategories')--}}
    @include('pages.catalogs._filter')
    @include('pages.catalogs._catalogs')
    @include('pages.catalogs._viewed')
    {{--    @include('pages.catalogs._about')--}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-catalog/catalog.min.css?v=').time() }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dest/page-catalog/catalog-min.js') }}"></script>
@endpush


