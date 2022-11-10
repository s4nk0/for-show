<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="{{ asset('css/page-landing/landing_page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.min.css?v=').time() }}">
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>ARMADA Business</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600&display=swap"
        rel="stylesheet"
    />
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
        integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>
</head>
<body>
<div class="app_container">
    <!-- Banner -->
    <div class="banner_wrapper">
        <div class="banner_container">
            <div class="banner_left_section">
                <p class="banner_title">ПРОДАВАЙТЕ С НАМИ НА МАРКЕТЕ ARMADA.KZ</p>
                <p class="banner_text">
                    Маркетплейс ARMADA.KZ площадка на которой представлены лучшие
                    предложения предметов мебели и аксессуаров для дома и ремонта.
                </p>

                <a
                    href="https://armada.kz/seller/register"
                    target="_blank"
                    class="banner_btn modal-open"
                >Начать продавать</a
                >
            </div>
            <img src="{{asset('img/landing_page/assets/bannerImg.png')}}" alt="bannerImg" class="bannerImg" />
        </div>
    </div>
    <!-- End Banner -->

    <!-- Features -->
    <div class="features_wrapper">
        <p class="title features__title">Мы предлагаем нашим партнерам:</p>
        <div class="features_grid">
            <div class="features_content">
                <div class="logo_wrapper">
                    <img
                        src="{{asset('img/landing_page/assets/icons/add_shopping.svg')}}"
                        alt="add_shopping"
                        class="features_logo"
                    />
                </div>
                <p class="features_text">
                    Размещение товаров на нашей интернет-витрине
                </p>
            </div>
            <div class="features_content">
                <div class="logo_wrapper">
                    <img
                        src="{{asset('img/landing_page/assets/icons/bar_chart.svg')}}"
                        alt=""
                        class="features_logo"
                    />
                </div>

                <p class="features_text w-300px">
                    Статистика и аналитика продаж на сайте
                </p>
            </div>
            <div class="features_content">
                <div class="logo_wrapper">
                    <img
                        src="{{asset('img/landing_page/assets/icons/line_chart_up.svg')}}"
                        alt=""
                        class="features_logo"
                    />
                </div>
                <p class="features_text">Повышение объемов продаж вашего товара</p>
            </div>
            <div class="features_content">
                <div class="logo_wrapper">
                    <img
                        src="{{asset('img/landing_page/assets/icons/campaign.svg')}}"
                        alt=""
                        class="features_logo"
                    />
                </div>
                <p class="features_text">
                    Берём на себя затраты на рекламу и продвижение товаров в интернете
                </p>
            </div>
        </div>
    </div>
    <!-- End Features -->

    <!-- Serives -->
    <div class="service_wrapper">
        <p class="title service_title">
            Станьте продавцом и зарабатывайте на ARMADA.KZ уже сейчас
        </p>
        <div class="service_content">
            <img
                src="{{asset('img/landing_page/assets/mobile_login.png')}}"
                class="service_img"
                alt="mobile_login"
            />
            <div class="service_requests_wrapper">
                <div class="service_request">
                    <div class="logo_wrapper service_logo_container">
                        <span class="service_logo_num">1</span>
                    </div>
                    <p class="service_text">Регистрируйтесь как «продавец»</p>
                </div>
                <div class="service_request">
                    <div class="logo_wrapper service_logo_container">
                        <span class="service_logo_num">2</span>
                    </div>
                    <p class="service_text">Создайте страницу «магазина»</p>
                </div>
                <div class="service_request">
                    <div class="logo_wrapper service_logo_container">
                        <span class="service_logo_num">3</span>
                    </div>
                    <p class="service_text">Добавляйте товары</p>
                </div>
                <div class="service_request">
                    <div class="logo_wrapper service_logo_container">
                        <span class="service_logo_num">4</span>
                    </div>
                    <p class="service_text">
                        Получайте заявку от клиента и продавайте товары
                    </p>
                </div>
                <a
                    href="https://armada.kz/seller/register"
                    target="_blank"
                    class="service_footer_btn service_btn"
                >Начать продавать</a
                >
            </div>
        </div>
    </div>
    <!-- End of Service -->
    <!-- Hotline -->
    <div class="hotline_wrapper">
        <p class="title hotline_title">Поможем разобраться</p>
        <p class="hotline_text">
            Рассказываем, с чего начать работу на маркетплейсе и что важно знать
            на старте — участвуйте в живом диалоге
        </p>
        <button class="hotline_btn" data-toggle="modal" data-target="#callback">
            <div style="display: flex; align-items: center; gap: 20px">
                <div class="ripple"></div>
                <span> Позвонить </span>
            </div>
        </button>
        <img src="{{asset('img/landing_page/assets/hotline.png')}}" alt="" class="hotline_img" />
    </div>
    <!-- End of Hotline -->
    <!-- Footer -->
    <div class="footer_wrapper">
        <div class="footer_container">
            <p class="title footer_title">Присоединяйтесь, будем расти вместе</p>

            <a
                href="https://armada.kz/seller/register"
                target="_blank"
                class="service_footer_btn footer_btn modal-open"
            >Начать продавать</a
            >
        </div>
    </div>
    <!-- end footer -->
