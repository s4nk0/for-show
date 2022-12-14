<a href="#" class="vendor-menu__row vendor-menu__row--has-children">
    <div class="vendor-menu__icon">
        <svg width="22" height="6" viewBox="0 0 22 6" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.20002 5.20032C3.41505 5.20032 4.40003 4.21534 4.40003 3.00031C4.40003 1.78527 3.41505 0.800293 2.20002 0.800293C0.984981 0.800293 0 1.78527 0 3.00031C0 4.21534 0.984981 5.20032 2.20002 5.20032Z" fill="white"/>
            <path d="M11.0003 5.20032C12.2153 5.20032 13.2003 4.21534 13.2003 3.00031C13.2003 1.78527 12.2153 0.800293 11.0003 0.800293C9.78527 0.800293 8.80029 1.78527 8.80029 3.00031C8.80029 4.21534 9.78527 5.20032 11.0003 5.20032Z" fill="white"/>
            <path d="M19.8001 5.20032C21.0151 5.20032 22.0001 4.21534 22.0001 3.00031C22.0001 1.78527 21.0151 0.800293 19.8001 0.800293C18.5851 0.800293 17.6001 1.78527 17.6001 3.00031C17.6001 4.21534 18.5851 5.20032 19.8001 5.20032Z" fill="white"/>
        </svg>
    </div>
    <span class="vendor-menu__row-title">Сущности</span>
    <span class="vendor-menu__row-dropdown-arrow">
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.53033 6.53033C6.82322 6.23744 6.82322 5.76256 6.53033 5.46967L1.75736 0.696701C1.46446 0.403808 0.98959 0.403808 0.696697 0.696701C0.403804 0.989595 0.403804 1.46447 0.696697 1.75736L4.93934 6L0.696701 10.2426C0.403808 10.5355 0.403808 11.0104 0.696702 11.3033C0.989595 11.5962 1.46447 11.5962 1.75736 11.3033L6.53033 6.53033ZM5 6.75L6 6.75L6 5.25L5 5.25L5 6.75Z" fill="white"/>
            </svg>
        </span>
    <div class="vendor-menu__dropdown">
        @isCan('browse_colors')
        @include('admin._layouts.left_menu._colors')
        @endisCan
        @isCan('browse_countries')
        @include('admin._layouts.left_menu._countries')
        @endisCan
        @isCan('browse_cities')
        @include('admin._layouts.left_menu._cities')
        @endisCan
        @isCan('browse_tarifs')
        @include('admin._layouts.left_menu._tarifs')
        @endisCan
        @isCan('browse_roles')
        @include('admin._layouts.left_menu._roles')
        @endisCan
        @isCan('browse_permissions')
        @include('admin._layouts.left_menu._permissions')
        @endisCan
        @include('admin._layouts.left_menu._type_delivery')
        @include('admin._layouts.left_menu._type_pay')
        @include('admin._layouts.left_menu._designer_style')

        {{--            <a href="#" class="vendor-menu__row">--}}
        {{--                <div class="vendor-menu__icon">--}}
        {{--                    <svg width="22" height="6" viewBox="0 0 22 6" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
        {{--                        <path d="M2.20002 5.20032C3.41505 5.20032 4.40003 4.21534 4.40003 3.00031C4.40003 1.78527 3.41505 0.800293 2.20002 0.800293C0.984981 0.800293 0 1.78527 0 3.00031C0 4.21534 0.984981 5.20032 2.20002 5.20032Z" fill="white"/>--}}
        {{--                        <path d="M11.0003 5.20032C12.2153 5.20032 13.2003 4.21534 13.2003 3.00031C13.2003 1.78527 12.2153 0.800293 11.0003 0.800293C9.78527 0.800293 8.80029 1.78527 8.80029 3.00031C8.80029 4.21534 9.78527 5.20032 11.0003 5.20032Z" fill="white"/>--}}
        {{--                        <path d="M19.8001 5.20032C21.0151 5.20032 22.0001 4.21534 22.0001 3.00031C22.0001 1.78527 21.0151 0.800293 19.8001 0.800293C18.5851 0.800293 17.6001 1.78527 17.6001 3.00031C17.6001 4.21534 18.5851 5.20032 19.8001 5.20032Z" fill="white"/>--}}
        {{--                    </svg>--}}
        {{--                </div>--}}
        {{--                <span class="vendor-menu__row-title">! Подразделы</span>--}}
        {{--            </a>--}}
    </div>
</a>
