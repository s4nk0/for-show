@extends('_layout')

@section('title',"ARMADA - личный кабинет пользователя" )

{{--@section('breadcrumb')--}}
{{--    @php--}}
{{--        $breadcrumbs[] = [  'route'=>route('home'),--}}
{{--                            'title'=>'Главная' ];--}}
{{--        $breadcrumbs[] = [  'route'=>route('catalog',$product->catalog->slug),--}}
{{--                            'title'=>$product->catalog->title ];--}}
{{--        $breadcrumbs[] = [  'route'=>route('catalog',['catalog_slug'=>$product->catalog->slug,'subcatalog_slug'=>$product->subcatalog->slug]),--}}
{{--                            'title'=>$product->subcatalog->title ];--}}
{{--        $breadcrumbs[] = [  'route'=>route('product',$product->slug),--}}
{{--                            'title'=>$product->title ?? 'Информация о продукте' ];--}}
{{--    @endphp--}}
{{--    @include('layouts.breadcrumb',['breadcrumbs'=>$breadcrumbs])--}}
{{--@endsection--}}

@section('content')
    <section class="container page-user-area__orders">
        <div class="row">
            @include('users.include.left_menu')
            <div class="orders col-12 col-lg-9">
                <div class="orders vendor__orders">
                    <div class="orders__header">
                        <h2 class="page-title orders__title">{{__('messages.user.order.all')}}</h2>
                        <form id="search2" action="#" class="search orders__search">
                            <input type="text" id="myInput" placeholder="{{__('messages.user.order.id')}}">
                            <button type="submit">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.60568 0C2.96341 0 0 2.96341 0 6.60568C0 10.2482 2.96341 13.2114 6.60568 13.2114C10.2482 13.2114 13.2114 10.2482 13.2114 6.60568C13.2114 2.96341 10.2482 0 6.60568 0ZM6.60568 11.9919C3.63577 11.9919 1.21951 9.57563 1.21951 6.60571C1.21951 3.6358 3.63577 1.21951 6.60568 1.21951C9.5756 1.21951 11.9919 3.63577 11.9919 6.60568C11.9919 9.5756 9.5756 11.9919 6.60568 11.9919Z" fill="#8B8B8B"/>
                                    <path d="M14.8215 13.9593L11.3255 10.4633C11.0873 10.2251 10.7015 10.2251 10.4633 10.4633C10.2251 10.7013 10.2251 11.0875 10.4633 11.3255L13.9593 14.8215C14.0784 14.9406 14.2343 15.0001 14.3904 15.0001C14.5463 15.0001 14.7024 14.9406 14.8215 14.8215C15.0597 14.5835 15.0597 14.1973 14.8215 13.9593Z" fill="#8B8B8B"/>
                                </svg>
{{--                                <img src="{{ asset('img/svg/search.svg') }}" alt="Search">--}}
                            </button>
                        </form>
{{--                        Найдено <b>{{ $ordersCount }} заказов</b>--}}
                        <span class="orders__count">{!! __('messages.user.order.found',['orderCount' =>  $ordersCount ]) !!}</span>
                    </div>
                    <div class="orders__sort d-block d-md-none">
                        <div class="orders__sort-title">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.465 0H0.536692C0.24082 0 0.000976562 0.239843 0.000976562 0.535715V3.21423C0.00100795 3.36603 0.0654495 3.5107 0.178293 3.61227L5.35804 8.27397V14.464C5.35791 14.7599 5.59763 14.9998 5.8935 15C5.97671 15 6.05879 14.9807 6.13322 14.9435L9.34745 13.3364C9.52906 13.2456 9.64379 13.06 9.64369 12.8569V8.27397L14.8234 3.61334C14.9366 3.51155 15.001 3.36643 15.0008 3.21423V0.535715C15.0007 0.239843 14.7609 0 14.465 0ZM13.9293 2.97583L8.74958 7.63646C8.63646 7.73826 8.57201 7.88337 8.57227 8.03557V12.5259L6.42944 13.5973V8.03557C6.4294 7.88378 6.36496 7.73911 6.25212 7.63756L1.07238 2.97583V1.0714H13.9293V2.97583Z" fill="#121313"/>
                            </svg>
                            <span>{{__('messages.filter')}}</span>
                        </div>
                        <select class="browser-default custom-select" onchange="window.location.href=this.options[this.selectedIndex].value">
                            @php $status = (isset($_GET['status']) and $_GET['status'] == 'down') ? 'up' : 'down'; @endphp
                            <option value="{{ route('user.orders',['status'=>$status]) }}" selected>{{__('messages.user.order.status')}}</option>
{{--                            <option value="2">! Способ доставки</option>--}}
                            @php $date = (isset($_GET['date']) and $_GET['date'] == 'down') ? 'up' : 'down'; @endphp
                            <option value="{{ route('user.orders',['date'=>$date]) }}">{{__('messages.date')}}</option>
{{--                            <option value="4">!Покупатель</option>--}}
{{--                            <option value="5">!Город</option>--}}
{{--                            <option value="6">!Телефон</option>--}}
                            @php $price = (isset($_GET['price']) and $_GET['price'] == 'down') ? 'up' : 'down'; @endphp
                            <option value="{{ route('user.orders',['price'=>$price]) }}">{{__('messages.user.order.not_found')}}</option>
{{--                            <option value="8">! Товар</option>--}}
                        </select>
                    </div>
                    <ul class="orders__sort d-none d-md-flex align-items-center justify-content-between bg-light rounded">
                        <li class="orders__sort-item">@php $status = (isset($_GET['status']) and $_GET['status'] == 'down') ? 'up' : 'down'; @endphp
                            <a href="{{ route('user.orders',['status'=>$status]) }}" @if(isset($_GET['status'] ) and $_GET['status'] == 'up') data-sort-status="up" @elseif(isset($_GET['status'] ) and $_GET['status'] == 'down') data-sort-status="down" @endif>
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.26667 4.73333L2.33333 5.66667L5.33333 8.66667L12 2L11.0667 1.06667L5.33333 6.8L3.26667 4.73333ZM10.6667 10.6667H1.33333V1.33333H8V0H1.33333C0.6 0 0 0.6 0 1.33333V10.6667C0 11.4 0.6 12 1.33333 12H10.6667C11.4 12 12 11.4 12 10.6667V5.33333H10.6667V10.6667Z" fill="black"/>
                                </svg>
                                <span>{{__('messages.user.order.status')}}</span>
                                <span class="orders__sort-item-status-wrap">
                                    <span class="orders__sort-item-status orders__sort-item-status--up">
                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 5L5 4.37114e-07L0 5L10 5Z" fill="#11B603"/>
                                        </svg>
                                    </span>
                                    <span class="orders__sort-item-status orders__sort-item-status--down">
                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0L5 5L10 0H0Z" fill="#E0001A"/>
                                        </svg>
                                    </span>
                                </span>
                            </a>
                        </li>
{{--                        <li class="orders__sort-item">--}}
{{--                            <a href="#">--}}
{{--                                <svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M18.1645 3.74592C17.6514 3.10231 16.9206 2.74674 16.1082 2.74674H14.153V1.52252C14.153 1.22547 13.9431 0.982422 13.6866 0.982422H4.37316C4.11661 0.982422 3.90671 1.22547 3.90671 1.52252V3.40386H2.09145C1.8349 3.40386 1.625 3.64691 1.625 3.94396C1.625 4.24101 1.8349 4.48406 2.09145 4.48406H4.3615C4.36538 4.48406 4.36927 4.48406 4.37316 4.48406C4.37316 4.48406 4.37316 4.48406 4.37705 4.48406C4.63359 4.48406 4.84349 4.24101 4.84349 3.94396V2.06262H13.224V3.28684V10.5287H8.83163C8.81219 10.5287 8.79276 10.5287 8.77332 10.5332C8.5401 9.86704 7.97647 9.39445 7.31956 9.39445C6.65876 9.39445 6.09513 9.87154 5.86579 10.5422C5.83081 10.5332 5.79971 10.5287 5.76473 10.5287H4.84349V8.64282C4.84349 8.34576 4.63359 8.10272 4.37705 8.10272C4.36927 8.10272 4.3615 8.10272 4.35372 8.10272C4.34595 8.10272 4.34206 8.10272 4.33429 8.10272H2.09145C1.8349 8.10272 1.625 8.34576 1.625 8.64282C1.625 8.93987 1.8349 9.18291 2.09145 9.18291H3.90671V11.0643C3.90671 11.3613 4.11661 11.6044 4.37316 11.6044H5.76084C5.7725 11.6044 5.78028 11.6044 5.79194 11.6044C5.94742 12.4145 6.57324 13.0176 7.31956 13.0176C8.06588 13.0176 8.68781 12.4145 8.84718 11.6044H13.6905H14.4368C14.5962 12.41 15.2181 13.0176 15.9644 13.0176C16.7107 13.0176 17.3327 12.4145 17.492 11.6044H18.5338C18.7903 11.6044 19.0002 11.3613 19.0002 11.0643V6.57694C19.0002 5.41123 18.7087 4.43005 18.1645 3.74592ZM7.31956 11.9419C6.96972 11.9419 6.68597 11.6134 6.68597 11.2083C6.68597 10.8032 6.96972 10.4746 7.31956 10.4746C7.66939 10.4746 7.95315 10.8032 7.95315 11.2083C7.95315 11.6134 7.66939 11.9419 7.31956 11.9419ZM15.9644 11.9419C15.6146 11.9419 15.3308 11.6134 15.3308 11.2083C15.3308 10.8032 15.6146 10.4746 15.9644 10.4746C16.3142 10.4746 16.598 10.8032 16.598 11.2083C16.5941 11.6134 16.3104 11.9419 15.9644 11.9419ZM18.0673 10.5287H17.4143C17.1811 9.86704 16.6174 9.39445 15.9644 9.39445C15.3114 9.39445 14.7477 9.86254 14.5145 10.5287H14.1569V3.82694H16.1121C17.3365 3.82694 18.0673 4.85763 18.0673 6.58144V10.5287Z" fill="black"/>--}}
{{--                                    <path d="M8.01125 7.3059C7.82856 7.51744 7.82856 7.8595 8.01125 8.07104C8.10065 8.17455 8.22115 8.22856 8.34165 8.22856C8.46215 8.22856 8.57876 8.17455 8.67205 8.07104L9.87316 6.68028L9.87705 6.67578C9.88482 6.66228 9.89648 6.65328 9.90425 6.63978C9.90814 6.63078 9.91203 6.62627 9.91592 6.61727C9.9198 6.60827 9.92369 6.60377 9.93147 6.59477C9.93535 6.58577 9.93924 6.57677 9.94313 6.56776C9.94701 6.55876 9.9509 6.55426 9.95479 6.54526C9.95867 6.53626 9.96256 6.52726 9.96645 6.51826C9.97034 6.50925 9.97422 6.50475 9.97422 6.49575C9.97811 6.48675 9.97811 6.47775 9.982 6.46875C9.98588 6.45975 9.98588 6.45074 9.98977 6.44624C9.99366 6.43724 9.99366 6.42824 9.99366 6.41924C9.99366 6.41024 9.99755 6.40123 9.99755 6.39223C9.99755 6.38323 10.0014 6.37423 10.0014 6.36073C10.0014 6.35173 10.0053 6.34722 10.0053 6.33822C10.0092 6.30222 10.0092 6.26621 10.0053 6.2302C10.0053 6.2212 10.0053 6.2167 10.0014 6.2077C10.0014 6.1987 9.99755 6.1897 9.99755 6.17619C9.99755 6.16719 9.99366 6.15819 9.99366 6.14919C9.99366 6.14019 9.98977 6.13119 9.98977 6.12218C9.98588 6.11318 9.98588 6.10418 9.982 6.09968C9.97811 6.09068 9.97811 6.08168 9.97422 6.07268C9.97034 6.06367 9.96645 6.05917 9.96645 6.05017C9.96256 6.04117 9.95867 6.03217 9.95479 6.02317C9.9509 6.01416 9.94701 6.00966 9.94313 6.00066C9.93924 5.99166 9.93535 5.98266 9.93147 5.97366C9.92758 5.96466 9.92369 5.96016 9.91592 5.95115C9.91203 5.94215 9.90814 5.93765 9.90425 5.92865C9.89648 5.91515 9.88482 5.90615 9.87705 5.89264L9.87316 5.88814L8.73036 4.5649C8.54767 4.35337 8.25225 4.35337 8.06956 4.5649C7.88687 4.77644 7.88687 5.1185 8.06956 5.33004L8.41551 5.73061H0.466448C0.209902 5.73061 0 5.97366 0 6.27071C0 6.56776 0.209902 6.81081 0.466448 6.81081H8.41162L8.01125 7.3059Z" fill="black"/>--}}
{{--                                </svg>--}}
{{--                                <span>! Способ доставки</span>--}}
{{--                                <span class="orders__sort-item-status-wrap">--}}
{{--                                    <span class="orders__sort-item-status orders__sort-item-status--up">--}}
{{--                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path d="M10 5L5 4.37114e-07L0 5L10 5Z" fill="#11B603"/>--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                                    <span class="orders__sort-item-status orders__sort-item-status--down">--}}
{{--                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path d="M0 0L5 5L10 0H0Z" fill="#E0001A"/>--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="orders__sort-item">@php $date = (isset($_GET['date']) and $_GET['date'] == 'down') ? 'up' : 'down'; @endphp
                            <a href="{{ route('user.orders',['date'=>$date]) }}" @if(isset($_GET['date'] ) and $_GET['date'] == 'up') data-sort-status="up" @elseif(isset($_GET['date'] ) and $_GET['date'] == 'down') data-sort-status="down" @endif>
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.7102 5.21777C11.2811 5.1873 10.8926 5.0502 10.6082 4.82422C10.5955 4.81406 10.5803 4.80391 10.565 4.79375C9.08731 3.84414 7.4623 3.36426 5.7332 3.36426C4.3418 3.36426 2.89961 3.66133 1.34316 4.2707V1.34062H3.11543V1.96777C3.11543 2.25469 3.34648 2.48574 3.6334 2.48574C3.92031 2.48574 4.15137 2.25469 4.15137 1.96777V1.34062H8.90449V1.96777C8.90449 2.25469 9.13555 2.48574 9.42246 2.48574C9.70938 2.48574 9.94043 2.25469 9.94043 1.96777V1.34062H11.7127V5.21777H11.7102ZM11.7102 11.7102H1.34062V5.38789C2.92246 4.72266 4.36211 4.4002 5.73066 4.4002C7.25156 4.4002 8.68106 4.82168 9.98106 5.65195C10.4432 6.0125 11.05 6.22578 11.7076 6.25879V11.7102H11.7102ZM11.7584 0.304688H1.29238C0.749023 0.304688 0.304688 0.749023 0.304688 1.29238V5.04766V11.7584C0.304688 12.3043 0.749023 12.7461 1.29238 12.7461H11.7584C12.3043 12.7461 12.7461 12.3018 12.7461 11.7584V5.72559V1.29238C12.7461 0.749023 12.3018 0.304688 11.7584 0.304688Z" fill="black"/>
                                    <path d="M5.78613 9.52412H4.70449V9.51143L5.05996 9.21436C5.61856 8.7167 6.08574 8.20127 6.08574 7.55381C6.08574 6.85303 5.60586 6.34521 4.73496 6.34521C4.3541 6.34521 4.01133 6.43916 3.73965 6.57627C3.58223 6.65498 3.51113 6.84287 3.57715 7.00791C3.65078 7.19326 3.86406 7.27705 4.04434 7.19072C4.19414 7.11963 4.3668 7.06885 4.54961 7.06885C4.99395 7.06885 5.18438 7.31768 5.18438 7.63252C5.17168 8.08193 4.76289 8.51611 3.92246 9.26768L3.54922 9.60537C3.47051 9.67647 3.4248 9.77803 3.4248 9.88467C3.4248 10.0929 3.59492 10.263 3.80313 10.263H5.78867C5.99434 10.263 6.15938 10.098 6.15938 9.89229C6.15684 9.6917 5.9918 9.52412 5.78613 9.52412Z" fill="black"/>
                                    <path d="M8.31074 7.81777V8.6709H7.44492V8.6582L7.96035 7.81523C8.08984 7.57148 8.19141 7.34805 8.31582 7.09668H8.33867C8.32344 7.34805 8.31074 7.58672 8.31074 7.81777ZM9.28828 8.6709H9.16387V7.11953C9.16387 6.72852 8.84648 6.41113 8.45547 6.41113C8.20918 6.41113 7.9832 6.53809 7.85371 6.74629L6.67305 8.64805C6.62734 8.71914 6.60449 8.80293 6.60449 8.88926C6.60449 9.14062 6.81016 9.34629 7.06152 9.34629H8.31328V9.83887C8.31328 10.075 8.50371 10.2654 8.73984 10.2654C8.97598 10.2654 9.16641 10.075 9.16641 9.83887V9.34629H9.29082C9.47871 9.34629 9.62851 9.19394 9.62851 9.00859C9.62598 8.82324 9.47617 8.6709 9.28828 8.6709Z" fill="black"/>
                                </svg>
                                <span>{{__('messages.date')}}</span>
                                <span class="orders__sort-item-status-wrap">
                                    <span class="orders__sort-item-status orders__sort-item-status--up">
                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 5L5 4.37114e-07L0 5L10 5Z" fill="#11B603"/>
                                        </svg>
                                    </span>
                                    <span class="orders__sort-item-status orders__sort-item-status--down">
                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0L5 5L10 0H0Z" fill="#E0001A"/>
                                        </svg>
                                    </span>
                                </span>
                            </a>
                        </li>
{{--                        <li class="orders__sort-item">--}}
{{--                            <a href="#">--}}
{{--                                <svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M7.7 7.71875C6.99531 7.71875 6.65647 8.125 5.5 8.125C4.34353 8.125 4.00714 7.71875 3.3 7.71875C1.47812 7.71875 0 9.24727 0 11.1312V11.7812C0 12.4541 0.527902 13 1.17857 13H9.82143C10.4721 13 11 12.4541 11 11.7812V11.1312C11 9.24727 9.52187 7.71875 7.7 7.71875ZM9.82143 11.7812H1.17857V11.1312C1.17857 9.92266 2.13125 8.9375 3.3 8.9375C3.65848 8.9375 4.2404 9.34375 5.5 9.34375C6.76942 9.34375 7.33906 8.9375 7.7 8.9375C8.86875 8.9375 9.82143 9.92266 9.82143 11.1312V11.7812ZM5.5 7.3125C7.45201 7.3125 9.03571 5.6748 9.03571 3.65625C9.03571 1.6377 7.45201 0 5.5 0C3.54799 0 1.96429 1.6377 1.96429 3.65625C1.96429 5.6748 3.54799 7.3125 5.5 7.3125ZM5.5 1.21875C6.79888 1.21875 7.85714 2.31309 7.85714 3.65625C7.85714 4.99941 6.79888 6.09375 5.5 6.09375C4.20112 6.09375 3.14286 4.99941 3.14286 3.65625C3.14286 2.31309 4.20112 1.21875 5.5 1.21875Z" fill="black"/>--}}
{{--                                </svg>--}}
{{--                                <span>! Покупатель</span>--}}
{{--                                <span class="orders__sort-item-status-wrap">--}}
{{--                                    <span class="orders__sort-item-status orders__sort-item-status--up">--}}
{{--                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path d="M10 5L5 4.37114e-07L0 5L10 5Z" fill="#11B603"/>--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                                    <span class="orders__sort-item-status orders__sort-item-status--down">--}}
{{--                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path d="M0 0L5 5L10 0H0Z" fill="#E0001A"/>--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="orders__sort-item">--}}
{{--                            <a href="#">--}}
{{--                                <svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M9.17844 1.52252C8.19557 0.540719 6.88917 0 5.49992 0C4.11065 0 2.80428 0.540719 1.82141 1.52255C0.838637 2.5043 0.296521 3.80994 0.294922 5.20008C0.295912 6.21202 0.576986 7.16143 1.15417 8.10261C1.65398 8.91757 2.30329 9.62866 2.99072 10.3815C3.66477 11.1196 4.36171 11.8829 4.91833 12.7635C5.01138 12.9107 5.17343 13 5.34758 13H5.65227C5.82642 13 5.98847 12.9107 6.08152 12.7635C6.63813 11.8829 7.33508 11.1196 8.00913 10.3815C8.69655 9.62866 9.34587 8.91757 9.84568 8.10258C10.4229 7.1614 10.7039 6.21197 10.7049 5.19896C10.7034 3.80991 10.1612 2.50428 9.17844 1.52252ZM7.25914 9.69665C6.65982 10.353 6.04316 11.0283 5.49992 11.805C4.95672 11.0283 4.34003 10.353 3.74071 9.69665C2.43769 8.26968 1.31232 7.03727 1.31055 5.20015C1.31319 2.8928 3.19255 1.01562 5.49992 1.01562C7.8073 1.01562 9.68666 2.8928 9.6893 5.19906C9.68752 7.03727 8.56216 8.26965 7.25914 9.69665Z" fill="black"/>--}}
{{--                                </svg>--}}
{{--                                <span>! Город</span>--}}
{{--                                <span class="orders__sort-item-status-wrap">--}}
{{--                                    <span class="orders__sort-item-status orders__sort-item-status--up">--}}
{{--                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path d="M10 5L5 4.37114e-07L0 5L10 5Z" fill="#11B603"/>--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                                    <span class="orders__sort-item-status orders__sort-item-status--down">--}}
{{--                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path d="M0 0L5 5L10 0H0Z" fill="#E0001A"/>--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="orders__sort-item">--}}
{{--                            <a href="#">--}}
{{--                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M0.582911 1.69718L2.15496 0L5.4197 3.53094L4.15405 4.94697C4.36616 5.3549 4.82638 6.13629 5.61071 6.98596C6.39514 7.83579 7.1217 8.34004 7.50184 8.57348L8.7833 7.20293L11.9971 10.6638L10.4336 12.3688C9.83597 13.0163 8.92662 13.184 8.17081 12.7864C7.01745 12.1795 5.27682 11.0598 3.53399 9.17174C1.79121 7.28372 0.757638 5.39801 0.197435 4.14854C0.0647097 3.85249 0.000232697 3.53472 0.000232697 3.21902C0.000232697 2.66154 0.201349 2.11052 0.582911 1.69718ZM1.04008 3.70512C1.56888 4.88459 2.5457 6.66589 4.1964 8.45415C5.84715 10.2425 7.49141 11.3007 8.5801 11.8735C8.97701 12.0823 9.45572 11.993 9.77014 11.6524L10.6725 10.6683L8.78098 8.63142L7.68929 9.79899L7.39721 9.65807C7.34975 9.63517 6.22011 9.08142 4.94826 7.70358C3.67555 6.32482 3.17502 5.1114 3.15435 5.06039L3.0277 4.74822L4.10493 3.543L2.1543 1.4333L1.24483 2.41513C0.929715 2.75701 0.84738 3.27536 1.04008 3.70512Z" fill="black"/>--}}
{{--                                </svg>--}}
{{--                                <span>! Телефон</span>--}}
{{--                                <span class="orders__sort-item-status-wrap">--}}
{{--                                    <span class="orders__sort-item-status orders__sort-item-status--up">--}}
{{--                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path d="M10 5L5 4.37114e-07L0 5L10 5Z" fill="#11B603"/>--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                                    <span class="orders__sort-item-status orders__sort-item-status--down">--}}
{{--                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path d="M0 0L5 5L10 0H0Z" fill="#E0001A"/>--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="orders__sort-item">@php $price = (isset($_GET['price']) and $_GET['price'] == 'down') ? 'up' : 'down'; @endphp
                            <a href="{{ route('user.orders',['price'=>$price]) }}" @if(isset($_GET['price'] ) and $_GET['price'] == 'up') data-sort-status="up" @elseif(isset($_GET['price'] ) and $_GET['price'] == 'down') data-sort-status="down" @endif>
                                <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.41231 0.0683594C3.44746 0.0683594 0.297852 0.953516 0.297852 2.59492V10.8191C0.297852 12.4605 3.44746 13.3457 6.41231 13.3457C9.4502 13.3457 12.5268 12.4777 12.5268 10.8191V2.59492C12.5268 0.936328 9.4502 0.0683594 6.41231 0.0683594ZM11.6287 10.8191C11.6287 11.4852 9.59629 12.452 6.40801 12.452C3.21973 12.452 1.18731 11.4852 1.18731 10.8191V9.43984C2.33457 10.2004 4.41426 10.6043 6.40801 10.6043C8.44473 10.6043 10.4943 10.2133 11.6287 9.46133V10.8191ZM11.6287 8.07773C11.6287 8.74375 9.59629 9.71055 6.40801 9.71055C3.21973 9.71055 1.18731 8.74375 1.18731 8.07773V6.69844C2.33457 7.45898 4.41426 7.86289 6.40801 7.86289C8.44473 7.86289 10.4943 7.47187 11.6287 6.71992V8.07773ZM11.6287 5.33633C11.6287 6.00234 9.59629 6.96914 6.40801 6.96914C3.21973 6.96914 1.18731 6.00234 1.18731 5.33633V3.95703C2.33457 4.71758 4.41426 5.12148 6.40801 5.12148C8.44473 5.12148 10.4943 4.73047 11.6287 3.97852V5.33633ZM6.41231 4.22773C3.22403 4.22773 1.1916 3.26094 1.1916 2.59492C1.1916 1.92891 3.22403 0.96211 6.41231 0.96211C9.60059 0.96211 11.633 1.92891 11.633 2.59492C11.6287 3.26094 9.59629 4.22773 6.41231 4.22773Z" fill="black"/>
                                    <path d="M7.52539 2.57334C7.3664 2.47022 7.06132 2.38428 6.61875 2.31982V1.73115C6.79922 1.77412 6.90664 1.85576 6.94961 1.97178L7.65 1.92022C7.60273 1.76982 7.49101 1.64951 7.31914 1.55928C7.14726 1.46904 6.91093 1.41318 6.61875 1.396V1.24561H6.21914V1.396C5.90117 1.41318 5.64765 1.47764 5.4543 1.58936C5.26094 1.70107 5.16641 1.83857 5.16641 2.00615C5.16641 2.16943 5.25234 2.30693 5.41992 2.42295C5.5875 2.53897 5.8539 2.62061 6.21484 2.67647V3.30811C6.11601 3.28232 6.02578 3.23936 5.94414 3.1835C5.8625 3.12334 5.80664 3.05459 5.77656 2.97725L5.05469 3.02022C5.11055 3.21787 5.23945 3.37256 5.43711 3.47998C5.63476 3.5874 5.89687 3.65186 6.21484 3.67334V3.94834H6.61445V3.66475C6.97539 3.63467 7.25468 3.56162 7.45664 3.43701C7.65859 3.3124 7.76171 3.15772 7.76171 2.97725C7.76601 2.80967 7.68437 2.67647 7.52539 2.57334ZM6.21484 2.24678C6.09453 2.2167 6.00429 2.18232 5.94414 2.13506C5.88398 2.08779 5.85391 2.04053 5.85391 1.98467C5.85391 1.92451 5.88828 1.87295 5.95273 1.82568C6.01719 1.77842 6.10312 1.74404 6.21484 1.72256V2.24678ZM6.9582 3.22217C6.87226 3.27803 6.76054 3.3124 6.61875 3.32529V2.73662C6.78632 2.7624 6.90234 2.80107 6.97539 2.84834C7.04843 2.89561 7.08281 2.95576 7.08281 3.02022C7.0871 3.10186 7.04414 3.16631 6.9582 3.22217Z" fill="black"/>
                                </svg>
                                <span>{{__('messages.user.order.total')}}</span>
                                <span class="orders__sort-item-status-wrap">
                                    <span class="orders__sort-item-status orders__sort-item-status--up">
                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 5L5 4.37114e-07L0 5L10 5Z" fill="#11B603"/>
                                        </svg>
                                    </span>
                                    <span class="orders__sort-item-status orders__sort-item-status--down">
                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0L5 5L10 0H0Z" fill="#E0001A"/>
                                        </svg>
                                    </span>
                                </span>
                            </a>
                        </li>
{{--                        <li class="orders__sort-item">--}}
{{--                            <a href="#">--}}
{{--                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M2.4375 0H0.812513C0.363589 0 0 0.363995 0 0.812513V2.4375C0 2.88639 0.363589 3.25002 0.812513 3.25002H2.4375C2.88639 3.25002 3.25002 2.88643 3.25002 2.4375V0.812513C3.24998 0.363995 2.88639 0 2.4375 0ZM2.4375 2.4375H0.812513V0.812513H2.4375V2.4375Z" fill="black"/>--}}
{{--                                    <path d="M7.3125 0H5.68751C5.23862 0 4.875 0.363995 4.875 0.812513V2.4375C4.875 2.88639 5.23859 3.25002 5.68751 3.25002H7.3125C7.76099 3.25002 8.12502 2.88643 8.12502 2.4375V0.812513C8.12502 0.363995 7.76102 0 7.3125 0ZM7.3125 2.4375H5.68751V0.812513H7.3125V2.4375Z" fill="black"/>--}}
{{--                                    <path d="M12.1875 0H10.5625C10.1136 0 9.75 0.363995 9.75 0.812513V2.4375C9.75 2.88639 10.1136 3.25002 10.5625 3.25002H12.1875C12.636 3.25002 13 2.88643 13 2.4375V0.812513C13 0.363995 12.636 0 12.1875 0ZM12.1875 2.4375H10.5625V0.812513H12.1875V2.4375Z" fill="black"/>--}}
{{--                                    <path d="M2.4375 4.875H0.812513C0.363589 4.875 0 5.23859 0 5.68748V7.31247C0 7.76136 0.363589 8.12498 0.812513 8.12498H2.4375C2.88639 8.12498 3.25002 7.76139 3.25002 7.31247V5.68748C3.24998 5.23899 2.88639 4.875 2.4375 4.875ZM2.4375 7.31247H0.812513V5.68748H2.4375V7.31247Z" fill="black"/>--}}
{{--                                    <path d="M7.3125 4.875H5.68751C5.23862 4.875 4.875 5.23859 4.875 5.68751V7.3125C4.875 7.76139 5.23859 8.12502 5.68751 8.12502H7.3125C7.76099 8.12502 8.12502 7.76143 8.12502 7.3125V5.68751C8.12502 5.23899 7.76102 4.875 7.3125 4.875ZM7.3125 7.31247H5.68751V5.68748H7.3125V7.31247Z" fill="black"/>--}}
{{--                                    <path d="M12.1875 4.875H10.5625C10.1136 4.875 9.75 5.23859 9.75 5.68751V7.3125C9.75 7.76139 10.1136 8.12502 10.5625 8.12502H12.1875C12.636 8.12502 13 7.76143 13 7.3125V5.68751C13 5.23899 12.636 4.875 12.1875 4.875ZM12.1875 7.31247H10.5625V5.68748H12.1875V7.31247Z" fill="black"/>--}}
{{--                                    <path d="M2.4375 9.75H0.812513C0.363589 9.75 0 10.1136 0 10.5625V12.1875C0 12.6364 0.363589 13 0.812513 13H2.4375C2.88639 13 3.25002 12.6364 3.25002 12.1875V10.5625C3.24998 10.114 2.88639 9.75 2.4375 9.75ZM2.4375 12.1875H0.812513V10.5625H2.4375V12.1875Z" fill="black"/>--}}
{{--                                    <path d="M7.3125 9.75H5.68751C5.23862 9.75 4.875 10.1136 4.875 10.5625V12.1875C4.875 12.6364 5.23859 13 5.68751 13H7.3125C7.76099 13 8.12502 12.6364 8.12502 12.1875V10.5625C8.12502 10.114 7.76102 9.75 7.3125 9.75ZM7.3125 12.1875H5.68751V10.5625H7.3125V12.1875Z" fill="black"/>--}}
{{--                                    <path d="M12.1875 9.75H10.5625C10.1136 9.75 9.75 10.1136 9.75 10.5625V12.1875C9.75 12.6364 10.1136 13 10.5625 13H12.1875C12.636 13 13 12.6364 13 12.1875V10.5625C13 10.114 12.636 9.75 12.1875 9.75ZM12.1875 12.1875H10.5625V10.5625H12.1875V12.1875Z" fill="black"/>--}}
{{--                                </svg>--}}
{{--                                <span>! Товар</span>--}}
{{--                                <span class="orders__sort-item-status-wrap">--}}
{{--                                    <span class="orders__sort-item-status orders__sort-item-status--up">--}}
{{--                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path d="M10 5L5 4.37114e-07L0 5L10 5Z" fill="#11B603"/>--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                                    <span class="orders__sort-item-status orders__sort-item-status--down">--}}
{{--                                        <svg width="10" height="5" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <path d="M0 0L5 5L10 0H0Z" fill="#E0001A"/>--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                    <div class="orders__column-titles d-none d-xxl-flex align-items-center justify-content-between">
                        <div class="orders__column orders__column--title">{{__('messages.user.order.id')}}</div>
                        <div class="orders__column orders__column--title">{{__('messages.user.order.status')}}</div>
                        <div class="orders__column orders__column--title">{{__('messages.user.order.date')}}</div>
{{--                        <div class="orders__column orders__column--title">Покупатель</div>--}}
                        <div class="orders__column orders__column--title">{{__('messages.user.order.seller')}}</div>
                        <div class="orders__column orders__column--title">{{__('messages.user.order.total')}}</div>
                        <div class="orders__column orders__column--title">{{__('messages.user.order.product')}}</div>
                    </div>
                    <ul class="orders__items row" id="myList">
                        @forelse($orders as $order)
                            @include('users.orders._card',['item'=>$order])
                        @empty
                        @endforelse
                    </ul>
                </div>
                <div class="pagination page-user-area__pagination">
{{--                    <button class="show-more pagination__more btn btn-outline-primary">Показать ещё 10 заказов</button>--}}
{{--                    @include('layouts._paginate',['pagination'=>$orders])--}}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-user-area/user-area.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dest/page-user-area/user-area-min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myList li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endpush


