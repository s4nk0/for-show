<li class="panel-item panel__item col-12 col-md-6 col-lg-4 col-xxl-3">
    <div class="panel-item__wrap">
        <div class="panel-item__bg" style="background-image: url({{ asset('img/care-images/6.jpg') }})"></div>
        <div class="panel-item__icon">
            <svg width="34" height="37" viewBox="0 0 34 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.4372 21.0795C21.5882 21.0795 24.9658 17.702 24.9658 13.551C24.9658 9.39999 21.5882 6.02246 17.4372 6.02246C13.2862 6.02246 9.90869 9.40006 9.90869 13.551C9.90869 17.7019 13.2863 21.0795 17.4372 21.0795ZM17.4372 7.52821C20.7589 7.52821 23.46 10.2301 23.46 13.551C23.46 16.8719 20.7589 19.5738 17.4372 19.5738C14.1155 19.5738 11.4144 16.8719 11.4144 13.551C11.4144 10.2301 14.1156 7.52821 17.4372 7.52821Z" fill="white"/>
                <path d="M33.94 35.0877L29.4229 24.5478C29.3038 24.2706 29.0317 24.0912 28.7303 24.0912H26.0569L26.9805 23.1707C29.5655 20.6049 30.9888 17.1891 30.9888 13.5513C30.9888 6.07939 24.9102 0 17.4375 0C9.96489 0 3.8862 6.07939 3.8862 13.5513C3.8862 17.1891 5.30959 20.6049 7.89457 23.1693L8.81945 24.0913H6.14476C5.84331 24.0913 5.5713 24.2707 5.45216 24.5479L0.935051 35.0878C0.836522 35.3201 0.860025 35.587 0.999773 35.7987C1.13804 36.0097 1.37476 36.1369 1.62765 36.1369H33.2474C33.5003 36.1369 33.7371 36.0097 33.8753 35.7986C34.015 35.5869 34.0385 35.32 33.94 35.0877ZM5.39188 13.5513C5.39188 6.90948 10.7957 1.50568 17.4375 1.50568C24.0794 1.50568 29.4832 6.90948 29.4832 13.5513C29.4832 16.7848 28.2171 19.8211 25.9189 22.1033L17.4375 30.5567L8.95616 22.1018C6.65794 19.8211 5.39188 16.7848 5.39188 13.5513ZM2.76871 34.6312L6.64178 25.597H10.3299L16.9067 32.1528C17.0523 32.2991 17.2449 32.3726 17.4375 32.3726C17.6301 32.3726 17.8228 32.2991 17.9684 32.1528L24.5462 25.597H28.2333L32.1064 34.6312H2.76871Z" fill="white"/>
            </svg>

        </div>
        <div class="panel-item__content">
            <p class="panel-item__title">Карта</p>
            <span class="panel-item__info">В базе данных <span>{{ $mapsCount ?? 0}}</span>мест</span>
            <div class="text-center">
                <a href="{{ route('admin.maps.index') }}" class="panel-item__button button btn-primary btn-rounded">Перейти к карте</a>
            </div>
        </div>
    </div>
</li>