</div>

<!-- Modal -->
@include('layouts.modals.callback',['type'=>\App\Models\Callback::RENTER])
{{--<div--}}
{{--    class="modal fade applicationPost"--}}
{{--    id="callback"--}}
{{--    tabindex="-1"--}}
{{--    role="dialog"--}}
{{-->--}}
{{--    <div class="modal_container">--}}
{{--        <div class="modal_header">--}}
{{--            <svg--}}
{{--                class="my-4"--}}
{{--                width="95"--}}
{{--                height="95"--}}
{{--                viewBox="0 0 95 95"--}}
{{--                fill="none"--}}
{{--                xmlns="http://www.w3.org/2000/svg"--}}
{{--            >--}}
{{--                <path--}}
{{--                    d="M92.5523 70.0965L80.7454 58.287C77.5952 55.1368 72.0913 55.1314 68.9359 58.287L66.967 60.2559L90.5842 83.8717L92.5523 81.9036C95.8215 78.6343 95.8105 73.3492 92.5523 70.0965Z"--}}
{{--                    fill="#C9C9C9"--}}
{{--                />--}}
{{--                <path--}}
{{--                    d="M62.9219 64.0823C60.4374 66.0069 56.8931 65.9301 54.623 63.655L31.278 40.2939C29.0027 38.0185 28.926 34.4716 30.8507 31.9932L7.28793 8.43176C-2.84868 20.2474 -2.45235 38.0512 8.7352 49.2387L45.6781 86.1978C56.4139 96.9332 73.9991 98.357 86.4858 87.6445L62.9219 64.0823Z"--}}
{{--                    fill="#C9C9C9"--}}
{{--                />--}}
{{--                <path--}}
{{--                    d="M36.6461 14.1741L24.8392 2.36456C21.689 -0.785657 16.1851 -0.791038 13.0297 2.36456L11.0609 4.33339L34.678 27.9492L36.6461 25.981C39.9151 22.712 39.9043 17.4269 36.6461 14.1741Z"--}}
{{--                    fill="#C9C9C9"--}}
{{--                />--}}
{{--            </svg>--}}
{{--            <p class="modal_title">Перезвоните мне</p>--}}
{{--            <p class="modal_text">--}}
{{--                Поможем подобрать для Вас самый подходящий вариант!--}}
{{--            </p>--}}
{{--        </div>--}}
{{--        <div class="modal_form_wrapper">--}}
{{--            <div class="modal_form_container">--}}
{{--                <div class="modal_form_item">--}}
{{--                    <svg--}}
{{--                        class="input-prefix"--}}
{{--                        width="15"--}}
{{--                        height="16"--}}
{{--                        viewBox="0 0 15 16"--}}
{{--                        fill="none"--}}
{{--                        xmlns="http://www.w3.org/2000/svg"--}}
{{--                    >--}}
{{--                        <path--}}
{{--                            d="M7.5 0C5.0187 0 3 2.01871 3 4.50002C3 6.98133 5.0187 9 7.5 9C9.9813 9 12 6.98129 12 4.49998C12 2.01867 9.9813 0 7.5 0ZM7.5 7.87503C5.63903 7.87503 4.125 6.36099 4.125 4.50002C4.125 2.63904 5.63903 1.125 7.5 1.125C9.36097 1.125 10.875 2.63904 10.875 4.50002C10.875 6.36099 9.36097 7.87503 7.5 7.87503Z"--}}
{{--                            fill="#737373"--}}
{{--                        />--}}
{{--                        <path--}}
{{--                            d="M7.50018 8.36719C3.57849 8.36719 0.387939 11.5577 0.387939 15.4794V15.9999H14.6124V15.4795C14.6124 11.5577 11.4219 8.36719 7.50018 8.36719ZM1.45084 14.959C1.7157 11.854 4.32769 9.40801 7.50018 9.40801C10.6727 9.40801 13.2847 11.8539 13.5495 14.959H1.45084Z"--}}
{{--                            fill="#737373"--}}
{{--                            stroke="#737373"--}}
{{--                            stroke-width="0.2"--}}
{{--                        />--}}
{{--                    </svg>--}}
{{--                    <input type="text" placeholder="Ваше имя" />--}}
{{--                </div>--}}

