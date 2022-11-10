@extends('_layout')

@section('title','ARMADA - Изменить продавца' )

@section('content')
    <section class="vendor page-vendor-area__vendor container-fluid pl-0">
        <div class="d-flex">
            @include('admin._layouts.left_menu')
            <div class="vendor__content flex-grow-1 vendor__content--products">
                @include('admin._layouts.header')
                <div class="orders vendor__shops pt-4 pb-3 p-xxl-3 pt-xxl-5 pr-0">
                    <div class="orders__header justify-content-between">
                        <h2 class="page-title orders__title">Изменить продавца</h2>
                    </div>
                    <form
                        id="admin_seller_update"
                        action="@isset($user){{ route('admin.sellers.update',$user->id) }}@else{{ route('admin.sellers.store') }}@endisset"
                        class="pb-4 border-bottom" method="POST" enctype="multipart/form-data">
                        @isset($user) @method('PATCH') @endisset
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-3">
                                @include('admin.sellers._uploadImage', ['data'=>$user,'name'=>'avatar','limit'=>1])
                            </div>
                            <div class="col-12 col-lg-9">
                                <div class="row">
                                    <div class="col-12 col-lg-4 mb-3">
                                        @include('layouts.forms.input',['data'=>$user,'name'=>'sname','label'=>'Фамилия','placeholder'=>'Фамилия','value'=>($user->sname ?? old('sname'))])
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3">
                                        @include('layouts.forms.input',['data'=>$user,'name'=>'name','label'=>'Имя','placeholder'=>'Имя','value'=>($user->name ?? old('name')),'required'=>true])
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3">
                                        @include('layouts.forms.input',['data'=>$user,'name'=>'mname','label'=>'Отчество','placeholder'=>'Отчество','value'=>($user->mname ?? old('mname'))])
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        @include('layouts.forms.input',['data'=>$user,'name'=>'email','label'=>'E-mail','placeholder'=>'E-mail','value'=>($user->email ?? old('email')),'required'=>true])
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        @include('layouts.forms.input',['name'=>'password','show_password'=>true,'type'=>'password','label'=>'Установить новый пароль','value'=>null,'placeholder'=>'Пароль'])
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        @include('layouts.forms.input',['data'=>$user,'name'=>'hcb_link','type'=>'text','label'=>'Ссылка НСВ','value'=>($user->hcb_link ?? old('email')),'placeholder'=>'Ссылка НСВ'])
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label class="mdb-main-label">Роль</label>
                                        <select class="form-control" name="role_id">
                                            <option value="" disabled selected>Выберите</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}"
                                                        @if($user->role_id == $role->id) selected @endif>{{ $role->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="switch col-12 col-lg-4 mt-2 pr-lg-5">
                                @include('layouts.forms.switch',['data'=>$user,'name'=>'isActive','label'=>'Статус','on'=>'Активный','off'=>'Не активный'])
                            </div>
                        </div>

                        <button type="submit" class="mt-4 button btn-primary">Сохранить</button>
                    </form>

                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            Магазины
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($stores) and $stores->count() > 0)
                            @foreach($stores as $store)
                                <div class="col-12 col-lg-6 mb-3">
                                    <a href="{{ route('shop',$store->slug) }}" target="_blank">
                                        <span class="text-primary mr-3"><i
                                                class="far fa-share-square"></i></span> {{ $store->title }}
                                    </a>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <a href="{{ route('admin.stores.edit',$store->id) }}" target="_blank">
                                        <span class="text-primary mr-3"><i class="far fa-edit"></i></span>
                                        /{{ $store->slug }}
                                    </a>
                                </div>
                            @endforeach

                        @else
                            <div class="col-12 col-lg-6 mb-3">
                                У данного продавца нет магазинов
                            </div>
                        @endif

                    </div>
                    {{--Assign store--}}
                    <button class="button p-1 btn-success mb-3" id="show_add_store">Добавить</button>
                    <div id="add_store_form" style="display: none">
                        <div class="d-flex flex-column w-25">
                            <select name="store_id" form="admin_seller_update" class="form-control js-example-basic-multiple" searchable="Поиск"
                                    style="width: 100%">
                                <option value="" >Выберите</option>
                                @foreach($allStores as $store)
                                    <option value="{{ $store->id }}"
                                            @if(isset($data->store_id) and $data->store_id == $store->id)
                                            select
                                        @endif>{{ $store->title }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="warn-check" class="text-danger font-weight-normal"></span>
                        </div>

                        <button class="button p-1 btn-primary ml-3" form="admin_seller_update" style="height: 40px">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-vendor-area/vendor-area.min.css') }}">
    <!-- Prism -->
    <link rel="stylesheet" href="{{ asset('libs/prism/prism.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endpush

@push('scripts')
    <script src="{{ asset('js/dest/page-vendor-area/vendor-area-min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Upload images -->
    <script>
        // Image module
        {
            let addButton = $('.image-upload-add');
            let i = 1;
            let limit = 1;

            // Clear input before upload
            function clearInput(input) {
                input.on('click', function () {
                    $(this).val('');
                });
            }

            // Create new image block
            {
                let imageBlockPattern = $('.image-upload-wrap.d-none');

                addButton.on('click', function () {
                    if (i < limit) {
                        let imageBlockClone = imageBlockPattern.clone();
                        imageBlockClone.removeClass('d-none');

                        $(this).parents('.row').find('.image-upload-add').before(imageBlockClone);
                    }

                    if (i == limit - 1) {
                        addButton.addClass('disabled');
                    }

                    i++;

                    $('.images-wrap').sortable();

                    clearInput($('.image-upload__upload'));
                });
            }

            // Delete image block
            {
                $(document).on("click", "li.image-upload__action--delete", function () {
                    let imagesCount = $(this).parents('.row').find('.image-upload-wrap').length - 1;
                    let image = $(this).parents('.image-upload').find('.image-upload__preview');
                    let defaultImage = image.attr('data-default-image');

                    if (imagesCount <= 1) {
                        image.attr('style', 'background-image: url(' + defaultImage + ')');
                    } else {
                        $(this).parents('.image-upload-wrap').remove();
                        i--;
                        if (i < limit) {
                            addButton.removeClass('disabled');
                        }
                    }
                });
            }

            // Clear image block
            {
                $(document).on("click", "li.image-upload__action--clear", function () {
                    let image = $(this).parents('.image-upload').find('.image-upload__preview');
                    let defaultImage = image.attr('data-default-image');

                    image.attr('style', 'background-image: url(' + defaultImage + ')');
                    $(this).parents(".image-upload").find('input[type="hidden"]').attr("value", '');
                });
            }

            clearInput($('.image-upload__upload'));

            // Upload and crop image
            $(document).on("change", ".image-upload__upload", function () {
                let aspectRatioX = parseInt($(this).attr('data-aspect-ratio-x'));
                let aspectRatioY = parseInt($(this).attr('data-aspect-ratio-y'));
                let uploadFile = $(this);
                let files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function () {
                        $('.crop-image__save').unbind('click');
                        $('.crop-image__close').unbind('click');
                        $('#crop-image').unbind('click');

                        $('#image-no-crop').attr("src", "" + this.result + "");

                        let image = document.getElementById('image-no-crop');

                        let cropper = new Cropper(image, {
                            aspectRatio: aspectRatioX / aspectRatioY,
                            zoomable: false,
                            scrolable: false,
                            autoCropArea: 0,
                        });

                        $('#crop-image').modal({
                            backdrop: 'static',
                            keyboard: false
                        });

                        $('.crop-image__save').on('click', () => {

                            let imgurl = cropper.getCroppedCanvas().toDataURL();

                            uploadFile.parents(".image-upload").find('.image-upload__preview').css("background-image", "url(" + imgurl + ")");
                            uploadFile.parents(".image-upload").find('input[type="hidden"]').attr("value", imgurl);

                            cropper.destroy();
                            $('.cropper-container').detach();
                        });

                        $('#crop-image').on('hidden.bs.modal', () => {
                            cropper.destroy();
                            $('.cropper-container').detach();
                        });

                        $('.crop-image__close').on('click', function () {
                            cropper.destroy();
                            $('.cropper-container').detach();
                        });
                    }
                }
            });
        }

        //add store
        $(document).ready(function () {
            const eventSelect = $('.js-example-basic-multiple');
            const show_store_btn = $('#show_add_store');
            eventSelect.select2({
                placeholder: "Выберите",
                allowClear: true
            });

            {
                show_store_btn.click(function () {
                    $('#add_store_form').css({'display': 'flex'});
                    show_store_btn.hide();
                })
            }
            eventSelect.on("select2:select", function (e) {

                $.ajax({
                    url: '{{route('admin.check-store-seller')}}' + '?store_id=' + e.target.value,
                    type: 'get',
                }).done(function (response) {
                    $('#warn-check').text(
                        (response === '1') ? 'В магазине уже есть продавец!!!' : ''
                    )

                });
            });
        });

    </script>
@endpush


