@extends('_layout')

@section('title','ARMADA - товары' )

@push('styles')
    <style>
        .overlay_print{
            height: 100%;
            z-index: 9999;
            background: rgb(255 255 255 / 70%);
            opacity: 0.6;
            position: fixed;
            width: 100%;
            /*display: grid;*/
            place-items: center;
            display: none;
        }

        .overlay_inner{
            position: absolute;
            opacity: 1;
            background-color: #ffffff;
            row-gap: 20px;
        }


    </style>
@endpush
@section('content')
    <div id="drop_zone" class="area" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);">
        <div class="overlay_print">
            <div class="d-flex flex-column justify-content-center align-items-center overlay_inner">
                <img src="{{ asset('img/svg/upload.svg') }}" width="150px" alt="Search">
                <h5>Перетащите, чтобы загрузить фотографии и создать продукт</h5>
            </div>
        </div>
    <div class="filter-apply">
        <div class="filter-apply__wrap">
            <button class="filter-apply__close">
                <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.875 0C2.84729 0 1.86166 0.408258 1.13496 1.13496C0.408258 1.86166 0 2.84729 0 3.875L0 27.125C0 28.1527 0.408258 29.1383 1.13496 29.865C1.86166 30.5917 2.84729 31 3.875 31H27.125C28.1527 31 29.1383 30.5917 29.865 29.865C30.5917 29.1383 31 28.1527 31 27.125V3.875C31 2.84729 30.5917 1.86166 29.865 1.13496C29.1383 0.408258 28.1527 0 27.125 0L3.875 0ZM10.3734 9.00162C10.1915 8.81972 9.94475 8.71753 9.6875 8.71753C9.43025 8.71753 9.18353 8.81972 9.00162 9.00162C8.81972 9.18353 8.71753 9.43025 8.71753 9.6875C8.71753 9.94475 8.81972 10.1915 9.00162 10.3734L14.1302 15.5L9.00162 20.6266C8.91155 20.7167 8.84011 20.8236 8.79136 20.9413C8.74262 21.059 8.71753 21.1851 8.71753 21.3125C8.71753 21.4399 8.74262 21.566 8.79136 21.6837C8.84011 21.8014 8.91155 21.9083 9.00162 21.9984C9.18353 22.1803 9.43025 22.2825 9.6875 22.2825C9.81488 22.2825 9.94101 22.2574 10.0587 22.2086C10.1764 22.1599 10.2833 22.0884 10.3734 21.9984L15.5 16.8698L20.6266 21.9984C20.7167 22.0884 20.8236 22.1599 20.9413 22.2086C21.059 22.2574 21.1851 22.2825 21.3125 22.2825C21.4399 22.2825 21.566 22.2574 21.6837 22.2086C21.8014 22.1599 21.9083 22.0884 21.9984 21.9984C22.0884 21.9083 22.1599 21.8014 22.2086 21.6837C22.2574 21.566 22.2825 21.4399 22.2825 21.3125C22.2825 21.1851 22.2574 21.059 22.2086 20.9413C22.1599 20.8236 22.0884 20.7167 21.9984 20.6266L16.8698 15.5L21.9984 10.3734C22.0884 10.2833 22.1599 10.1764 22.2086 10.0587C22.2574 9.94101 22.2825 9.81488 22.2825 9.6875C22.2825 9.56012 22.2574 9.43399 22.2086 9.31631C22.1599 9.19862 22.0884 9.0917 21.9984 9.00162C21.9083 8.91155 21.8014 8.84011 21.6837 8.79136C21.566 8.74262 21.4399 8.71753 21.3125 8.71753C21.1851 8.71753 21.059 8.74262 20.9413 8.79136C20.8236 8.84011 20.7167 8.91155 20.6266 9.00162L15.5 14.1302L10.3734 9.00162Z" fill="#E0001A"/>
                </svg>
            </button>
            <span>Применить</span>
            <button class="filter-apply__apply">
                <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.875 0C2.84729 0 1.86166 0.408258 1.13496 1.13496C0.408258 1.86166 0 2.84729 0 3.875L0 27.125C0 28.1527 0.408258 29.1383 1.13496 29.865C1.86166 30.5917 2.84729 31 3.875 31H27.125C28.1527 31 29.1383 30.5917 29.865 29.865C30.5917 29.1383 31 28.1527 31 27.125V3.875C31 2.84729 30.5917 1.86166 29.865 1.13496C29.1383 0.408258 28.1527 0 27.125 0L3.875 0ZM23.3081 9.62937C23.1697 9.49146 23.0049 9.38287 22.8236 9.3101C22.6423 9.23734 22.4482 9.20188 22.2528 9.20586C22.0575 9.20984 21.8649 9.25317 21.6867 9.33326C21.5085 9.41336 21.3483 9.52856 21.2156 9.672L14.4867 18.2454L10.4315 14.1883C10.156 13.9316 9.7917 13.7919 9.41524 13.7985C9.03878 13.8052 8.6796 13.9577 8.41336 14.2239C8.14712 14.4902 7.99462 14.8493 7.98797 15.2258C7.98133 15.6023 8.12107 15.9666 8.37775 16.2421L13.5044 21.3706C13.6425 21.5085 13.8069 21.6171 13.9879 21.69C14.1689 21.7629 14.3628 21.7987 14.5579 21.795C14.753 21.7914 14.9454 21.7486 15.1235 21.669C15.3017 21.5894 15.462 21.4748 15.5949 21.3319L23.3294 11.6637C23.5931 11.3896 23.7388 11.023 23.7352 10.6426C23.7315 10.2622 23.5789 9.89846 23.3101 9.62937H23.3081Z" fill="#11B603"/>
                </svg>
            </button>
        </div>
    </div>

    <section class="vendor page-vendor-area__vendor container-fluid pl-0">
        <div class="d-flex">
            @include('sellers.products._filters')
            @include('sellers._layouts.left_menu')

            <div class="vendor__content flex-grow-1 vendor__content--products">
                @include('sellers._layouts.header')
                <div class="products orders vendor__products pt-4 pb-3 p-xxl-3 pt-xxl-5 pr-0">
{{--                    <form action="{{ route('seller.importxmldatapost') }}" method="POST" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        <div class="row justify-content-end">--}}
{{--                            <div class="col-lg-6">--}}

