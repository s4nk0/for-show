<section class="subscribe page-home__subscribe">
    <div class="subscribe__bg" style="background: url({{ asset('/img/subscribe-bg.jpg') }})"></div>
    <div class="container">
        <div class="subscribe__wrap">
            <div class="subscribe__content">
                <img src="{{ asset('/img/subscribe-icon.png') }}" alt="Icon">
                <p>{{__('messages.main.subscribe.first')}}
                    <span style="background: #FFF; color: #252525; display: inline-block; padding: 0 5px">
                        {{__('messages.main.subscribe.second')}}
                    </span>
                </p>
            </div>
            <div class="subscribe__right-side">
                <form action="#" class="subscribe__form">
                    <input type="email" placeholder="Введите email" required>
                    <button type="submit" class="button button--accent">Подписаться</button>
                </form>
            </div>
        </div>
    </div>
</section>
