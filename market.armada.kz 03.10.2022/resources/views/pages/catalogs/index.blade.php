@extends('_layout')

@section('title', ( $catalog->meta_title ?? 'Информация о продукте' ) . " - ARMADA"  )
@section('meta_description',( $catalog->meta_desc ?? 'ARMADA - мебельный торговый комплекс' ) )

@section('breadcrumb')
    @php
        $breadcrumbs[] = [  'route'=>route('home'),
                            'title'=>__('messages.main.home')];
        $breadcrumbs[] = [  'route'=>route('catalogs',$catalog->slug),
                            'title'=>$catalog->title ];
    @endphp
    @include('layouts.breadcrumb',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    <div class="container">
        <h2 class="page-title page-catalog__title">{{ $catalog->title }}</h2>
    </div>

    @include('pages.catalogs._index_banners')
    <div class="mb-5">
        @include('pages.catalogs._subcatalog')
    </div>
    @include('pages.catalogs._viewed')
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-catalog/catalog.min.css?v=').time() }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dest/page-catalog/catalog-min.js') }}"></script>
@endpush


