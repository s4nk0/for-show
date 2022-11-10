<x-guest-layout>
    <section class="home">
        <div class="bg-img"></div>
        <div class="container__main">
            <div class="home__info">
                <div class="home__info-title">
                    The world’s most
                    <br>secure trading platform</span>
                </div>
                <div class="home__info-text">
                    Join the fastest growing global cryptocurrency exchange <br> with the lowest fees around.
                </div>
                <div class="home__info-links" style="display:inline-flex;">
                    <a style="background: rgb(0,126,218);
background: linear-gradient(
90deg, rgba(0,126,218,1) 0%, rgb(52 161 193) 50%);" class="home__info-link" href="/trading">
                        Start trading
                    </a>
                    <a style="background: linear-gradient(90deg, rgb(84 60 216) 0%, rgb(67 96 148) 50%);" class="home__info-link" href="/login">
                        Login
                    </a>
                </div>
            </div>

        </div>
    </section>

    <section class="slider__graphics">
        <div class="slider__graphics-items container__header" >
            <div class="slider-graphics swiper">
                <div class="swiper-wrapper">
                    @foreach($crypto_get as $crypto)
                        <div class="swiper-slide">
                            <div class="graphics__slide ">

                                <a class="graphics__slide-link" href="/trading">
                                    <div class="graphics__slide-info">
                                        <div class="graphics__slide-container">
                                            <div class="graphics__slide-img">
                                                <img src="{{$crypto['image']}}" alt="">
                                            </div>
                                            <div class="graphics__slide-box">
                                                <div class="graphics__slide-name">
                                                    {{$crypto['name']}}
                                                </div>
                                                <div class="graphics__slide-date">
                                                    <?php
                                                    $date = new DateTime($crypto['last_updated']);
                                                    echo $date->format('M d, Y, h:i a');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="graphics__slide-button">
                                            <span>
                                                BUY
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="graphics__slide-prise">
                                        ${{$crypto['current_price']}}
                                    </div>

                                    <div class="graphics__slide-percent @if($crypto['price_change_percentage_24h'] < 0) graphics__bad-percent @endif">
                                        ${{$crypto['price_change_24h']}} ({{substr($crypto['price_change_percentage_24h'],0,4)}}%)
                                    </div>
                                </a>


                                <div class="graphics__slide-schedule">
                                    <div data-v-45bb570a="" data-v-486e7f86="" class="sparkline-chart-wrapper currency__chart"><svg data-v-45bb570a="" viewBox="0 0 475 160" class="chart chart--btc chart--light">
                                            <g data-v-45bb570a="">
                                                <path data-v-45bb570a="" d="M 13,118.0442 C 14.997310898748333,109.57514822957191 19.05964403399298,68.16298417555628 22.3061,60.7863 C 25.55255596600702,53.40961582444372 28.596555664426646,63.30188905266759 31.6122,67.6411 C 34.62784433557336,71.9803109473324 37.701742241648475,83.70654692202191 40.9183,90.6962 C 44.13485775835153,97.6858530779781 47.155467552191,110.38503894423741 50.2244,115.44030000000001 C 53.29333244780901,120.49556105576261 56.563732407722156,129.11743994405876 59.5305,125.45230000000001 C 62.49726759227785,121.78716005594127 65.98775603568274,91.94981280910518 68.8366,90.10640000000001 C 71.68544396431727,88.26298719089483 75.20775098192226,109.38288206217108 78.1427,112.5945 C 81.07764901807775,115.80611793782892 84.60622573936126,110.6254725353688 87.4488,112.35159999999999 C 90.29137426063875,114.07772746463118 93.68716452034465,119.60217213972302 96.7549,124.64150000000001 C 99.82263547965536,129.680827860277 103.26685672385794,146.6531736721497 106.061,147 C 108.85514327614207,147.3468263278503 112.40336972284464,130.6971591598488 115.36710000000001,127.0747 C 118.33083027715537,123.45224084015119 121.81138093039294,124.03019051515778 124.67320000000001,121.9564 C 127.53501906960707,119.88260948484223 131.12196629042745,114.62317756818372 133.97930000000002,112.6274 C 136.8366337095726,110.63162243181627 140.46157300707983,109.38654546617954 143.2854,108.0469 C 146.10922699292018,106.70725453382045 149.73726106273728,105.2009995635016 152.5915,103.25999999999999 C 155.44573893726272,101.31900043649838 159.03696252335146,92.46191123113061 161.8976,94.5153 C 164.75823747664856,96.56868876886938 168.365328975597,115.92196281590208 171.20370000000003,117.5667 C 174.04207102440304,119.21143718409792 177.6568623252669,107.91671560097251 180.5098,105.999 C 183.36273767473313,104.08128439902748 186.9912376571503,105.55422730648785 189.8159,104.19579999999999 C 192.6405623428497,102.83737269351214 196.16041443789732,100.09335249230479 199.122,96.50110000000001 C 202.0835855621027,92.90884750769523 205.63626795195057,79.36798850251581 208.42810000000003,79.3577 C 211.2199320480495,79.34741149748417 214.86231248469136,94.18510649405093 217.73420000000002,96.4289 C 220.60608751530867,98.67269350594908 224.20692245143178,93.43080292911242 227.0403,94.97540000000001 C 229.87367754856822,96.5199970708876 233.39454984859734,103.76442737444786 236.34640000000002,107.2188 C 239.2982501514027,110.67317262555214 242.86066874136526,118.86693449878796 245.65250000000003,118.875 C 248.4443312586348,118.88306550121204 251.98472126946433,111.04004214482165 254.95860000000002,107.27539999999999 C 257.9324787305357,103.51075785517833 261.4292190113628,94.4518772483098 264.2647,92.8646 C 267.1001809886372,91.27732275169019 270.60666950644037,92.56161047694869 273.5708,96.1897 C 276.53493049355967,99.81778952305132 279.8202925520099,122.83740991718476 282.87690000000003,117.9465 C 285.93350744799017,113.05559008281524 288.3694884085724,77.17697743471463 292.183,62.544799999999995 C 295.9965115914276,47.91262256528535 298.5456320906133,22.207759478463498 301.4891,18.873199999999997 C 304.4325679093867,15.538640521536497 307.97748991397117,38.265757501919424 310.7952,39.4614 C 313.6129100860289,40.65704249808057 317.308064598115,27.509111424167738 320.10130000000004,27.239099999999993 C 322.8945354018851,26.96908857583225 326.5410529369752,35.41584416185598 329.40740000000005,37.566900000000004 C 332.2737470630249,39.71795583814403 335.9065038941935,43.12153940157256 338.7135,42.218599999999995 C 341.5204961058065,41.31566059842743 345.10884251254606,34.09617302905892 348.0196,31.241600000000005 C 350.930357487454,28.38702697094109 354.42935861450877,25.046647955627186 357.32570000000004,22.412000000000006 C 360.2220413854913,19.777352044372826 363.8361429289281,12.493617140272125 366.6318,12.94059999999999 C 369.4274570710719,13.387582859727853 372.81450085784746,19.77229939082897 375.9379,25.547300000000007 C 379.06129914215256,31.322300609171045 382.2458792150861,48.45655256374337 385.244,52.5565 C 388.24212078491394,56.65644743625663 391.70464795937386,52.054173352124025 394.55010000000004,53.8347 C 397.3955520406262,55.61522664787597 400.98073280325417,62.6769366036133 403.85620000000006,64.9797 C 406.73166719674595,67.28246339638669 410.35829388793667,69.05194622880003 413.1623,69.8579 C 415.96630611206336,70.66385377119997 419.41832096853364,65.82391948671525 422.46840000000003,70.6275 C 425.5184790314664,75.43108051328474 428.78158578694945,98.88370936165329 431.77450000000005,102.91210000000001 C 434.76741421305064,106.94049063834674 438.1909742197408,100.9591467324299 441.0806,98.4293 C 443.9702257802592,95.8994532675701 447.5306357280472,87.30300720120668 450.3867,85.3296 C 453.24276427195286,83.35619279879332 458.29654791121385,84.76751625881089 459.69280000000003,84.67410000000001" class="chart__sparkline"></path>
                                                <circle data-v-45bb570a="" cx="13" cy="110.0299" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="22.3061" cy="118.0442" r="6" class="chart__circle">
                                                </circle>
                                                <circle data-v-45bb570a="" cx="31.6122" cy="60.7863" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="40.9183" cy="67.6411" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="50.2244" cy="90.6962" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="59.5305" cy="115.44030000000001" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="68.8366" cy="125.45230000000001" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="78.1427" cy="90.10640000000001" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="87.4488" cy="112.5945" r="6" class="chart__circle">
                                                </circle>
                                                <circle data-v-45bb570a="" cx="96.7549" cy="112.35159999999999" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="106.061" cy="124.64150000000001" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="115.36710000000001" cy="147" r="6" class="chart__circle">
                                                </circle>
                                                <circle data-v-45bb570a="" cx="124.67320000000001" cy="127.0747" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="133.97930000000002" cy="121.9564" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="143.2854" cy="112.6274" r="6" class="chart__circle">
                                                </circle>
                                                <circle data-v-45bb570a="" cx="152.5915" cy="108.0469" r="6" class="chart__circle">
                                                </circle>
                                                <circle data-v-45bb570a="" cx="161.8976" cy="103.25999999999999" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="171.20370000000003" cy="94.5153" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="180.5098" cy="117.5667" r="6" class="chart__circle">
                                                </circle>
                                                <circle data-v-45bb570a="" cx="189.8159" cy="105.999" r="6" class="chart__circle">
                                                </circle>
                                                <circle data-v-45bb570a="" cx="199.122" cy="104.19579999999999" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="208.42810000000003" cy="96.50110000000001" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="217.73420000000002" cy="79.3577" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="227.0403" cy="96.4289" r="6" class="chart__circle">
                                                </circle>
                                                <circle data-v-45bb570a="" cx="236.34640000000002" cy="94.97540000000001" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="245.65250000000003" cy="107.2188" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="254.95860000000002" cy="118.875" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="264.2647" cy="107.27539999999999" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="273.5708" cy="92.8646" r="6" class="chart__circle">
                                                </circle>
                                                <circle data-v-45bb570a="" cx="282.87690000000003" cy="96.1897" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="292.183" cy="117.9465" r="6" class="chart__circle">
                                                </circle>
                                                <circle data-v-45bb570a="" cx="301.4891" cy="62.544799999999995" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="310.7952" cy="18.873199999999997" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="320.10130000000004" cy="39.4614" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="329.40740000000005" cy="27.239099999999993" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="338.7135" cy="37.566900000000004" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="348.0196" cy="42.218599999999995" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="357.32570000000004" cy="31.241600000000005" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="366.6318" cy="22.412000000000006" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="375.9379" cy="12.94059999999999" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="385.244" cy="25.547300000000007" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="394.55010000000004" cy="52.5565" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="403.85620000000006" cy="53.8347" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="413.1623" cy="64.9797" r="6" class="chart__circle">
                                                </circle>
                                                <circle data-v-45bb570a="" cx="422.46840000000003" cy="69.8579" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="431.77450000000005" cy="70.6275" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="441.0806" cy="102.91210000000001" r="6" class="chart__circle"></circle>
                                                <circle data-v-45bb570a="" cx="450.3867" cy="98.4293" r="6" class="chart__circle">
                                                </circle>
                                                <circle data-v-45bb570a="" cx="459.69280000000003" cy="94.2259" r="6" class="chart__circle"></circle>
                                                <path data-v-45bb570a="" d="M -50,0 L-50,160" class="chart__line"></path>
                                            </g>
                                        </svg></div>
                                </div>

                                <div class="graphics__slide-volume">
                                    ${{number_format($crypto['total_volume'])}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="slider__graphics-button-next"></div>
            <div class="slider__graphics-button-prev"></div>


            <div class="swiper-pagination-grafix"></div>
        </div>
    </section>



    <section class="statistics">
        <div class="container__main">
            <div class="statistics__items">
                <div class="statistics__items-names">
                    <div class="statistics__items-name statistics-name">
                        Name
                    </div>
                    <div class="statistics__items-name statistics-name">
                        Ticker
                    </div>
                    <div class="statistics__items-name statistics-name">
                        Prise
                    </div>
                    <div class="statistics__items-name statistics-dynamics">
                        Dynamics
                    </div>
                    <div class="statistics__items-name statistics-market">
                        Market
                    </div>
                </div>
                @foreach($crypto_get_second as $crypto)
                <a class="statistics__item" href="/trading">
                    <div class="statistics__item-logo">
                        <img src="{{$crypto['image']}}" alt="">
                    </div>
                    <div class="statistics__item-name statistics-name">
                        {{$crypto['name']}}
                    </div>
                    <div class="statistics__item-ticker statistics-name">
                        {{strtoupper($crypto['symbol'])}}
                    </div>
                    <div class="statistics__item-prise statistics-name">
                        ${{$crypto['current_price']}}
                    </div>
                    <div class="statistics__item-dynamics statistics-dynamics">
                        <div class="statistics__dynamics-btn @if($crypto['price_change_percentage_24h']>0) prise-positive @endif" >
                            {{substr($crypto['price_change_percentage_24h'],0,4)}}%
                        </div>
                    </div>
                    <div class="statistics__item-market statistics-market">
                        <svg width="120" height="52" viewBox="0 0 120 52" fill="none"
                             class="GraphGenerator _1p1R">
                            <path
                                d="M0 52L0 0.00L2.5 3.96L5 5.62L7.5 8.71L10 1.60L12.5 3.41L15 4.45L17.5 2.51L20 4.59L22.5 2.30L25 6.17L27.5 12.32L30 9.12L32.5 27.00L35 21.42L37.5 16.49L40 11.50L42.5 11.77L45 10.14L47.5 10.42L50 12.11L52.5 15.08L55 14.48L57.5 14.88L60 13.33L62.5 10.76L65 10.28L67.5 9.94L70 6.52L72.5 7.13L75 6.93L77.5 7.27L80 7.96L82.5 7.48L85 5.35L87.5 4.79L90 6.65L92.5 6.72L95 8.16L97.5 8.37L100 8.16L102.5 12.18L105 14.41L107.5 12.38L110 8.57L112.5 9.05L115 14.34L117.5 17.16L120 21.29L465 52"
                                fill="url(#BTCgradient)"></path>
                            <path
                                d="M0 1L2.5 4.96L5 6.62L7.5 9.71L10 2.6L12.5 4.41L15 5.45L17.5 3.51L20 5.59L22.5 3.3L25 7.17L27.5 13.32L30 10.12L32.5 28L35 22.42L37.5 17.49L40 12.5L42.5 12.77L45 11.14L47.5 11.42L50 13.11L52.5 16.08L55 15.48L57.5 15.88L60 14.33L62.5 11.76L65 11.28L67.5 10.94L70 7.52L72.5 8.129999999999999L75 7.93L77.5 8.27L80 8.96L82.5 8.48L85 6.35L87.5 5.79L90 7.65L92.5 7.72L95 9.16L97.5 9.37L100 9.16L102.5 13.18L105 15.41L107.5 13.38L110 9.57L112.5 10.05L115 15.34L117.5 18.16L120 22.29"
                                stroke="#F05248"></path>
                            <defs>
                                <lineargradient id="BTCgradient" x1="120" y1="0" x2="120"
                                                y2="52" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#effdf5"></stop>
                                    <stop offset="1" stop-color="#F7F7F7" stop-opacity="0">
                                    </stop>
                                </lineargradient>
                            </defs>
                        </svg>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="statistics__item-link">
                <a href="/trading">View more Markets</a>
            </div>


        </div>
    </section>
    <section class="benefits">
        <div class="container__main">
            <div class="benefits__wrapper">
                <div class="benefits__title">
                    The complete trading essentials,
                    unified in a single platform
                </div>
                <div class="benefits__container swiper">

                    <div class="benefits__items-wrapper swiper-wrapper">


                        <div class="benefits__item-box swiper-slide">
                            <div class="benefits__item-img-box">
                                <img class="benefits__item-img" src="{{asset('assets/images/benefits-images/integrated-order.png')}}'" alt="" >
                            </div>
                            <div class="benefits__item-des-box">
                                <div class="benefits__item-title">
                                    Integrated orders for spot and margin
                                </div>
                                <div class="benefits__item-des">
                                    Set take profit, stop loss, limit orders, and more advanced order types for spot and margin in one unified order interface with up to 5x leverage.
                                </div>
                            </div>

                        </div>

                        <div class="benefits__item-box swiper-slide">
                            <div class="benefits__item-img-box">
                                <img class="benefits__item-img" src="{{asset('assets/images/benefits-images/deep-liquidity.png')}}" alt="" >
                            </div>
                            <div class="benefits__item-des-box">
                                <div class="benefits__item-title">
                                    Deep liquidity and order book depth
                                </div>
                                <div class="benefits__item-des">
                                    Bitrouse offers best-in-class liquidity and order book depth allowing large trades to be executed with the least slippage.
                                </div>
                            </div>

                        </div>

                        <div class="benefits__item-box swiper-slide">
                            <div class="benefits__item-img-box">
                                <img class="benefits__item-img" src="{{asset('assets/images/benefits-images/customizable.png')}}" alt="" >
                            </div>
                            <div class="benefits__item-des-box">
                                <div class="benefits__item-title">
                                    Fully customizable workspaces
                                </div>
                                <div class="benefits__item-des">
                                    Customize trading trading canvases with drag-and-drop modules such as multi-charts and trading data widgets.
                                </div>
                            </div>

                        </div>

                        <div class="benefits__item-box swiper-slide">
                            <div class="benefits__item-img-box">
                                <img class="benefits__item-img" src="{{asset('assets/images/benefits-images/zero-fee.png')}}" alt="" >
                            </div>
                            <div class="benefits__item-des-box">
                                <div class="benefits__item-title">
                                    Zero-fee trading
                                </div>
                                <div class="benefits__item-des">
                                    Unlock zero maker and taker spot trading fees by staking your coins in any invest plan.
                                </div>
                            </div>

                        </div>

                        <div class="benefits__item-box swiper-slide">
                            <div class="benefits__item-img-box">
                                <img class="benefits__item-img" src="{{asset('assets/images/benefits-images/trade-futures.png')}}" alt="" >
                            </div>
                            <div class="benefits__item-des-box">
                                <div class="benefits__item-title">
                                    Trade futures with leverage
                                </div>
                                <div class="benefits__item-des">
                                    Futures trading and leverage will be enabled across a variety of major pairs.
                                </div>
                            </div>

                        </div>

                        <div class="benefits__item-box swiper-slide">
                            <div class="benefits__item-img-box">
                                <img class="benefits__item-img" src="{{asset('assets/images/benefits-images/social.png')}}" alt="" >
                            </div>
                            <div class="benefits__item-des-box">
                                <div class="benefits__item-title">
                                    Social trading
                                </div>
                                <div class="benefits__item-des">
                                    Learn from profitable trading strategies and emulate successful traders with a record of proven profitability.
                                </div>
                            </div>

                        </div>


                    </div>


                </div>
                <div class="swiper-pagination-benefits"></div>

            </div>

        </div>
    </section>
    <section class="experienced">
        <div class="container__main">
            <div class="experienced__info">
                <div class="experienced__info-title">
                    For experienced traders
                </div>
                <div class="experienced__info-text">
                    Trade like a pro on Bitrouse                </div>
            </div>
            <div class="experienced__items">
                <div class="experienced__item">
                    <div class="experienced__items-benefits">
                        Powerful
                    </div>
                    <div class="experienced__item-title">
                        API
                    </div>
                    <div class="experienced__item-text">
                        Customize your private functionality and
                        get more options
                    </div>
                </div>
                <div class="experienced__item">
                    <div class="experienced__items-benefits">
                        Leverage
                    </div>
                    <div class="experienced__item-title">
                        5x
                    </div>
                    <div class="experienced__item-text">
                        Increase your personal income a few
                        times faster
                    </div>
                </div>
                <div class="experienced__item">
                    <div class="experienced__items-benefits">
                        Accurate
                    </div>
                    <div class="experienced__item-title">
                        AML
                    </div>
                    <div class="experienced__item-text">
                        Make sure your addresses are not
                        involved in money laundering
                    </div>
                </div>
            </div>

        </div>
    </section>


    <div class="calck_frame" id="calck_frame">
        <div class="container">
            <div class="calck_frame-blocks">
                <div class="calck_frame-content wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                    <div class="calck_frame-title">Investment<br> calculator</div>
                    <div class="calck_frame-text">Calculate how much<br> you can earn with us
                    </div>
                    <div class="present-btn"><a href="#" class="btn btn3">Invest now</a></div>
                </div>
                <div class="calck_frame-item wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="calck_frame-item-title">Deposit amount</div>
                    <div class="calck_frame-item-inp-block">
                        <input type="text" class="calck_frame-item-inp" value="100">
                        <div class="calck_frame-item-inp-text">$</div>
                    </div>
                    <div class="calck_frame-item-slider">
                        <div id="calck_frame_slider" class="noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr">
                        </div>
                    </div>
                    <div class="calck_frame-item-title calck_frame-item-title2">Select the investment period</div>
                    <div class="calck_frame-btns">
                        <a href="#" class="active">1 week</a>
                        <a href="#" class="">2 weeks</a>
                        <a href="#" class="">1 month</a>
                        <a href="#" class="">3 months</a>
                    </div>
                    <div class="calck_frame-item-info-blocks">
                        <div class="calck_frame-item-info">
                            <div class="calck_frame-item-info-block green">
                                <div class="calck_frame-item-info-block-title">Your profit</div>
                                <div class="calck_frame-item-info-block-text">+<span class="sum2">0</span> $
                                </div>
                            </div>
                            <div class="calck_frame-item-info-block">
                                <div class="calck_frame-item-info-block-title">Total</div>
                                <div class="calck_frame-item-info-block-text"><span class="sum1">0</span> $
                                </div>
                            </div>
                            <div class="calck_frame-item-info-block">
                                <div class="calck_frame-item-info-block-title">Percentage</div>
                                <div class="calck_frame-item-info-block-text"><span class="percent">10%</span></div>
                            </div>
                        </div>

                    </div>
                    <div class="bottom">
                        <div class="present-btn"><a href="{{route('user.invest')}}" class="btn btn3">Invest now</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="advantage">
        <div class="container__main">

            <div class="advantage__items-wrapper">

                <div class="advantage__item-box">
                    <div class="advantage__img-box">
                        <img src="{{asset('assets/images/advantage-images/1598367322-home-metrics-coins.svg')}}" alt="" class="advantage__img">
                    </div>
                    <div class="advantage__content">
                        <div class="advantage__title">40+</div>
                        <div class="advantage__title-des">Coins</div>
                        <div class="advantage__des">
                            We offer a wide range of relevant coins on the market, which are curated with care by our experts.
                        </div>
                    </div>

                </div>


                <div class="advantage__item-box">
                    <div class="advantage__img-box">
                        <img src="{{asset('assets/images/advantage-images/1598451413-home-metrics-daily-volume.svg')}}" alt="" class="advantage__img">
                    </div>
                    <div class="advantage__content">
                        <div class="advantage__title">€1.000.000+</div>
                        <div class="advantage__title-des">Daily market volume</div>
                        <div class="advantage__des">
                            Our state-of-the-art systems are built to securely process high volumes each day.
                        </div>
                    </div>

                </div>

                <div class="advantage__item-box">
                    <div class="advantage__img-box">
                        <img src="{{asset('assets/images/advantage-images/1598451316-home-metrics-app-downloads.svg')}}" alt="" class="advantage__img">
                    </div>
                    <div class="advantage__content">
                        <div class="advantage__title">Best broker</div>
                        <div class="advantage__title-des">Trusted across Europe</div>
                        <div class="advantage__des">
                            We have been voted 'Best Crypto Broker' 2019 & 2020 and on our way to become the number 1 in Europe.
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <section class="company">
        <div class="container__header">
            <div class="company__items">
                <div class="marquee">
                    <ul class="marquee-content">
                        <li>
                            <img src="{{asset('assets/images/company-images/Bitcoin.svg')}}" alt="">
                        </li>
                        <li>
                            <img src="{{asset('assets/images/company-images/Bloomberg.svg')}}" alt="">
                        </li>
                        <li>
                            <img src="{{asset('assets/images/company-images/Business-Insider.svg')}}" alt="">
                        </li>
                        <li>
                            <img src="{{asset('assets/images/company-images/Coindesk.svg')}}" alt="">
                        </li>
                        <li>
                            <img src="{{asset('assets/images/company-images/CryptoDaily.svg')}}" alt="">
                        </li>
                        <li>
                            <img src="{{asset('assets/images/company-images/CT.svg')}}" alt="">
                        </li>
                        <li>
                            <img src="{{asset('assets/images/company-images/Finance-Magnates.svg')}}" alt="">
                        </li>
                        <li>
                            <img src="{{asset('assets/images/company-images/Investing.svg')}}" alt="">
                        </li>
                        <li>
                            <img src="{{asset('assets/images/company-images/SCMP.svg')}}" alt="">
                        </li>
                        <li>
                            <img src="{{asset('assets/images/company-images/TET.svg')}}" alt="">
                        </li>
                        <li>
                            <img src="{{asset('assets/images/company-images/TIA.svg')}}" alt="">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="anywhere">
        <div class="container__main">
            <div class="anywhere__wrapper">
                <div class="anywhere__content-box">
                    <div class="anywhere__title">Trade anytime, anywhere</div>
                    <div class="anywhere__title-des">Boost your trading impact and reaction time in over 40+ cryptocurrencies via instant access to your portfolio.</div>
                    <div class="homeinfo__links"><a style="background: rgb(0,126,218); background: linear-gradient(90deg, rgba(0,126,218,1) 0%, rgba(10,135,138,1) 50%);" class="home__info-link" href="/trading">
                            Start trading
                        </a></div>
                </div>
                <div class="anywhere__img-box">
                    <img class="anywhere__img" src="{{asset('assets/images/anywhere-image/1611070929-leadsite-app-bodyminified.png')}}" alt="">
                </div>

            </div>
        </div>
    </section>
</x-guest-layout>
