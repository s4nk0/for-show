@extends('_layout')

@section('title','ARMADA - добавить магазин на карту' )

<style>
    .popup__header .select2-container {
        display: none;
    }


    .svg {
        height: min-content;
    }
</style>

@section('content')
    <section class="vendor page-vendor-area__vendor container-fluid pl-0">
        <div class="d-flex">
            @include('admin._layouts.left_menu')
            <div class="vendor__content flex-grow-1 vendor__content--products">
                @include('admin._layouts.header')
                <div class="orders vendor__shops pt-4 pb-3 p-xxl-3 pt-xxl-5 pr-0">
                    <div class="orders__header justify-content-between">
                        <h2 class="page-title orders__title">Добавить магазин на карту</h2>
                    </div>


                    <!--                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label class="mdb-main-label">Магазин</label>
                                <select name="store_id" class="form-control js-example-basic-multiple" searchable="Поиск" required>
                                    <option value="" disabled
{{--@if(!isset($data->store_id)) selected @endif>Выберите</option>--}}
                    {{--                                    @foreach($stores as $store)--}}
                    {{--                                        <option value="{{ $store->id }}"--}}
                    {{--@if(isset($data->store_id) and $data->store_id == $store->id) select @endif>{{ $store->title }}</option>--}}
                    {{--                                    @endforeach--}}
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label>Индекс блока (введите или выберите на карте)</label>
                        <input type="text" name="map-code" class="form-control" placeholder="Индекс блока" value="{{ $data->map_id ?? old('map_id') }}">
                            </div>
                        </div>-->
                        <ul class="scheme__tabs nav nav-tabs" id="myTab" role="tablist">
                            <li class="scheme__tab nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                   aria-controls="home"
                                   aria-selected="true">Первый этаж</a>
                            </li>
                            <li class="scheme__tab nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                   aria-controls="profile"
                                   aria-selected="false">Цокольный этаж</a>
                            </li>
                        </ul>
                        @include('_include._map_pane')


                </div>
            </div>
        </div>
        <div class="popup bg-light" id="shcemeModalNew">
            <div class="popup__arrow"></div>
            <div
                class="popup__header border-bottom p-2 px-md-3 py-md-3 d-flex align-items-center justify-content-between">
                <span class="mr-2"><a href="#" id="shcemeModalTitle"></a>
                <select id="storeMap_select" name="store_id"
                        class="form-control js-example-basic-multiple" searchable="Поиск" required>
                        <option value="" disabled @if(!isset($data->store_id)) selected @endif>Выберите</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->id }}"
                                @if(isset($data->store_id) and $data->store_id == $store->id)
                                select
                                @endif>{{ $store->title }}
                        </option>
                    @endforeach
                </select>
                </span>
                <span class="popup__close">
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.7449 4.99953L9.84681 9.10144C10.0524 9.30701 10.0524 9.64028 9.84681 9.84583C9.64124 10.0514 9.30795 10.0514 9.1024 9.84583L5.00047 5.74392L0.898561 9.84583C0.692995 10.0514 0.359721 10.0514 0.154175 9.84583C-0.051372 9.64026 -0.0513916 9.30699 0.154175 9.10144L4.25608 4.99953L0.154175 0.897619C-0.0513916 0.692053 -0.0513916 0.358779 0.154175 0.153233C0.359741 -0.0523338 0.693015 -0.0523138 0.898561 0.153233L5.00047 4.25514L9.10236 0.153233C9.30793 -0.0523338 9.64122 -0.0523138 9.84677 0.153233C10.0523 0.358799 10.0523 0.692073 9.84677 0.897619L5.7449 4.99953Z"
                                fill="#E0001A"/>
                        </svg>
                    </span>
            </div>
            <div class="popup__content pt-2 pb-3 px-2 pt-md-3 pb-md-4 px-md-3">
                <img src="img/shops/1.jpg" alt="Shop image" class="popup__image img-responsive" id="shcemeModalImg">
                <div id="schemeModalTextContent">
                    <p class="popup__time d-flex align-items-center">
                        <svg class="mr-3" width="12" height="12" viewBox="0 0 12 12" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 0C2.69166 0 0 2.69166 0 6C0 9.30834 2.69166 12 6 12C9.30834 12 12 9.30834 12 6C12 2.69166 9.30834 0 6 0ZM6 11.25C3.1051 11.25 0.750003 8.8949 0.750003 6C0.750003 3.1051 3.1051 0.750003 6 0.750003C8.8949 0.750003 11.25 3.1051 11.25 6C11.25 8.8949 8.8949 11.25 6 11.25V11.25Z"
                                fill="#575757"/>
                            <path d="M6.375 2.25H5.625V6.15526L7.98486 8.51512L8.51513 7.98485L6.375 5.84472V2.25Z"
                                  fill="#575757"/>
                        </svg>
                        <span id="shcemeModalWorkTimes">

                </span>
                    </p>
                    <p class="popup__phone d-flex">
                        <svg class="mr-3 mt-2" width="12" height="12" viewBox="0 0 12 12" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.49263 7.43297C9.24697 7.17718 8.95067 7.04042 8.63663 7.04042C8.32513 7.04042 8.02628 7.17465 7.7705 7.43043L6.97021 8.22819C6.90436 8.19273 6.83852 8.15981 6.7752 8.12689C6.68403 8.0813 6.59793 8.03825 6.52448 7.99266C5.77485 7.51654 5.09359 6.89607 4.44019 6.09325C4.12362 5.6931 3.91089 5.35627 3.7564 5.01438C3.96407 4.82444 4.15655 4.6269 4.34396 4.43696C4.41487 4.36605 4.48578 4.2926 4.55669 4.22169C5.08853 3.68986 5.08853 3.001 4.55669 2.46917L3.8653 1.77778C3.78679 1.69927 3.70575 1.61823 3.62978 1.53719C3.47782 1.38017 3.31827 1.21809 3.15366 1.06613C2.908 0.823008 2.61422 0.693848 2.30525 0.693848C1.99628 0.693848 1.69744 0.823008 1.44418 1.06613C1.44165 1.06867 1.44165 1.06867 1.43912 1.0712L0.578051 1.93986C0.253885 2.26403 0.0690083 2.65911 0.0284875 3.1175C-0.0322938 3.857 0.185506 4.54586 0.352654 4.99665C0.762927 6.10338 1.3758 7.12906 2.29006 8.22819C3.39931 9.55271 4.73397 10.5987 6.25856 11.3356C6.84105 11.6117 7.61854 11.9384 8.48721 11.9941C8.54039 11.9966 8.59611 11.9992 8.64676 11.9992C9.23178 11.9992 9.72309 11.789 10.108 11.3711C10.1106 11.366 10.1156 11.3635 10.1182 11.3584C10.2499 11.1989 10.4018 11.0545 10.5614 10.9C10.6703 10.7962 10.7817 10.6873 10.8906 10.5733C11.1413 10.3125 11.273 10.0086 11.273 9.69707C11.273 9.38303 11.1388 9.08166 10.883 8.8284L9.49263 7.43297ZM10.3993 10.0997C10.3968 10.0997 10.3968 10.1023 10.3993 10.0997C10.3005 10.2061 10.1992 10.3023 10.0903 10.4087C9.9257 10.5657 9.75855 10.7303 9.60153 10.9152C9.34574 11.1887 9.04437 11.3179 8.64929 11.3179C8.6113 11.3179 8.57078 11.3179 8.5328 11.3154C7.78063 11.2673 7.08164 10.9735 6.55741 10.7228C5.12398 10.0288 3.8653 9.04367 2.81936 7.79512C1.95576 6.75424 1.37834 5.79187 0.995922 4.75859C0.760395 4.12799 0.674288 3.63667 0.712276 3.17322C0.737602 2.87691 0.851567 2.63125 1.06177 2.42105L1.92537 1.55745C2.04946 1.44095 2.18116 1.37764 2.31032 1.37764C2.46987 1.37764 2.59903 1.47387 2.68007 1.55492C2.6826 1.55745 2.68513 1.55998 2.68767 1.56251C2.84215 1.70687 2.98904 1.85629 3.14353 2.01584C3.22203 2.09688 3.30308 2.17792 3.38412 2.2615L4.0755 2.95288C4.34396 3.22133 4.34396 3.46952 4.0755 3.73797C4.00206 3.81142 3.93115 3.88486 3.85771 3.95577C3.64497 4.17357 3.44237 4.37618 3.22203 4.57372C3.21697 4.57878 3.2119 4.58131 3.20937 4.58638C2.99157 4.80418 3.03209 5.01691 3.07768 5.16127C3.08021 5.16887 3.08274 5.17646 3.08528 5.18406C3.26509 5.61966 3.51834 6.02993 3.90329 6.51872L3.90582 6.52125C4.60481 7.38232 5.34178 8.05344 6.15473 8.56755C6.25856 8.6334 6.36493 8.68658 6.46623 8.73723C6.5574 8.78282 6.64351 8.82587 6.71696 8.87146C6.72709 8.87652 6.73722 8.88412 6.74735 8.88918C6.83345 8.93224 6.91449 8.9525 6.99807 8.9525C7.20827 8.9525 7.33996 8.82081 7.38302 8.77775L8.24915 7.91162C8.33526 7.82551 8.47201 7.72168 8.63156 7.72168C8.78858 7.72168 8.91774 7.82045 8.99625 7.90655C8.99878 7.90909 8.99878 7.90909 9.00132 7.91162L10.3968 9.30706C10.6576 9.56538 10.6576 9.83129 10.3993 10.0997Z"
                                fill="#757575"/>
                            <path
                                d="M6.49431 2.85402C7.15784 2.96545 7.76059 3.27949 8.24177 3.76067C8.72295 4.24186 9.03446 4.8446 9.14842 5.50813C9.17628 5.67528 9.32064 5.79178 9.48525 5.79178C9.50551 5.79178 9.52324 5.78924 9.5435 5.78671C9.73091 5.75632 9.855 5.57904 9.82461 5.39163C9.68785 4.58882 9.30797 3.85691 8.72802 3.27695C8.14807 2.697 7.41616 2.31712 6.61334 2.18036C6.42593 2.14997 6.25119 2.27406 6.21827 2.45894C6.18534 2.64382 6.3069 2.82363 6.49431 2.85402Z"
                                fill="#757575"/>
                            <path
                                d="M11.9947 5.29318C11.7693 3.97119 11.1463 2.76823 10.1889 1.81092C9.23164 0.853617 8.02868 0.230609 6.70669 0.00521237C6.52181 -0.0277108 6.34707 0.0989168 6.31414 0.283793C6.28375 0.471202 6.40785 0.645948 6.59526 0.678871C7.77543 0.878943 8.85176 1.43864 9.70776 2.29211C10.5638 3.14811 11.1209 4.22444 11.321 5.40461C11.3489 5.57176 11.4932 5.68826 11.6578 5.68826C11.6781 5.68826 11.6958 5.68573 11.7161 5.68319C11.901 5.65533 12.0276 5.47806 11.9947 5.29318Z"
                                fill="#757575"/>
                        </svg>
                        <span id="shcemeModalPhone">

                  </span>

                    </p>
                </div>

                <div id="schemeModalBtns" class="d-flex justify-content-between">
                    <button id="shcemeModalStoreEdit" class="btn-sm button btn-blue p-2">Редактировать</button>
                    <button id="shcemeModalStoreDelete" class="btn-sm button btn-primary p-2">Удалить</button>
                </div>


            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-vendor-area/vendor-area.min.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('libs/croppie/croppie.css') }}">--}}

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/page-info/info.min.css') }}">
@endpush

