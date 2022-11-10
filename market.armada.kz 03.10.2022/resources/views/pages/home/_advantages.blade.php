<section class="section advantages page-home__advantages container">
    <div class="advantages__header section__header">
        <h2 class="section__title section__title--dark">{{__('messages.main.our_advantage')}}</h2>
    </div>
    <div class="advantages__content section__content">
        <ul class="advantages__items row">
            @foreach([
                    __('messages.main.our_advantage.400')=>__('messages.main.our_advantage.400.text'),
                    __('messages.main.our_advantage.delivery')=>__('messages.main.our_advantage.delivery.text'),
                    __('messages.main.our_advantage.self_take')=>__('messages.main.our_advantage.self_take.text'),
                    __('messages.main.our_advantage.credit')=>__('messages.main.our_advantage.credit.text'),
                    ] as $key=>$advantage)
                <li class="advantage advantages__item col-6 col-md-3">
                    <div class="advantage__image">
                        <img class="lozad" data-src="/img/excellence/{{ $loop->iteration }}.png" alt="Excellence image">
                    </div>
                    <b class="advantage__title">{{ $key }}</b>
                    <p class="advantage__description">{{ $advantage }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</section>
