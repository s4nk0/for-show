@extends('_layout')

@section('title','ARMADA - изменить(создать) страну' )

@section('content')
    <section class="vendor page-vendor-area__vendor container-fluid pl-0">
        <div class="d-flex">
            @include('designer._layouts.left_menu')
            <div class="vendor__content flex-grow-1 vendor__content--products">
                @include('designer._layouts.header')
                <div class="shops orders vendor__shops pt-4 pb-3 p-xxl-3 pt-xxl-5 pr-0">
                    <div class="orders__header justify-content-between">
                        <h2 class="page-title orders__title"></h2>
                    </div>
                    <form action="@isset($data){{ route('designer.projects.update',$data->id) }}@else{{ route('designer.projects.store') }}@endisset" class="change-shop pb-4 border-bottom was-validated" method="POST"  enctype="multipart/form-data">
                        @isset($data) @method('PATCH') @endisset
                        @csrf

{{--                        <div class="row">--}}
{{--                            <div class="switch col-12 col-lg-4 mb-3 pr-lg-5">--}}
{{--                                @include('layouts.forms.switch',['name'=>'isActive','label'=>'Статус','on'=>'Активный','off'=>'Не активный'])--}}
{{--                            </div>--}}
{{--                        </div>--}}
                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-2">
                                    @include('designer.projects._uploadImage', ['name'=>'images','limit'=>1,'label'=>'Логотип'])
                                </div>
                                {{--                            <div class="col-12 col-md-3 col-lg-2">--}}
                                {{--                                @include('sellers.stores._uploadImage', ['name'=>'background','limit'=>1,'label'=>'Фон','tooltip'=>'Фотография Вашего магазина с наружной стороны, подгружаете одинаковые фотографии в миниатюру и в фон, НО в разных размерах. Рекомендуемые размеры для фона 1680*450'])--}}
                                {{--                            </div>--}}
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3 mb-4">
                                    @include('layouts.forms.input',['name'=>'title','id'=>'title','label'=>'Название','placeholder'=>'Название','length'=>150,'required'=>true])
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 mb-4">
                                    @include('layouts.forms.input',['name'=>'visual','id'=>'title','label'=>'Youtube','placeholder'=>'youtube'])
                                </div>
{{--                                <div class="col-12 col-sm-6 col-md-3 mb-4">--}}
{{--                                    <label for="slug">Slug</label>--}}
{{--                                    <div class="input-group mb-3">--}}
{{--                                        <div class="input-group-prepend">--}}
{{--                                            <div class="input-group-text" style="height: 38px;">--}}
{{--                                                <input class="form-check-input" type="checkbox" name="is_slug" id="is_slug" @if(isset($data) and $data->is_slug == true) checked @endif>--}}
{{--                                                <label class="form-check-label" for="is_slug"></label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        @include('layouts.forms.input',['name'=>'slug','id'=>'slug','placeholder'=>'Slug', 'other'=>'readonly disabled'])--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                {{--                             /SEO заголовок (Реализовать)--}}


{{--                                <div class="col-12 col-sm-6 col-md-3 mb-4">--}}
{{--                                    <label>Продавец</label>--}}
{{--                                    <select name="user_id" id="user_id" class="form-control js-select2" searchable="Поиск"--}}
{{--                                            style="width: 100%">--}}
{{--                                        <option value="" >Выберите</option>--}}
{{--                                        @foreach($sellers as $seller)--}}
{{--                                            <option value="{{ $seller->id }}"--}}
{{--                                                    @if(isset($data->user_id) and $data->user_id == $seller->id)--}}
{{--                                                    selected--}}
{{--                                                @endif>{{ $seller->name }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}

                            </div>

                            <div class="row">
                                <div class="description col-12 col-lg-6 mb-3">
                                    @include('layouts.forms.textarea',['name'=>'description','class'=>'tinyMCE','label'=>'Описание','placeholder'=>'Описание','cols'=>30,'rows'=>12,'length'=>2000,'required'=>true])
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-6  mb-4">
                                            @include('layouts.forms.input',['name'=>'type_object','label'=>'Тип объекта','placeholder'=>'Тип объекта','length'=>150,'required'=>true])
                                        </div>
                                        {{--                             SEO заголовок (Реализовать)--}}
                                        <div class="col-6 mb-4">
                                            @include('layouts.forms.input',['name'=>'size','label'=>'Размеры','placeholder'=>'Размеры','maxlength'=>150])
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6  mb-4">
                                            @include('layouts.forms.input',['name'=>'address','label'=>'Адрес','placeholder'=>'Адрес','maxlength'=>150])
                                        </div>

                                        <div class="col-6  mb-4">
                                            @include('layouts.forms.input',['name'=>'price','label'=>'Цена','placeholder'=>'Цена','maxlength'=>150])
                                        </div>
                                    </div>

                                    <div class="row">
                                        <input type="hidden" name="user_id" value="{{auth()->id()}}">
                                        <div class="col-6">
                                            <label class="mdb-main-label" for="styles">Cтили</label>
                                            <select name="designer_style_id" id="designer_style_id" class="form-control" required>
                                                @foreach($styles as $style)
                                                    <option  value="{{ $style->id }}" @if(isset($data) and $style->id === $data->designer_style_id) selected @endif>
                                                        {{ $style->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12  mb-4">
                                    <?php if (!isset($data)){
                                        $data = null;
                                    }
                                        ?>
                                    <livewire:designer.project.select-products  :designer_project="$data" />
                                </div>
                            </div>


                        <button type="submit" class="mt-5 button btn-primary">Сохранить</button>
                    </form>

                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-vendor-area/vendor-area.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    {{--работа с livewire--}}
    <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
    @livewireStyles

@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    {{--  Slug generation  --}}
    <script>
        {{--$('#title').change(function(e) {--}}
        {{--    $.get('{{ route('designer.checkSlug') }}',--}}
        {{--        { 'title': $(this).val() },--}}
        {{--        function( data ) {--}}
        {{--            $('#slug').val(data.slug);--}}
        {{--        }--}}
        {{--    );--}}
        {{--});--}}
    </script>
    <script src="{{ asset('js/dest/page-vendor-area/vendor-area-min.js') }}"></script>
    <!-- Upload images -->
    <script>
        // Image module
        {
            let addButton = $('.image-upload-add');
            let i = 1;
            let limit = 1;

            // Clear input before upload
            function clearInput(input) {
                input.on('click', function(){
                    $( this ).val('');
                });
            }

            // Create new image block
            {
                let imageBlockPattern = $('.image-upload-wrap.d-none');

                addButton.on('click', function () {
                    if(i < limit) {
                        let imageBlockClone = imageBlockPattern.clone();
                        imageBlockClone.removeClass('d-none');

                        $( this ).parents('.row').find('.image-upload-add').before(imageBlockClone);
                    }

                    if(i == limit - 1) {
                        addButton.addClass('disabled');
                    }

                    i++;

                    $('.images-wrap').sortable();

                    clearInput($('.image-upload__upload'));
                });
            }

            // Delete image block
            {
                $(document).on("click", "li.image-upload__action--delete" , function() {
                    let imagesCount = $( this ).parents('.row').find('.image-upload-wrap').length-1;
                    let image = $( this ).parents('.image-upload').find('.image-upload__preview');
                    let defaultImage = image.attr('data-default-image');

                    if(imagesCount <= 1) {
                        image.attr('style', 'background-image: url(' + defaultImage + ')');
                    } else {
                        $( this ).parents('.image-upload-wrap').remove();
                        i--;
                        if(i < limit) {
                            addButton.removeClass('disabled');
                        }
                    }
                });
            }

            // Clear image block
            {
                $(document).on("click", "li.image-upload__action--clear" , function() {
                    let image = $( this ).parents('.image-upload').find('.image-upload__preview');
                    let defaultImage = image.attr('data-default-image');

                    image.attr('style', 'background-image: url(' + defaultImage + ')');
                    $( this ).parents(".image-upload").find('input[type="hidden"]').attr("value", '');
                });
            }

            clearInput($('.image-upload__upload'));

            // Upload and crop image
            $(document).on("change",".image-upload__upload", function() {
                let aspectRatioX = parseInt($( this ).attr('data-aspect-ratio-x'));
                let aspectRatioY = parseInt($( this ).attr('data-aspect-ratio-y'));
                let uploadFile = $(this);
                let files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function(){
                        $('.crop-image__save').unbind('click');
                        $('.crop-image__close').unbind('click');
                        $('#crop-image').unbind('click');

                        $('#image-no-crop').attr("src", ""+this.result+"");

                        let image = document.getElementById('image-no-crop');

                        let cropper = new Cropper(image, {
                            aspectRatio: aspectRatioX/aspectRatioY,
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

                            uploadFile.parents(".image-upload").find('.image-upload__preview').css("background-image", "url("+imgurl+")");
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
    </script>
<!-- Slug check box   -->
    <script>
        let slugInput = $('input[name="slug"]');
        let slugCheckbox = $('input[name="is_slug"]');

        slugCheckbox.on('input', function () {
            if( $( this ).is(':checked') ) {
                slugInput.removeAttr('disabled readonly')
            } else {
                slugInput.attr('disabled', 'disabled');
                slugInput.attr('readonly', 'readonly')
            }
        });
    </script>

{{--    работа с livewire--}}
    @livewireScripts

@endpush


