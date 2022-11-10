
{{--<link rel="stylesheet" href="{{ asset('css/main.min.css?v=').time() }}">--}}
{{--<link rel="stylesheet" href="{{ asset('css/fonts.min.css') }}">--}}
{{--<link rel="stylesheet" href="{{ asset('css/style.css') }}">--}}
{{--<link rel="stylesheet" href="{{ asset('css/banner.css') }}">--}}
<script src="{{ asset('js/scripts.js') }}"></script>

{{--@include('layouts._script_recaptcha')--}}
@include('layouts._script_product_like')

@if(!Route::is('admin.*','seller.*','qr'))
    <script>
        let applicationModal = $('.applicationPost');

        $.each(applicationModal, function () {
            let $this = $( this );
            let applicationModalForm = $( this ).find('form');
            let applicationModalSuccess = $( this ).find('.application__success');
            let applicationModalError = $( this ).find('.application__error');
            let errorList = $( this ).find('.application__error-messages');

            $( this ).find('button[type="submit"]').on('click', function (e) {
                e.preventDefault();
                $( this ).attr("disabled", true);

                $.ajax({
                    url:     '{{ route('applicationPost') }}',
                    type:     "POST",
                    data: applicationModalForm.serialize(),
                    success: function(response) {
                        applicationModalForm.slideUp(200);
                        applicationModalSuccess.slideDown(200);
                        $('.applicationPost button[type="submit"]').attr("disabled", false);

                        setTimeout(function () {
                            applicationModalSuccess.slideUp(200);
                            applicationModalForm.slideDown(200);
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        let err = JSON.parse(xhr.responseText);

                        if(err) {
                            errorList.html('');

                            $.each(err.errors, function () {
                                errorList.append('<p class="mb-0">' + $( this )[0] + '</p>').stop('true').slideDown(200);
                            });

                            setTimeout(function () {
                                errorList.stop('true').slideUp(200);
                            }, 3000)
                        } else {
                            applicationModalForm.slideUp(200);
                            applicationModalError.slideDown(200);

                            setTimeout(function () {
                                applicationModalError.slideUp(200);
                                applicationModalForm.slideDown(200);
                            }, 2000)
                        }
                    }
                });
            })
        })
    </script>
    <script>

        {{--let busketInDB = @json($userBasket ?? null);--}}
        {{--console.log(busketInDB)--}}

        let authUserId = @json(Auth::id() ?? null);

        // if (busketInDB) {
        //     busketInDB.forEach((item) => {
        //         localStorage.setItem(`ARMADA_PRODUCT_${item.product_id}_USER_${authUserId}`, JSON.stringify({
        //             ...item,
        //             id: item.product_id,
        //             userId: authUserId
        //         }));
        //     });
        // }


        const priceThreeDigitModification = (price) => {
            let arrPriceNumber = [...(price + '')];
            let arrPrcieNumberModification = [];
            let check = 3;
            for (let i = arrPriceNumber.length - 1; i >= 0; i--) {
                if (check === 0) {
                    arrPrcieNumberModification.unshift(' ');
                    arrPrcieNumberModification.unshift(arrPriceNumber[i]);
                    check = 2;
                } else {
                    arrPrcieNumberModification.unshift(arrPriceNumber[i]);
                    check--;
                }
            }
            return arrPrcieNumberModification.join('');
        }

    </script>
    <script src="//code-eu1.jivosite.com/widget/xwoYioSz1p" async></script>
@endif

@include('layouts._scripts.basket')
@include('layouts._scripts.search')

@if(Route::is('seller.*','admin.*','designer.*'))
    <script>
        $(document).ready(function (){
            const close_store = sessionStorage.getItem('whatsapp_close');
            if(close_store === 'true'){
                $('.whatsapp_popup_wrapper').hide();
            }
        })
        $('.whatsapp_close').click(function(){
            $('.whatsapp_popup_wrapper').hide();
            sessionStorage.setItem('whatsapp_close', 'true');
        })
    </script>
@endif


<script>
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();

    $('.card_store_location_icon').mouseenter(function (){
        let icon_id = $(this).attr("data-id");
        const card_store_location_popover = $(`.card_store_location_popover-${icon_id}`)
        let parent_class = card_store_location_popover.closest('.slideshow__items');
        if(parent_class.length > 0 || $(window).width() < 480){
            card_store_location_popover.css({'display':'flex'}).addClass('card_store_location_popover_scroll');
            if(parent_class.length === 0 && $(window).width() < 480){
                card_store_location_popover.css({'top':'36px','right':'36px'})
            }
            return;
        }
        card_store_location_popover.css({'display':'flex'}).addClass('card_store_location_popover_non_scroll');
    }).mouseleave(function (){
        let icon_id = $(this).attr("data-id");
        $(`.card_store_location_popover-${icon_id}`).css({'display':'none'});
    })


    $(window).on("scroll", function() {
        if($(window).scrollTop() > $('#header').height()) {
            $(".header").css({
                'position':'absolute',
                "top":"-"+$('#header').height()
            })
            $(".header__top").css({'display':'none'})
            $(".header__bottom").css({'display':'none'});
            $(".header").css({
                "top":0,
                'position':'sticky',
            })
            // $(".header").css({'position':'sticky'});
        } else {
            //remove the background property so it comes transparent again (defined in your css)
            $(".header__top").css({'display':'block'});
            $(".header__bottom").css({'display':'flex'});
            $(".header").css({'position':'relative'});
        }
    });
</script>
