<nav class="vendor-menu vendor__menu">
    <div class="vendor-menu__bg" style="background: rgba(0, 0, 0, .7);"></div>
    <a href="{{ route('home') }}" class="vendor-menu__row vendor-menu__logo" target="_blank">
        <img src="{{ asset('img/favicon.png') }}" alt="Армада" class="img-responsive">
        <span class="vendor-menu__row-title text-uppercase font-weight-bold">Армада</span>
    </a>
    <a href="{{ route('designer.info') }}" class="vendor-menu__row vendor-menu__user">
        <span class="vendor-menu__user-logo" style="background-image: url({{ Auth::user()->getImage('avatar','/img/logo_default.png') }})"></span>
        <span class="vendor-menu__row-title">{{ Auth::user()->company ?? Auth::user()->name ?? Auth::user()->email }}</span>
    </a>
    <a href="{{ route('designer.home') }}" class="vendor-menu__row">
        <div class="vendor-menu__icon">
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.45 9.52599C21.4494 9.52549 21.4489 9.52481 21.4484 9.52431L12.4741 0.55037C12.0916 0.167679 11.583 -0.0429688 11.042 -0.0429688C10.501 -0.0429688 9.99246 0.167679 9.60977 0.55037L0.640191 9.51978C0.63717 9.5228 0.633981 9.52599 0.631127 9.52901C-0.154397 10.3191 -0.153054 11.6009 0.634988 12.389C0.99502 12.7492 1.47036 12.9576 1.97877 12.9796C1.99958 12.9816 2.0204 12.9826 2.04138 12.9826H2.39889V19.5867C2.39889 20.8938 3.46237 21.9571 4.7694 21.9571H8.28042C8.63642 21.9571 8.92495 21.6684 8.92495 21.3125V16.1348C8.92495 15.5384 9.4102 15.0534 10.0066 15.0534H12.0775C12.6738 15.0534 13.1589 15.5384 13.1589 16.1348V21.3125C13.1589 21.6684 13.4474 21.9571 13.8034 21.9571H17.3144C18.6216 21.9571 19.685 20.8938 19.685 19.5867V12.9826H20.0166C20.5574 12.9826 21.066 12.772 21.4489 12.3891C22.2377 11.5999 22.2381 10.3157 21.45 9.52599V9.52599ZM20.5373 11.4777C20.3981 11.6169 20.2132 11.6936 20.0166 11.6936H19.0404C18.6844 11.6936 18.3959 11.9821 18.3959 12.3381V19.5867C18.3959 20.1829 17.9108 20.668 17.3144 20.668H14.448V16.1348C14.448 14.8278 13.3846 13.7643 12.0775 13.7643H10.0066C8.69936 13.7643 7.63589 14.8278 7.63589 16.1348V20.668H4.7694C4.1732 20.668 3.68796 20.1829 3.68796 19.5867V12.3381C3.68796 11.9821 3.39943 11.6936 3.04342 11.6936H2.08401C2.07394 11.6929 2.06404 11.6924 2.0538 11.6922C1.86178 11.6889 1.68168 11.6127 1.54673 11.4775C1.25971 11.1905 1.25971 10.7234 1.54673 10.4362C1.5469 10.4362 1.5469 10.4361 1.54707 10.4359L1.54757 10.4354L10.5215 1.46178C10.6605 1.32263 10.8453 1.2461 11.042 1.2461C11.2386 1.2461 11.4234 1.32263 11.5625 1.46178L20.5344 10.4335C20.5358 10.4349 20.5373 10.4362 20.5386 10.4376C20.8241 10.7251 20.8236 11.1912 20.5373 11.4777V11.4777Z" fill="white"/>
            </svg>
        </div>
        <span class="vendor-menu__row-title">Панель управления</span>
    </a>
    <a href="{{ route('designer.designer_info_show') }}" class="vendor-menu__row">
        <div class="vendor-menu__icon">
            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.85 17.5776C19.55 16.3579 17.7886 15.6769 16.2201 15.4192L16.4067 15.1627C16.4834 15.086 16.5217 14.971 16.4834 14.856L16.1312 13.4473C17.0771 12.1058 17.6334 10.431 17.6334 8.83763V6.15431C17.6334 2.781 14.8734 0.0209961 11.5 0.0209961C8.12673 0.0209961 5.36668 2.781 5.36668 6.15431V8.83763C5.36668 10.431 5.92299 12.1058 6.86882 13.4473L6.51668 14.856C6.51668 14.971 6.51668 15.086 6.59336 15.201L6.75504 15.4233C5.19283 15.6841 3.43792 16.3644 1.15004 17.5776C0.421682 17.9226 0 18.651 0 19.456V22.5993C0 22.8293 0.153318 22.9826 0.383318 22.9826H9.58332H13.4166H22.6166C22.8466 22.9826 23 22.8293 23 22.5993V19.456C23 18.6893 22.54 17.961 21.85 17.5776ZM11.5 16.6672L11.615 16.926L12.42 18.8044H10.5502L11.5 16.6672ZM10.2977 19.6912L10.3116 19.571H12.6883L12.7022 19.6912L12.9859 22.216H10.014L10.2977 19.6912ZM15.525 14.2043L15.6783 14.8943L15.2867 15.432C15.2618 15.4524 15.2386 15.4772 15.2183 15.5076L13.6235 17.7159L13.1179 18.41L12.0845 16.0848C13.3449 15.9311 14.4674 15.2886 15.3674 14.3681C15.4205 14.3146 15.4731 14.2602 15.525 14.2043ZM6.13332 6.15431C6.13332 3.20263 8.54832 0.787633 11.5 0.787633C14.4517 0.787633 16.8667 3.20263 16.8667 6.15431V8.83763C16.8667 10.484 16.3103 11.9497 15.471 13.0723L15.41 13.0926C15.3717 13.1309 15.3334 13.1693 15.295 13.2076C14.26 14.5876 12.9184 15.3159 11.5001 15.3159H11.5C10.12 15.3159 8.77836 14.5493 7.70504 13.2076C7.66673 13.1693 7.62836 13.1309 7.59004 13.0926L7.52913 13.0723C6.68977 11.9497 6.13341 10.484 6.13341 8.83763V6.15431H6.13332ZM10.9155 16.0849L9.88205 18.4101L9.37632 17.7156L7.78168 15.5076C7.76946 15.4954 7.75599 15.4833 7.74197 15.4714L7.32168 14.8943L7.475 14.2043C7.52693 14.2602 7.57958 14.3147 7.63272 14.3683C8.53264 15.2888 9.65506 15.9312 10.9155 16.0849ZM0.766682 19.456C0.766682 18.9577 1.035 18.4977 1.495 18.2677C3.93844 16.9696 5.69735 16.3181 7.26423 16.1235L9.58233 19.3109L9.23832 22.216H0.766682V19.456ZM22.2333 22.216H13.7996L13.462 19.2116L15.7355 16.0855C17.3027 16.318 19.0996 16.9693 21.505 18.2293C21.965 18.4976 22.2333 18.9576 22.2333 19.456V22.216V22.216Z" fill="white"/>
            </svg>
        </div>
        <span class="vendor-menu__row-title">О дизайнере</span>
    </a>
    <a href="{{ route('designer.projects.index') }}" class="vendor-menu__row">
        <div class="vendor-menu__icon">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 14C11.1046 14 12 13.1046 12 12C12 10.8954 11.1046 10 10 10C8.89543 10 8 10.8954 8 12C8 13.1046 8.89543 14 10 14Z" fill="white"/>
                <path d="M16 11C17.1046 11 18 10.1046 18 9C18 7.89543 17.1046 7 16 7C14.8954 7 14 7.89543 14 9C14 10.1046 14.8954 11 16 11Z" fill="white"/>
                <path d="M22 14C23.1046 14 24 13.1046 24 12C24 10.8954 23.1046 10 22 10C20.8954 10 20 10.8954 20 12C20 13.1046 20.8954 14 22 14Z" fill="white"/>
                <path d="M23 20C24.1046 20 25 19.1046 25 18C25 16.8954 24.1046 16 23 16C21.8954 16 21 16.8954 21 18C21 19.1046 21.8954 20 23 20Z" fill="white"/>
                <path d="M19 25C20.1046 25 21 24.1046 21 23C21 21.8954 20.1046 21 19 21C17.8954 21 17 21.8954 17 23C17 24.1046 17.8954 25 19 25Z" fill="white"/>
                <path d="M16.54 1.99992C14.6566 1.92722 12.7778 2.23558 11.0165 2.90653C9.25507 3.57747 7.64731 4.59717 6.28955 5.90451C4.93179 7.21184 3.852 8.77988 3.11491 10.5146C2.37781 12.2494 1.9986 14.1151 2 15.9999C1.99995 16.7412 2.1709 17.4726 2.49955 18.1371C2.8282 18.8016 3.30569 19.3813 3.8949 19.8312C4.4841 20.2811 5.16914 20.589 5.89674 20.731C6.62433 20.873 7.37488 20.8452 8.09 20.6499L9.21 20.3399C9.65555 20.2183 10.1232 20.2012 10.5764 20.2899C11.0296 20.3787 11.4563 20.5708 11.8231 20.8515C12.1898 21.1322 12.4869 21.4937 12.691 21.908C12.8952 22.3223 13.0009 22.7781 13 23.2399V26.9999C13 27.7956 13.3161 28.5586 13.8787 29.1212C14.4413 29.6838 15.2044 29.9999 16 29.9999C17.8848 30.0013 19.7506 29.6221 21.4853 28.885C23.22 28.1479 24.7881 27.0681 26.0954 25.7104C27.4028 24.3526 28.4225 22.7449 29.0934 20.9835C29.7643 19.2221 30.0727 17.3434 30 15.4599C29.8549 11.9366 28.3902 8.59665 25.8968 6.10317C23.4033 3.60969 20.0633 2.14501 16.54 1.99992ZM24.65 24.3099C23.5334 25.479 22.1909 26.4089 20.7039 27.0432C19.217 27.6775 17.6166 28.003 16 27.9999C15.7348 27.9999 15.4804 27.8946 15.2929 27.707C15.1054 27.5195 15 27.2651 15 26.9999V23.2399C15 21.9138 14.4732 20.6421 13.5355 19.7044C12.5979 18.7667 11.3261 18.2399 10 18.2399C9.55065 18.2407 9.1034 18.3012 8.67 18.4199L7.55 18.7299C7.13168 18.842 6.69316 18.8563 6.26844 18.7716C5.84373 18.6869 5.44422 18.5055 5.10092 18.2415C4.75761 17.9775 4.47972 17.6379 4.2888 17.2492C4.09788 16.8605 3.99906 16.433 4 15.9999C3.99876 14.3837 4.32402 12.7839 4.95625 11.2965C5.58848 9.80909 6.51467 8.46472 7.67923 7.34405C8.8438 6.22338 10.2227 5.3495 11.7333 4.77485C13.2439 4.2002 14.855 3.93662 16.47 3.99992C19.4772 4.15654 22.3198 5.42159 24.4491 7.55087C26.5783 9.68016 27.8434 12.5227 28 15.5299C28.0688 17.1459 27.8072 18.7589 27.2312 20.2703C26.6552 21.7817 25.7769 23.1597 24.65 24.3199V24.3099Z" fill="white"/>
            </svg>
        </div>
        <span class="vendor-menu__row-title">Проекты</span>
    </a>





    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="vendor-menu__row" style="position: relative; bottom: 0; left: 0; right: 0; color: #fff;">
        <div class="vendor-menu__icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
                <path d="M7.5 1v7h1V1h-1z"/>
                <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
              </svg>
        </div>
        <span class="vendor-menu__row-title">Выход</span>
    </a>
    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form> --}}
</nav>
