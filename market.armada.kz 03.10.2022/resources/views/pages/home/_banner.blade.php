@if(isset($banners) and $banners->count() > 0)
    <section class="banner page-home__banner">
        <ul class="banner__items">
            @foreach($banners as $banner)
                <li class="banner-item banner__item">
                    <a href="{{ route('banner',['link'=>$banner->link]) }}" target="_blank">
                        <picture class="lozad banner-item__image" data-iesrc="{{ $banner->getImage('images_1580x550') }}">
                            <source srcset="{{ $banner->getImage('images_1580x550') }}" media="(min-width: 1580px)">
                            <source srcset="{{ $banner->getImage('images_1280x450') }}" media="(min-width: 1280px)">
                            <source srcset="{{ $banner->getImage('images_1024x450') }}" media="(min-width: 1024px)">
                            <source srcset="{{ $banner->getImage('images_768x495') }}" media="(min-width: 768px)">
                            <source srcset="{{ $banner->getImage('images_576x350') }}" media="(min-width: 320px)">
                           <img src="{{ $banner->getImage('images_1920x550') }}" alt="Banner alt" class="banner-item__image">
                        </picture>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="banner__controls container">
            <div class="banner__arrows">
                <div class="banner__arrow banner__arrow--prev">
                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="18.5" cy="18.5" r="18.5" fill="white"/>
                        <path d="M14.2929 18.2929C13.9024 18.6834 13.9024 19.3166 14.2929 19.7071L20.6569 26.0711C21.0474 26.4616 21.6805 26.4616 22.0711 26.0711C22.4616 25.6805 22.4616 25.0474 22.0711 24.6569L16.4142 19L22.0711 13.3431C22.4616 12.9526 22.4616 12.3195 22.0711 11.9289C21.6805 11.5384 21.0474 11.5384 20.6569 11.9289L14.2929 18.2929ZM16 18L15 18L15 20L16 20L16 18Z" fill="black"/>
                    </svg>
                </div>
                <div class="banner__arrow banner__arrow--next">
                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="18.5" cy="18.5" r="18.5" fill="white"/>
                        <path d="M14.2929 18.2929C13.9024 18.6834 13.9024 19.3166 14.2929 19.7071L20.6569 26.0711C21.0474 26.4616 21.6805 26.4616 22.0711 26.0711C22.4616 25.6805 22.4616 25.0474 22.0711 24.6569L16.4142 19L22.0711 13.3431C22.4616 12.9526 22.4616 12.3195 22.0711 11.9289C21.6805 11.5384 21.0474 11.5384 20.6569 11.9289L14.2929 18.2929ZM16 18L15 18L15 20L16 20L16 18Z" fill="black"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>
@endif
