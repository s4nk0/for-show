
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @isset($styles_main)
        {{ $styles_main }}
        @else
    <link rel="icon" href="{{asset('assets/img/favicon.ico')}}">
    <link ref="{{asset('assets/img/favicon-32x32.png')}}" rel="icon" sizes="32x32" type="image/png">

    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/notifications/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/popap-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/stake.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/popup/popup-verifi.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    @livewireStyles

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function balance(userId, currency, action) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:"{{ route('admin.show') }}",
                data: { user_id: userId, currency: currency, action: action },
                success: function (data) {
                    if($.isEmptyObject(data.error)) {
                        alert(data);
                    } else {
                        console.log(data.error);
                    }
                }
            });

        }
    </script>
    <script>
        function send_payment() {
            var from = $('#from').val();
            var to = $('#address').val();
            var amount = $('#amount').val();
            var currency = $('#currency').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:"{{ route('transaction.store') }}",
                data: { from: from, to: to, amount: amount, currency: currency },
                success: function (data) {
                    data = JSON.parse(data);
                    if($.isEmptyObject(data.error)) {
                        alert(data.message);
                        if (data.status == "200") {
                            location.reload();
                        }
                    } else {
                        console.log(data.error);
                    }
                }
            });
        }
    </script>
    @endisset
</head>
<body id="dark" class="stop-scrolling">

<!-- Page Heading -->
    <header class="dark-bb">
        <livewire:navigation/>
    </header>
    <div class="b1">
        <x-user.message>Welcome Back,</x-user.message>

        <div class="content-body">
            <div class="container">
                <div class="row">
                    <x-user.profile-menu/>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

<!--footer start-->
<div class="bottom section-padding">
    <div class="container" style="max-width: 1024px;">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="bottom-logo">
                    <a class="navbar-logo-vn d-flex" href="/">
                        <x-application-logo /><span class="ml-3">bitrouse.com</span>
                    </a>
                    <p style="width: 230px;">Bitrouse is a simple, elegant, and secure platform to build your crypto portfolio.</p>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                <div class="bottom-widget">
                    <h4 class="widget-title">Features</h4>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="{{route('main.trading')}}">Trading</a></li>
                        <li><a href="{{route('user.wallet')}}">Wallet</a></li>
                        <li><a href="{{route('user.invest')}}">Invest</a></li>
                        <li><a href="{{route('user.invest')}}">Support</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                <div class="bottom-widget">
                    <h4 class="widget-title">Market tools</h4>
                    <ul>
                        <li><a href="{{route('main.market-crypto')}}">Crypto market cap</a></li>
                        <li><a href="{{route('main.market-screener')}}">Market screener</a></li>
                        <li><a href="{{route('main.technical-analysis')}}">Technical analysis</a></li>
                        <li><a href="{{route('main.cross-rates')}}">Cross rates</a></li>
                        <li><a href="{{route('main.heat-map')}}">Currency heat map</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                <div class="bottom-widget">
                    <h4 class="widget-title">Legal</h4>
                    <ul>
                        <li><a href="/terms">Terms of service</a></li>
                        <li><a href="{{route('main.privacy-notice')}}">Privacy notice</a></li>
                        <li><a href="{{route('main.cookies-policy')}}">Cookies policy</a></li>
                        <li><a href="{{route('main.aml-kyc-policy')}}">AML & KYC policy</a></li>
                        <li><a href="{{route('main.fees')}}">Fees</a></li>

                    </ul>
                </div>
            </div>
{{--            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-w">--}}
{{--                <div class="bottom-widget">--}}
{{--                    <h4 class="widget-title">Exchange Pair</h4>--}}
{{--                    <ul>--}}
{{--                        <li><a href="trading%EF%B9%96pair=BTC_ETH.html">BTC to ETH</a></li>--}}
{{--                        <li><a href="trading%EF%B9%96pair=BTC_ADA.html">BTC to ADA</a></li>--}}
{{--                        <li><a href="trading%EF%B9%96pair=BTC_ATOM.html">BTC to ATOM</a></li>--}}
{{--                        <li><a href="trading%EF%B9%96pair=ETH_LTC.html">ETH to LTC</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>

<div class="footer">
    <div class="container" style="max-width: 1024px;">
        <div class="row">
            <div>
                <div class="copyright">
                    <p style="font-size:12px" ;><strong>Bitrouse</strong> © Copyright 2022 | Worldwide Distributed
                        Digital Asset Exchange | Trading digitals assets such as Bitcoin involves significant risks.</p>


                </div>
            </div>

        </div>
    </div>
</div>
<!--footer end-->
<script src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/amcharts-core.min.js')}}"></script>
<script src="{{asset('assets/js/amcharts.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('plugins/notifications/toastr.js')}}"></script>
<script src="{{asset('assets/js/new-select/new-select.js')}}" ></script>
<script src="{{asset('assets/js/verifi/verifi.js')}}"></script>
<script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
@livewire('livewire-ui-modal')
@livewireScripts


@isset($script)
    {{$script}}
@endisset
<script>
    function noti(msg, status) {
        toastr[status](msg);
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "rtl": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 300,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }

    $("#copy_btc").on("click", function(e) {
        e.preventDefault();

        // Create a "hidden" input
        var aux = document.createElement("input");

        // Assign it the value of the specified element
        aux.setAttribute("value", document.getElementById("btc_add").value);

        // Append it to the body
        document.body.appendChild(aux);

        // Highlight its content
        aux.select();

        // Copy the highlighted text
        document.execCommand("copy");

        // Remove it from the body
        document.body.removeChild(aux);

        noti("BTC Address copied to bash clipboard", "success");

    });

    $("#copy_eth").on("click", function(e) {
        e.preventDefault();

        // Create a "hidden" input
        var aux = document.createElement("input");

        // Assign it the value of the specified element
        aux.setAttribute("value", document.getElementById("eth_add").value);

        // Append it to the body
        document.body.appendChild(aux);

        // Highlight its content
        aux.select();

        // Copy the highlighted text
        document.execCommand("copy");

        // Remove it from the body
        document.body.removeChild(aux);

        noti("ETH Address copied to bash clipboard", "success");

    });

    $("#copy_ltc").on("click", function(e) {
        e.preventDefault();

        // Create a "hidden" input
        var aux = document.createElement("input");

        // Assign it the value of the specified element
        aux.setAttribute("value", document.getElementById("ltc_add").value);

        // Append it to the body
        document.body.appendChild(aux);

        // Highlight its content
        aux.select();

        // Copy the highlighted text
        document.execCommand("copy");

        // Remove it from the body
        document.body.removeChild(aux);

        noti("LTC Address copied to bash clipboard", "success");

    });


</script>

<script>



//    function customToastShow(){
//        $('.toast').toast('show');
//
//        $('.toast').on('hidden.bs.toast', function () {
//            $('.toast').first().remove();
//        })
//
//    }
//
//    function toastMessage(message){
//
//        $('.toast_place').append(
//            '<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">'+
//               ' <div class="toast-body bg-success color-white" style="min-width: 278px;">'+
//                    message+
//              '  </div>'+
//           ' </div>'
//
//        );
//        // alert($('.toast')[0]);
//        customToastShow();
//    }

    function copyText(id,alertId) {
        /* Get the text field */
        var copyText = document.getElementById(id);

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);

        /* Alert the copied text */
        alert("Copied the text: " + copyText.value);
    }
</script>

</body>
</html>