{{--                <div class="modal_form_item">--}}
{{--                    <svg--}}
{{--                        class="input-prefix"--}}
{{--                        width="17"--}}
{{--                        height="17"--}}
{{--                        viewBox="0 0 17 17"--}}
{{--                        fill="none"--}}
{{--                        xmlns="http://www.w3.org/2000/svg"--}}
{{--                    >--}}
{{--                        <path--}}
{{--                            d="M15.6579 11.1932C14.6092 11.1932 13.5821 11.0294 12.6077 10.7073C12.1326 10.5436 11.594 10.6697 11.2809 10.9883L9.35092 12.4458C7.13732 11.2648 5.72006 9.84838 4.55335 7.64913L5.97149 5.76481C6.32849 5.40693 6.45645 4.88527 6.30345 4.39586C5.98043 3.417 5.81581 2.38895 5.81581 1.34211C5.81581 0.602144 5.21366 0 4.4737 0H1.34211C0.602144 0 0 0.602144 0 1.34211C0 9.97542 7.02458 17 15.6579 17C16.3979 17 17 16.3979 17 15.6579V12.5353C17 11.7953 16.3979 11.1932 15.6579 11.1932ZM16.1053 15.6579C16.1053 15.9048 15.904 16.1053 15.6579 16.1053C7.51756 16.1053 0.894724 9.48244 0.894724 1.34211C0.894724 1.09516 1.09604 0.894724 1.34211 0.894724H4.4737C4.71977 0.894724 4.92108 1.09516 4.92108 1.34211C4.92108 2.4847 5.10005 3.6067 5.45076 4.67053C5.50264 4.83783 5.46061 5.01054 5.29687 5.18053L3.66844 7.33683C3.56556 7.47373 3.54945 7.65714 3.62729 7.80926C4.95418 10.4156 6.56563 12.028 9.19079 13.3727C9.34198 13.4515 9.52719 13.4354 9.66409 13.3316L11.8669 11.662C11.9869 11.5439 12.1631 11.5028 12.3224 11.5555C13.3925 11.909 14.5145 12.0879 15.658 12.0879C15.904 12.0879 16.1054 12.2883 16.1054 12.5353V15.6579H16.1053Z"--}}
{{--                            fill="#737373"--}}
{{--                        />--}}
{{--                    </svg>--}}
{{--                    <input--}}
{{--                        type="text"--}}
{{--                        id="callback-phone"--}}
{{--                        placeholder="+7 (---) --- -- --"--}}
{{--                    />--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="modal_footer">--}}
{{--            <button id="modal-close" class="modal_footer_btn close">--}}
{{--                Закрыть--}}
{{--            </button>--}}
{{--            <button class="modal_footer_btn send">Отправить</button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        $("#callback-phone").mask("+7 (000) 000-000-00");--}}

{{--        $("#modal-close").click(function () {--}}
{{--            $("#callback").hide();--}}
{{--            $(".modal_container").removeClass('modal_center');--}}
{{--        });--}}

{{--        $(".modal-open").click(function () {--}}
{{--            $("#callback").show();--}}
{{--            $(".modal_container").addClass('modal_center');--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