@push('scripts')
    <script defer src="{{ asset('js/dest/page-info/info.js') }}"></script>
    <script>
        @isset($maps)
        @foreach($maps as $map)
        {{--            @if($map->map_id === 'b2-064_1')@dd(123)@endif--}}
        $('document').ready(function () {
            {{--$("#{{$map->map_id}}").css({fil1: 'fil8'});--}}
            {{--document.getElementById("{{$map->map_id}}").classList.add('fil8');--}}
            {{--document.getElementById("{{$map->map_id}}").classList.remove('fil0');--}}
            {{--document.getElementById("{{$map->map_id}}").classList.remove('fil1');--}}
            {{--document.getElementById("{{$map->map_id}}").classList.remove('fil2');--}}
            {{--document.getElementById("{{$map->map_id}}").classList.remove('fil3');--}}
            {{--document.getElementById("{{$map->map_id}}").classList.remove('fil4');--}}
            {{--document.getElementById("{{$map->map_id}}").classList.remove('fil5');--}}
            {{--document.getElementById("{{$map->map_id}}").classList.remove('fil6');--}}
            {{--document.getElementById("{{$map->map_id}}").classList.remove('fil7');--}}
            {{--document.getElementById("{{$map->map_id}}").classList.remove('fil9');--}}
            {{--document.getElementById("{{$map->map_id}}").classList.remove('str0');--}}
            {{--document.getElementById("{{$map->map_id}}").classList.remove('fil06');--}}
        });
        @endforeach
        @endif
    </script>
    <!-- Croppie -->
    {{--    <script src="{{ asset('libs/croppie/croppie.min.js') }}"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2({
                placeholder: "Выберите магазин"
            });
        });
    </script>
    <script src="{{ asset('js/dest/page-vendor-area/vendor-area-min.js') }}"></script>
    <script defer>
        document.addEventListener('DOMContentLoaded', function () {

            const setPolygonColor = (polygonId) =>{
                $('#'+polygonId).css({'fill':'#e31e24'});
            }

            $(document).ready(function () {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('admin.get_occupied_map')}}",
                    type: 'get',
                    success: function (data) {
                        data.forEach((polygon, index)=>{
                            setPolygonColor(polygon?.map_polygon_id)
                            // $('#'+polygonId?.map_polygon_id).css({'fill':'#e31e24'});
                        })
                    },
                    error: function (data) {
                        alert(data.status+' '+data.statusText);
                    },
                });


                const maps = JSON.parse(document.getElementById('myTab').getAttribute('data-maps'));
                const stores = JSON.parse(document.getElementById('myTab').getAttribute('data-stores'));
                const modalWindow = document.getElementById('shcemeModalNew');
                const modalTitle = document.getElementById('shcemeModalTitle');
                const modalImg = document.getElementById('shcemeModalImg');
                const modalWorkTime = document.getElementById('shcemeModalWorkTimes');
                const modalPhone = document.getElementById('shcemeModalPhone');
                const modalStoreSlug = document.getElementById('shcemeModalStoreSlug');
                const modalTextContentContainer = $('#schemeModalTextContent');
                const modalButtonsContainer = $('#schemeModalBtns');
                const modalContent = $('.popup__content');
                const storeSelect2 = $('.js-example-basic-multiple');

                const setModalWindow = (targetStoreInfo, targetPolygon) => {

                    modalContent.css({'display': 'none'});

                    if (targetStoreInfo === null || targetStoreInfo?.id === 9999999) {
                        modalTitle.textContent = 'Нет данных!!!';
                        modalImg.setAttribute('src', `{{env('APP_URL')}}img/noimg.jpg`);
                        modalTextContentContainer.css({'display': 'none'});
                        modalButtonsContainer.html("<button id=\"shcemeModalStoreAdd\"" +
                            " class=\"btn-sm button btn-success p-2 updateModalStore\">Добавить</button>");
                        modalContent.css({'display': 'block'});
                        return;
                    }

                    modalTextContentContainer.css({'display': 'block'});
                    modalButtonsContainer.html("<button id=\"shcemeModalStoreEdit\"" +
                        " class=\"btn-sm button btn-blue p-2 updateModalStore\">Редактировать</button>" +
                        "<button id=\"schemeModalStoreDelete\"" +
                        " class=\"btn-sm button btn-primary p-2\"" +
                        " data-toggle=\"modal\" data-target=\"#confirm-delete-modal\"" +
                        " data-item-id=" + targetPolygon + ">" +
                        "<input type=\"hidden\" name=\"delete-action\" value=\"{{route('admin.maps.index')}}/" +
                        targetPolygon + "\">" +
                        "Удалить</button>");
                    modalTitle.textContent = targetStoreInfo['title'];

                    if (targetStoreInfo['mini_img'] === null) {
                        modalImg.setAttribute('src', `{{env('APP_URL')}}img/noimg.jpg`);
                    } else {
                        $.get(`/storage/${targetStoreInfo['mini_img'][0]}`)
                            .done(function () {
                                modalImg.setAttribute('src', `/storage/${targetStoreInfo['mini_img'][0]}`);
                            }).fail(function () {
                            modalImg.setAttribute('src', `{{env('APP_URL')}}img/noimg.jpg`);
                        });
                    }

                    modalWorkTime.innerHTML = '';
                    let span = document.createElement('span');
                    targetStoreInfo['work_times'].forEach((item) => {
                        span.textContent = item;
                        modalWorkTime.appendChild(span);
                        modalWorkTime.innerHTML += '<br />';
                    });

                    modalPhone.innerHTML = '';
                    if (targetStoreInfo['phones'] !== null) {
                        let a = document.createElement('a');
                        targetStoreInfo['phones'].forEach((item) => {
                            if (item != null) {
                                a.textContent = item;
                                a.setAttribute('href', `tel:${item}`);
                                modalPhone.appendChild(a);
                                modalPhone.innerHTML += '<br />';
                            }
                        });
                    } else {
                        modalPhone.textContent = 'Телефоны отсутствуют';
                    }
                    modalContent.css({'display': 'block'});

                }

                const showUpdateStoreMapHandler = (storeId = null, polygonId) => {
                    if (!storeId) {
                        storeSelect2.val('');
                        storeSelect2.trigger('change');
                    }

                    storeSelect2.val(storeId);
                    storeSelect2.trigger('change');

                    $('.popup__header .select2-container').css({display: 'block'})
                    modalButtonsContainer.html("<button id=\"schemeModalStoreUpdate\"" +
                        " class=\"btn-sm button btn-primary p-2 \">Сохранить</button>");

                    $('#schemeModalStoreUpdate').click(function () {
                        updateMapHandler(polygonId);
                    })
                }

                const updateMapHandler = (polygonId) => {
                    let store_id = $('#storeMap_select').val();
                    if (!store_id) {
                        alert("Выберите магазин!!!")
                        return;
                    }

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{route('admin.update-or-create-map')}}",
                        data: {
                            store_id: store_id,
                            map_polygon_id: polygonId
                        },
                        type: 'post',
                        success: function (data) {
                            setModalWindow(data?.store, polygonId);
                            setPolygonColor(polygonId)
                            $('.popup__header .select2-container').css({display: 'none'})
                            // add and edit map
                            $('.updateModalStore').click(function () {
                                showUpdateStoreMapHandler(data?.store?.id, polygonId);
                            })

                            // delete map
                            $('#schemeModalStoreDelete').click(function (){
                                confirmDeleteStoreMapHandler(this);
                            })
                        },
                        error: function (data) {
                            alert(data.status+' '+data.statusText);
                        },
                    });

                }

                const confirmDeleteStoreMapHandler = () =>{
                    let deleteAction = $( this ).find('input[name="delete-action"]').val();
                    let productName = $( this ).find('input[name="delete-product-name"]').val();

                    $('#confirm-delete-modal form').attr('action', deleteAction)
                    $('#confirm-delete-modal #product-name').text(productName)
                }

                document.addEventListener('click', (e) => {
                    if (e.target.tagName === "polygon") {
                        $('.popup__header .select2-container').css({display: 'none'})
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '{{route('get-store-by-polygonId')}}' + '?polygonId=' + e.target.id,
                            type: 'get',
                            success: function (data) {
                                if (Object.entries(data).length === 0) {
                                    setModalWindow(null);
                                } else {
                                    setModalWindow(data?.store, e.target.id);
                                }

                                // add and edit map
                                $('.updateModalStore').click(function () {
                                    showUpdateStoreMapHandler(data?.store?.id, e.target.id);
                                })

                                // delete map
                                $('#schemeModalStoreDelete').click(function (){
                                    confirmDeleteStoreMapHandler(this);
                                })
                            },
                            error: function (data) {
                                console.warn(data);
                            },
                        });

                    }
                    if (e.target.getAttribute('id') === 'pay_result') {
                        let modal = document.querySelector('#pay_result');
                        modal.setAttribute('aria-modal', 'false');
                        modal.style.display = 'none';
                        modal.classList.remove('show');
                    }
                });

            });
        }, false);
    </script>
@endpush



{{--let deleteSingleItemButton = $('.products-table__delete');--}}

{{--$.each(deleteSingleItemButton, function () {--}}
{{--$( this ).on('click', function () {--}}
{{--let deleteAction = $( this ).find('input[name="delete-action"]').val();--}}
{{--let productName = $( this ).find('input[name="delete-product-name"]').val();--}}

{{--$('#confirm-delete-modal form').attr('action', deleteAction)--}}
{{--$('#confirm-delete-modal #product-name').text(productName)--}}
{{--})--}}
{{--});--}}
