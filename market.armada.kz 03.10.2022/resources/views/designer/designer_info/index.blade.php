@extends('_layout')

@section('title','ARMADA - Изменить дизайнера' )

@section('content')
    <section class="vendor page-vendor-area__vendor container-fluid pl-0">
        <div class="d-flex">
            @include('designer._layouts.left_menu')
            <div class="vendor__content flex-grow-1 vendor__content--products">
                @include('designer._layouts.header')
                <div class="orders vendor__shops pt-4 pb-3 p-xxl-3 pt-xxl-5 pr-0">
                    <div class="orders__header justify-content-between">
                        <h2 class="page-title orders__title">О дизайнере</h2>
                    </div>
                    <form
                        id="designer_seller_update"
                        action="{{ route('designer.designer_info_update') }}"
                        class="pb-4 border-bottom" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="row align-items-center">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        @include('layouts.forms.textarea',['name'=>'description','class'=>'tinyMCE','data'=>$userInfo,'label'=>'Описание','placeholder'=>'Описание','cols'=>30,'rows'=>12,'length'=>2000,'required'=>true])
                                    </div>

                                    <div class="col-6">
                                        <div class="col-6 mb-3">
                                            @include('layouts.forms.input',['name'=>'years','label'=>'Стаж','placeholder'=>'Стаж','maxlength'=>100,'data'=>$userInfo])</div>
                                        <div class="col-6">
                                            <label class="mdb-main-label" for="styles">Cтили</label>
                                            <select name="styles[]" id="styles" class="form-control js-example-basic-multiple" multiple required>
                                                @foreach($styles as $style)
                                                    <option  value="{{ $style->id }}" @if(isset($userInfo->designerStyles) and is_array($userInfo->designerStyles->pluck('id')->toArray()) and in_array($style->id,$userInfo->designerStyles->pluck('id')->toArray())) selected @endif>
                                                        {{ $style->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <button type="submit" class="mt-4 button btn-primary">Сохранить</button>
                    </form>

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
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Выберите 3",
                maximumSelectionLength: 3
            });
        });
    </script>

@endpush