{{--                            </div>--}}
{{--                            <div class="col-lg-1">--}}
{{--                                <a href="{{ route('seller.exportxmldata') }}" type="submit" class="btn btn-success">Выгрузить</a>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-4">--}}
{{--                                <input type="file" name="file" class="form-control">--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-1">--}}
{{--                                <button type="submit" class="btn btn-success">Загрузить</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}

                    <div class="orders__header justify-content-between">
                        <div class="d-flex align-content-center flex-wrap">
                            <h2 class="page-title orders__title mr-4 mb-2">Все товары</h2>
                            <div>
                                <button class="button btn-sm btn-success products__add mr-2 mb-2">
                                    <a href="{{ route('seller.products.create') }}">Добавить</a>
                                </button>
                                <button class="button btn-sm btn-primary products__remove mr-2 mb-2" disabled data-toggle="modal" data-target="#confirm-delete-modal">
                                    <span>Удалить выделенное</span>
                                    <input type="hidden" name="muliple-delete-action" value="{{ route('seller.products.destroy',['id'=>'plug']) }}">
                                </button>
                                <button class="button btn-sm btn-light products__filter mr-2 mb-2">Фильтр</button>
                                @if(isset($_GET) and count($_GET) > 0)
                                    <a href="{{ route('seller.products.index') }}" class="text-primary">
                                        <i class="fas fa-filter"></i>
                                        Сбросить фильтр
                                    </a>
                                @endif
                            </div>
                        </div>
                        <span class="orders__count">Найдено <b>{{ $products->count() }}</b>@if(isset($_GET) and count($_GET) > 0) по фильтру @endif</span>
                    </div>

                    <form action="{{ route('seller.importxmldatapost') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <div class="d-flex align-items-center">
                            <div class="input-group d-flex align-items-center flex-wrap">
                                <span class="mr-3 mb-3">Импорт: </span>
                                <div class="custom-file cursor-pointer mr-3 mb-3" style="min-width: 260px; max-width: 320px">
                                    <input type="file" name="file" class="custom-file-input" id="inputGroupFile01"
                                           aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Выберите файл</label>
                                </div>
                                <button type="submit" class="buttons-copy buttons-html5 button btn-sm btn-light mb-3" style="font-size: 14px">Загрузить</button>
                                <a href="{{ asset('files/armada_import.xlsx') }}" class=" mt-2 ml-3 mb-3 text-underline" style="font-weight: 700;font-size: 14px">Шаблон</a>
                            </div>
                        </div>
{{--                        <div class="input-group d-flex align-items-center mt-3">--}}
{{--                            <a href="{{ route('seller.exportxmldata') }}" class="buttons-copy buttons-html5 button btn-sm btn-light" style="font-size: 14px">Экспорт</a>--}}
{{--                        </div>--}}
                    </form>
                    <a href="{{ route('seller.export_data',['file_type'=>'csv','export_store_id'=> request()->get('store') ]) }}" type="submit" class="buttons-copy buttons-html5 button btn-sm btn-light rounded mr-2 mt-2 xmlExport d-none">CSV</a>
                    <a href="{{ route('seller.export_data',['file_type'=>'xlsx','export_store_id'=> request()->get('store')]) }}" type="submit" class="buttons-copy buttons-html5 button btn-sm btn-light rounded mr-2 mt-2 xmlExport d-none">XLSX</a>
                    <a href="{{ route('seller.export_data',['file_type'=>'xmlfile','export_store_id'=> request()->get('store')]) }}" type="submit" class="buttons-copy buttons-html5 button btn-sm btn-light rounded mr-2 mt-2 xmlExport d-none">XML</a>

                    <div class="table-responsive products-table vendor__products-table">
                        <table id="dt-multi-checkbox" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Фото</th>
                                    <th>Артикул</th>
                                    <th>Название</th>
{{--                                    <th>Каталог</th>--}}
                                    <th>Раздел</th>
                                    <th>Продавец</th>
                                    <th>Цена</th>
                                    <th>Статус</th>
                                    <th>Дата</th>
                                    <th class="text-center">Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @each('sellers.products._table_products',$products,'product')
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Фото</th>
                                    <th>Артикул</th>
                                    <th>Название</th>
{{--                                    <th>Каталог</th>--}}
                                    <th>Раздел</th>
                                    <th>Продавец</th>
                                    <th>Цена</th>
                                    <th>Статус</th>
                                    <th>Дата</th>
                                    <th class="text-center">Действия</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-vendor-area/vendor-area.min.css') }}">
@endpush

@push('scripts')
    {{-- inputmask --}}
    <script src="{{ asset('js/dest/page-vendor-area/vendor-area.js') }}"></script>


    <script>
        // Edit product

        {
            let editProductButton = $('.products-table__edit');

            $.each(editProductButton, function () {
                $( this ).on('click', function(){
                    let editLink = $( this ).find('input[name="edit-action"]').val();
                    let editAction = $( this ).find('input[name="edit-link"]').val();
                    let productIsActive = $( this ).find('input[name="edit-product-isActive"]').val();
                    let productIsDelivery = $( this ).find('input[name="edit-product-isDelivery"]').val();
                    let productPrice = $( this ).find('input[name="edit-product-price"]').val();

                    if(productIsActive == 1) {
                        $('#quick-edit input[name="isActive"]').prop( "checked", true );
                    } else {
                        $('#quick-edit input[name="isActive"]').prop( "checked", false );
                    }

                    if(productIsDelivery == 1) {
                        $('#quick-edit input[name="is_delivery"]').prop( "checked", true );
                    } else {
                        $('#quick-edit input[name="is_delivery"]').prop( "checked", false );
                    }

                    $('#quick-edit form').attr('action', editAction);
                    $('#quick-edit a').attr('href', editLink);
                    $('#quick-edit input[name="price"]').val(productPrice);
                })
            });
        }

        // Delete product

        {
            // Singe
            let deleteSingleItemButton = $('.products-table__delete');

            $('tr td:first-child').on('click', function(){
                setTimeout(function () {
                    if($('table .selected').length >= 1) {
                        deleteMultipleItemsButton.removeAttr('disabled');
                    } else {
                        deleteMultipleItemsButton.attr('disabled', 'disabled');
                    }
                }, 500)
            });

            $.each(deleteSingleItemButton, function () {
                $( this ).on('click', function () {
                    let deleteAction = $( this ).find('input[name="delete-action"]').val();
                    let productName = $( this ).find('input[name="delete-product-name"]').val();

                    $('#confirm-delete-modal form').attr('action', deleteAction)
                    $('#confirm-delete-modal #product-name').text(productName)
                })
            });

            // Multiple
            let deleteMultipleItemsButton = $('.products__remove');

            deleteMultipleItemsButton.on('click', function () {
                let selectedItems = $('table .selected');
                let itemsIds = '';

                $.each(selectedItems, function (index) {
                    let itemId = $( this ).find('.products-table__delete').attr('data-item-id');

                    if(index+1 <= selectedItems.length-1) {
                        itemsIds += itemId + ',';
                    } else {
                        itemsIds += itemId;
                    }

                });

                let deleteAction = $('.products__remove input[name="muliple-delete-action"]').val();
                $('#confirm-delete-modal form').attr('action', deleteAction.slice(0,-4) + itemsIds);

            });
        }

        //Drag and drop image

        {
            const dragged_images = []

            let counter = 0;

            function dropHandler(ev) {
                let formData = new FormData();
                // Prevent default behavior (Prevent file from being opened)
                ev.preventDefault();
                counter = 0
                if (ev.dataTransfer.items) {
                    // Use DataTransferItemList interface to access the file(s)
                    for (let i = 0; i < ev.dataTransfer.items.length; i++) {
                        // If dropped items aren't files, reject them
                        if (ev.dataTransfer.items[i].kind === 'file') {
                            const file = ev.dataTransfer.items[i].getAsFile();
                            if(file.type.startsWith("image/")){
                                console.log('... file[' + i + '].name = ' + file.name);
                                dragged_images.push(file);
                                formData.append("files" + i, file);
                            }
                        }
                    }
                    formData.append("total", ev.dataTransfer.items.length);
                    @if(isset(request()->store) )
                    formData.append("store_id", {{ request()->store }});
                    @endif
                    @if(isset(request()->item))
                    formData.append("item_id", {{ request()->item }});
                    @endif
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('seller.createWithImages')}}",
                    type: 'post',
                    data: formData,
                    beforeSend: function (data){
                        $('.preloader').show()
                        $('.overlay_print').css({display:'none'})
                    },
                    success: function (data) {
                        console.log(data)
                        window.location.reload()
                    },
                    error: function (data) {
                        $('.preloader').fadeOut(200)
                        let message = ''
                        if(data?.responseJSON.errors?.item_id){
                            message += data?.responseJSON.errors?.item_id[0] + '\n'
                        }
                        if(data?.responseJSON.errors?.store_id){
                            message += data?.responseJSON.errors?.store_id[0]
                        }
                        alert(message)
                    },
                    cache:false,
                    contentType: false,
                    processData: false,

                });
            }

            function getBase64(file) {
                let reader = new FileReader();
                reader.readAsDataURL(file);
                console.log( reader.result)
                return reader.result
            }

            function dragOverHandler(ev) {
                // Prevent default behavior (Prevent file from being opened)
                ev.preventDefault();
            }

            $('#drop_zone').bind({
                dragenter: function(ev) {
                    ev.preventDefault(); // needed for IE
                    counter++;
                    $('.overlay_print').css({display:'grid'})
                },

                dragleave: function() {
                    counter--;
                    if (counter === 0) {
                        $('.overlay_print').css({display:'none'})
                    }
                }
            });

        }
    </script>
@endpush


