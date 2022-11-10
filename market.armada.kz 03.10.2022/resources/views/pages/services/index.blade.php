@extends('_layout')

@section('title','ARMADA - Услуги')

{{--@section('breadcrumb')--}}
{{--    @php--}}
{{--        $breadcrumbs[] = [  'route'=>route('home'),--}}
{{--                            'title'=>__('messages.main.home') ];--}}
{{--        $breadcrumbs[] = [  'route'=>route('services'),--}}
{{--                            'title'=>__('messages.main.links.service')  ];--}}
{{--    @endphp--}}
{{--    @include('layouts.breadcrumb',['breadcrumbs'=>$breadcrumbs])--}}
{{--@endsection--}}

@section('overlay')
    <div class="overlay">
        <div class="modal-image overflow-auto container">
            <div class="modal-image__close">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.53033 6.53033C6.82322 6.23744 6.82322 5.76256 6.53033 5.46967L1.75736 0.696699C1.46447 0.403806 0.989592 0.403806 0.696699 0.696699C0.403806 0.989592 0.403806 1.46447 0.696699 1.75736L4.93934 6L0.696699 10.2426C0.403806 10.5355 0.403806 11.0104 0.696699 11.3033C0.989592 11.5962 1.46447 11.5962 1.75736 11.3033L6.53033 6.53033ZM5 6.75H6V5.25H5V6.75Z" fill="black"/>
                    <path d="M5.46967 5.46967C5.17678 5.76256 5.17678 6.23744 5.46967 6.53033L10.2426 11.3033C10.5355 11.5962 11.0104 11.5962 11.3033 11.3033C11.5962 11.0104 11.5962 10.5355 11.3033 10.2426L7.06066 6L11.3033 1.75736C11.5962 1.46447 11.5962 0.989592 11.3033 0.696699C11.0104 0.403806 10.5355 0.403806 10.2426 0.696699L5.46967 5.46967ZM7 5.25H6V6.75H7V5.25Z" fill="black"/>
                </svg>
            </div>
            <div class="modal-image__wrap">
                <img src="img/interior/1.jpg" alt="">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section class="app_service_section why-register page-info__why-register container mt-5">
        <div class=" app_service_wrapper">
            <span class="app_service_header text-center mr-2">Дизайнеры</span>

            <form method="GET" id="app_designer_style_filter" class="app_service__filter py-3 ">
                <div class="tag_wrapper">
                    @foreach($styles as $style)
                        <input type="checkbox" name="filter_styles[]" value="{{$style->id}}" class="tag_check_box" id="app_designer_check_box_{{$style->id}}" @if(isset($filterStyles) and is_array($filterStyles) and in_array($style->id,$filterStyles)) checked @endif>
                        <label class="app_service_tag" data-id="app_designer_check_box_{{$style->id}}" style="background-color: {{$style->color}}"><span class="tag-remove"  id="style_remove_{{$style->id}}"></span>{{$style->title}}</label>
                      @endforeach
                </div>

                <div class="d-flex align-items-center">
                    <label for="select_filter" class="select_label mb-0 mr-4">Сортировка:</label>
                    <select class="form-control w-auto bg-light border-0" id="select_filter" >
                        <option value="ASC">от А до Я</option>
                        <option value="DESC">от Я до А</option>
                        <option value="">Без сортировки</option>
                    </select>
                </div>

            </form>
        </div>
        <div class="app_service_content mt-4">
            @foreach($designers as $designer)
            <a href="{{route('services.show',['service'=>$designer->id])}}" class="service_card ">
                <img src="{{$designer->getImage('avatar')}}" alt="">
                <p class="service_info_name">{{$designer->sname.' '.$designer->name}}</p>
                <div class="service_info_desc">{!! $designer->designerInfo()->first()->description !!}</div>

    {{--                <div class="service_card_content">--}}
    {{--                       </div>--}}
                <div class="tag_wrapper">
                    @foreach($designer->designerInfo()->first()->designerStyles()->get() as $style)
                        <span class="app_service_tag" style="background-color: {{$style->color}}">{{$style->title}}</span>
                    @endforeach
                </div>
            </a>
            @endforeach
        </div>

    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-info/info.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page-service/service.css') }}">
    <style>
        .tag_check_box:not(:checked) + .app_service_tag {
            opacity: 0.4;
        }

        .tag_check_box:not(:checked) + .app_service_tag .tag-remove {
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('js/dest/page-info/info-min.js') }}"></script>
    <script>

        function submitFilterDelay(){
           // setTimeout(function (){
                $('#app_designer_style_filter').submit()
          //  },100)
        }


        $('.app_service__filter .app_service_tag').click(function(event){

            if(!event.target.classList.contains('tag-remove')){
                $(".tag-remove").click(function(event){
                    event.stopPropagation();
                });
                const tag_block_id = $(this).data("id");
                const tag_block = $(`#${tag_block_id}`);

                if(!tag_block.is(':checked')){
                    tag_block.prop('checked', true);
                    $(this).children('.tag-remove').show();
                    submitFilterDelay()
                }
            }

        })
        $('.tag-remove').click(function (){
            const tag_block = $(this).closest('.app_service_tag')[0]
            const tag_check_box_id = $(tag_block).data("id");
            const tag_check_box = $(`#${tag_check_box_id}`);
            tag_check_box.attr('checked', false);
            $(this).hide();
            submitFilterDelay()
        })

        function submitForFilter(){
            console.log(this)
            console.log("qpod")
        }

        $(document).ready(function (){
            $('#select_filter option[value={{$sortName}}]').attr('selected','selected');
        })
        $('#select_filter').change(function (){
            let current_url = window.location.href;
            if (current_url.indexOf("sort=") === -1) {
                window.location.href = window.location.href +'?sort='+this.options[this.selectedIndex].value
            }else{
                window.location.href=current_url.substring(0,current_url.indexOf('sort='))+'&sort='+this.options[this.selectedIndex].value
            }

        })
    </script>

@endpush


