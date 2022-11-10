<x-app-layout>

<div class="container-fluid mtb15 no-fluid">
    <div class="row sm-gutters">
        <div class="col-md-12 mb15">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js"
                        async>
                    {
                        "colorTheme": "dark"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
        <div class="col-md-9">
            <div class="row sm-gutters">
                <div class="col-md-4">
                    <div class="order-book mb15">
                        <h2 class="heading">Order Book</h2>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Price</th>
                                <th>BTC</th>
                                <th>USDT</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr id="red_tr_6" class="red-bg-80">
                                <td class="red">0.000000</td>
                                <td>0.000000</td>
                                <td>0.000000</td>
                            </tr>
                            <tr id="red_tr_5" class="red-bg-60">
                                <td class="red">0.000000</td>
                                <td>0.000000</td>
                                <td>0.000000</td>
                            </tr>
                            <tr id="red_tr_4" class="red-bg-40">
                                <td class="red">0.000000</td>
                                <td>0.000000</td>
                                <td>0.000000</td>
                            </tr>
                            <tr id="red_tr_3" class="red-bg-20">
                                <td class="red">0.000000</td>
                                <td>0.000000</td>
                                <td>0.000000</td>
                            </tr>
                            <tr id="red_tr_2" class="red-bg-10">
                                <td class="red">0.000000</td>
                                <td>0.000000</td>
                                <td>0.000000</td>
                            </tr>
                            <tr id="red_tr_1" class="red-bg-8">
                                <td class="red">0.000000</td>
                                <td>0.000000</td>
                                <td>0.000000</td>
                            </tr>
                            </tbody>
                            <tbody class="ob-heading">
                            <tr>
                                <td>
                                    <span>Price</span>
                                </td>
                                <td>
                                    <span>BTC</span>

                                </td>
                                <td class="red">
                                    <span>USDT</span>

                                </td>
                            </tr>
                            </tbody>
                            <tbody>
                            <tr id="green_tr_6" class="green-bg">
                                <td class="green">0.000000</td>
                                <td>0.000000</td>
                                <td>0.000000</td>
                            </tr>
                            <tr id="green_tr_5" class="green-bg-5">
                                <td class="green">0.000000</td>
                                <td>0.000000</td>
                                <td>0.000000</td>
                            </tr>
                            <tr id="green_tr_4" class="green-bg-8">
                                <td class="green">0.000000</td>
                                <td>0.000000</td>
                                <td>0.000000</td>
                            </tr>
                            <tr id="green_tr_3" class="green-bg-10">
                                <td class="green">0.000000</td>
                                <td>0.000000</td>
                                <td>0.000000</td>
                            </tr>
                            <tr id="green_tr_2" class="green-bg-20">
                                <td class="green">0.000000</td>
                                <td>0.000000</td>
                                <td>0.000000</td>
                            </tr>
                            <tr id="green_tr_1" class="green-bg-40">
                                <td class="green">0.000000</td>
                                <td>0.000000</td>
                                <td>0.000000</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="market-history">
                        <h2 class="heading">Recent trades</h2>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="recent-trades" role="tabpanel">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Price(USDT)</th>
                                        <th>Amount(BTC)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr id="recent_tr_8">
                                        <td>00:00:00</td>
                                        <td class="red">0.0000000</td>
                                        <td>0.0000000</td>
                                    </tr>
                                    <tr id="recent_tr_7">
                                        <td>00:00:00</td>
                                        <td class="green">0.0000000</td>
                                        <td>0.0000000</td>
                                    </tr>
                                    <tr id="recent_tr_6">
                                        <td>00:00:00</td>
                                        <td class="green">0.0000000</td>
                                        <td>0.0000000</td>
                                    </tr>
                                    <tr id="recent_tr_5">
                                        <td>00:00:00</td>
                                        <td class="red">0.0000000</td>
                                        <td>0.0000000</td>
                                    </tr>
                                    <tr id="recent_tr_4">
                                        <td>00:00:00</td>
                                        <td class="green">0.0000000</td>
                                        <td>0.0000000</td>
                                    </tr>
                                    <tr id="recent_tr_3">
                                        <td>00:00:00</td>
                                        <td class="green">0.0000000</td>
                                        <td>0.0000000</td>
                                    </tr>
                                    <tr id="recent_tr_2">
                                        <td>00:00:00</td>
                                        <td class="green">0.0000000</td>
                                        <td>0.0000000</td>
                                    </tr>
                                    <tr id="recent_tr_1">
                                        <td>00:00:00</td>
                                        <td class="red">0.0000000</td>
                                        <td>0.0000000</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="market-depth" role="tabpanel">
                                <div class="depth-chart-container">
                                    <div class="depth-chart-inner">
                                        <div id="darkDepthChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="main-chart mb15">
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                            <div id="tradingview_e8053"></div>
                            <script src="https://s3.tradingview.com/tv.js"></script>
                            <script>
                                new TradingView.widget(
                                    {
                                        "width": "100%",
                                        "height": 550,
                                        "symbol": "BTCUSDT",
                                        "interval": "D",
                                        "timezone": "Etc/UTC",
                                        "theme": "Dark",
                                        "style": "1",
                                        "locale": "en",
                                        "toolbar_bg": "#f1f3f6",
                                        "enable_publishing": false,
                                        "withdateranges": true,
                                        "hide_side_toolbar": false,
                                        "allow_symbol_change": true,
                                        "show_popup_button": true,
                                        "popup_width": "1000",
                                        "popup_height": "650",
                                        "container_id": "tradingview_e8053"
                                    }
                                );
                            </script>
                        </div>
                        <!-- TradingView Widget END -->
                    </div>
                    <div class="market-trade" >
                        <h2 class="heading">Place an order</h2>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-trade-limit" role="tabpanel">
                                <div class="d-flex justify-content-between">

                                    <div class="market-trade-buy">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="Price">
                                            <div class="input-group-append">
                                                <span class="input-group-text">USDT</span>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input class="form-control" placeholder="Amount" id="buy_amount">
                                            <div class="input-group-append">
                                                <span class="input-group-text">BTC</span>
                                            </div>
                                        </div>
                                        <ul class="market-trade-list">
                                            <li><a onclick="buy_perc(25)" href="#!">25%</a></li>
                                            <li><a onclick="buy_perc(50)" href="#!">50%</a></li>
                                            <li><a onclick="buy_perc(75)" href="#!">75%</a></li>
                                            <li><a onclick="buy_perc(100)" href="#!">100%</a></li>
                                        </ul>
                                        <p>Available: <span style="margin-left: 5px;">BTC</span> <span id="buy_available">0.0000000</span> </p>
                                        <p>Fee (0.3%): <span>0.0000000 BTC</span></p>
                                        <button class="btn buy" style="background: #1c2030;"> <a href="signin.html" style="color: #0199dd;">Log In</a> or <a href="signup.html" style="color: #0199dd;">Register Now</a></button>

                                    </div>
                                    <div class="market-trade-sell">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="Price">
                                            <div class="input-group-append">
                                                <span class="input-group-text">USDT</span>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input class="form-control" placeholder="Amount" id="sell_amount">
                                            <div class="input-group-append">
                                                <span class="input-group-text">BTC</span>
                                            </div>
                                        </div>
                                        <ul class="market-trade-list">
                                            <li><a onclick="sell_perc(25)" href="#!">25%</a></li>
                                            <li><a onclick="sell_perc(50)" href="#!">50%</a></li>
                                            <li><a onclick="sell_perc(75)" href="#!">75%</a></li>
                                            <li><a onclick="sell_perc(100)" href="#!">100%</a></li>
                                        </ul>
                                        <p>Available: <span style="margin-left: 5px;">BTC</span> <span id="buy_available">0.0000000</span></p>
                                        <p>Fee (0.3%): <span>0.0000000 BTC</span></p>
                                        <button class="btn sell" style="background: #1c2030;"> <a href="signin.html" style="color: #0199dd;">Log In</a> or <a href="signup.html" style="color: #0199dd;">Register Now</a></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="market-history market-order mt15">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#open-orders" role="tab" aria-selected="true">Open
                                    Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#stop-orders" role="tab" aria-selected="false">Closed
                                    Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#order-history" role="tab" aria-selected="false">Order
                                    history</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#trade-history" role="tab" aria-selected="false">Balance</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="open-orders" role="tabpanel">
                                <ul class="d-flex justify-content-between market-order-item">
                                    <li>Time</li>
                                    <li>All pairs</li>
                                    <li>All Types</li>
                                    <li>Buy/Sell</li>
                                    <li>Price</li>
                                    <li>Amount</li>
                                    <li>Executed</li>
                                    <li>Unexecuted</li>
                                </ul>
                                <span class="no-data" style="color: gainsboro; position: unset; display: block; margin-top: 105px;"><a href="signin.html" style="color: #0199dd;">Log In</a> or <a href="signup.html" style="color: #0199dd;">Register Now</a> to trade</span>
                            </div>
                            <div class="tab-pane fade" id="stop-orders" role="tabpanel">
                                <ul class="d-flex justify-content-between market-order-item">
                                    <li>Time</li>
                                    <li>All pairs</li>
                                    <li>All Types</li>
                                    <li>Buy/Sell</li>
                                    <li>Price</li>
                                    <li>Amount</li>
                                    <li>Executed</li>
                                    <li>Unexecuted</li>
                                </ul>
                                <span class="no-data" style="color: gainsboro; position: unset; display: block; margin-top: 105px;"><a href="signin.html" style="color: #0199dd;">Log In</a> or <a href="signup.html" style="color: #0199dd;">Register Now</a> to trade</span>
                            </div>
                            <div class="tab-pane fade" id="order-history" role="tabpanel">
                                <ul class="d-flex justify-content-between market-order-item">
                                    <li>Time</li>
                                    <li>All pairs</li>
                                    <li>All Types</li>
                                    <li>Buy/Sell</li>
                                    <li>Price</li>
                                    <li>Amount</li>
                                    <li>Executed</li>
                                    <li>Unexecuted</li>
                                </ul>
                                <span class="no-data" style="color: gainsboro; position: unset; display: block; margin-top: 105px;"><a href="signin.html" style="color: #0199dd;">Log In</a> or <a href="signup.html" style="color: #0199dd;">Register Now</a> to trade</span>
                            </div>
                            <div class="tab-pane fade" id="trade-history" role="tabpanel">
                                <ul class="d-flex justify-content-between market-order-item">
                                    <li>Time</li>
                                    <li>All pairs</li>
                                    <li>All Types</li>
                                    <li>Buy/Sell</li>
                                    <li>Price</li>
                                    <li>Amount</li>
                                    <li>Executed</li>
                                    <li>Unexecuted</li>
                                </ul>
                                <span class="no-data" style="color: gainsboro; position: unset; display: block; margin-top: 105px;"><a href="signin.html" style="color: #0199dd;">Log In</a> or <a href="signup.html" style="color: #0199dd;">Register Now</a> to trade</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-3">
            <div class="row sm-gutters">
                <div class="col-md-12">
                    <div class="market-pairs">

                        <ul class="nav nav-pills" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#BTC" role="tab" aria-selected="true">BTC</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#ETH" role="tab" aria-selected="false">ETH</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#LTC" role="tab" aria-selected="false">LTC</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#USDT" role="tab" aria-selected="false">USDT</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="BTC" role="tabpanel">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Pairs</th>
                                        <th>Last Price</th>
                                        <th>Change</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_ETH.html"> BTC/ETH</a></td>
                                        <td></td>
                                        <td class="red">-2.58%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_ADA.html"> BTC/ADA</a></td>
                                        <td></td>
                                        <td class="green">+5.6%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_ALGO.html"> BTC/ALGO</a></td>
                                        <td></td>
                                        <td class="red">-1.55%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_ATOM.html"> BTC/ATOM</a></td>
                                        <td></td>
                                        <td class="green">+1.8%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_BCH.html"> BTC/BCH</a></td>
                                        <td></td>
                                        <td class="red">-2.05%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_BTG.html"> BTC/BTG</a></td>
                                        <td></td>
                                        <td class="red">-1.05%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_CHZ.html"> BTC/CHZ</a></td>
                                        <td></td>
                                        <td class="green">+1.5%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_BNB.html"> BTC/BNB</a></td>
                                        <td></td>
                                        <td class="green">+5.6%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_LTC.html"> BTC/LTC</a></td>
                                        <td></td>
                                        <td class="red">-1.55%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_LINK.html"> BTC/LINK</a></td>
                                        <td></td>
                                        <td class="green">+1.8%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_DOGE.html"> BTC/DOGE</a></td>
                                        <td></td>
                                        <td class="red">-1.72%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_TRX.html"> BTC/TRX</a></td>
                                        <td></td>
                                        <td class="red">-1.47%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_WAVES.html"> BTC/WAVES</a></td>
                                        <td></td>
                                        <td class="green">+1.32%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_NEO.html"> BTC/NEO</a></td>
                                        <td></td>
                                        <td class="red">-1.25%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_XLM.html"> BTC/XLM</a></td>
                                        <td></td>
                                        <td class="green">+1.8%</td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade show" id="ETH" role="tabpanel">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Pairs</th>
                                        <th>Last Price</th>
                                        <th>Change</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=ETH_USD.html"> ETH/TRX</a></td>
                                        <td>0.00020255</td>
                                        <td class="green">+1.58%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=ETH_ADA.html"> ETH/ADA</a></td>
                                        <td>0.00020255</td>
                                        <td class="green">+1.58%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=ETH_LTC.html"> ETH/LTC</a></td>
                                        <td>0.00013192</td>
                                        <td class="red">-0.6%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=ETH_BCH.html"> ETH/BCH</a></td>
                                        <td>0.00002996</td>
                                        <td class="red">-0.55%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=ETH_EUR.html"> ETH/NEO</a></td>
                                        <td>0.00000103</td>
                                        <td class="green">+1.8%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=ETH_BTC.html"> ETH/XLM</a></td>
                                        <td>0.00000103</td>
                                        <td class="red">-2.05%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=ETH_XRP.html"> ETH/XRP</a></td>
                                        <td>0.00013192</td>
                                        <td class="red">-0.6%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=ETH_DOGE.html"> ETH/DOGE</a></td>
                                        <td>0.00001396</td>
                                        <td class="red">-0.55%</td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade show" id="LTC" role="tabpanel">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Pairs</th>
                                        <th>Last Price</th>
                                        <th>Change</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BNB_LTC.html"> LTC/BNB</a></td>
                                        <td>0.00350255</td>
                                        <td class="red">-6.58%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=ETH_LTC.html"> LTC/ETH</a></td>
                                        <td>0.00013192</td>
                                        <td class="green">+0.6%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BRL_LTC.html"> LTC/BRL</a></td>
                                        <td>0.00002996</td>
                                        <td class="red">-0.55%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=BTC_LTC.html"> LTC/BTC</a></td>
                                        <td>0.00000103</td>
                                        <td class="green">+1.8%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=GBP_LTC.html"> LTC/GBP</a></td>
                                        <td>0.006823</td>
                                        <td class="red">-0.05%</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade show" id="USDT" role="tabpanel">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Pairs</th>
                                        <th>Last Price</th>
                                        <th>Change</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=USDT_BTC.html"> USDT/BTC</a></td>
                                        <td>0</td>
                                        <td class="red">-2.58%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=USDT_LTC.html"> USDT/LTC</a></td>
                                        <td>0</td>
                                        <td class="green">+6.6%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=USDT_ETH.html"> USDT/ETH</a></td>
                                        <td>0</td>
                                        <td class="red">-0.55%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=USDT_XRP.html"> USDT/XRP</a></td>
                                        <td></td>
                                        <td class="green">+1.8%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=USDT_TRX.html"> USDT/TRX</a></td>
                                        <td></td>
                                        <td class="red">-2.05%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=USDT_EOS.html"> USDT/EOS</a></td>
                                        <td></td>
                                        <td class="red">-1.05%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=USDT_CAD.html"> USDT/CAD</a></td>
                                        <td>0.03520103</td>
                                        <td class="green">+1.5%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=USDT_AUD.html"> USDT/AUD</a></td>
                                        <td></td>
                                        <td class="red">-3.05%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=USDT_EUR.html"> USDT/EUR</a></td>
                                        <td></td>
                                        <td class="green">+2.05%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=USDT_DOT.html"> USDT/DOT</a></td>
                                        <td></td>
                                        <td class="green">+2.85%</td>
                                    </tr>
                                    <tr>
                                        <td><a style="color: #fff; font-weight: 400;" href="trading%EF%B9%96pair=USDT_LINK.html"> USDT/LINK</a></td>
                                        <td></td>
                                        <td class="green">+3.55%</td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="market-news mt15">
                        <h2 class="heading">Chat</h2>
                        <ul>

                        </ul>

                        <div class="form-row mb-2 ml-2 mr-2">

                            <span class="no-data col-md-12" style="color: gainsboro; position: unset; display: block; margin-top: 105px;"><a href="signin.html" style="color: #0199dd;">Log In</a> or <a href="signup.html" style="color: #0199dd;">Register Now</a> to trade</span>

                        </div>

                    </div>
                </div>
            </div>



        </div>
    </div>
</div>

<div id="sellbuy_warning" class="popap-container" style="display: none;position: fixed !important;">
    <div class="popap-container-item">
        <div class="popap-container-item-close" id="close_modal">

        </div>
        <div class="popap-container-img">
            <img src="assets/img/warning.svg" alt="">
        </div>
        <div class="popap-container-item-text-box" style="width: 340px;">
            <h3 class="popap-container-item-title">
                Warning
            </h3>
            <p class="popap-container-item-text" id="trading_message">

            </p>
            <div class="popap-container-item-btn" id="close_modal_btn">
                <span class="popap-container-item-button">
                    Close
                </span>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="pairs" value="BTCUSDT">

<div id="alert_message_modal" class="popap-container" style="display: none;">
    <div class="popap-container-item">
        <div class="popap-container-item-close" id="alert_close_modal">

        </div>
        <div class="popap-container-img">
            <img src="assets/img/warning.svg" alt="">
        </div>
        <div class="popap-container-item-text-box" style="width: 340px;">
            <h3 class="popap-container-item-title">
                Warning
            </h3>
            <p id="userAlertBox" class="popap-container-item-text">

            </p>
            <input type="hidden" id="alertMessageId" value="0">
            <div class="popap-container-item-btn" id="close_modal_btn">
                  <span id="alert_close_modal_btn" class="popap-container-item-button">
                      Close
                  </span>
            </div>
        </div>
    </div>
</div>

<style>.mCSB_container {
        overflow: unset !important;
    }

    .mCustomScrollbar  {
        overflow: unset !important;
    }
</style>


<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/amcharts-core.min.js"></script>
<script src="assets/js/amcharts.min.js"></script>
<script src="assets/js/jquery.mCustomScrollbar.js"></script>
<script src="assets/js/custom.js"></script>
<script src="plugins/notifications/toastr.js"></script>
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
</script>
<script>
    $('tbody, .market-news ul').mCustomScrollbar({
        theme: 'minimal',
    });
</script>

<script>

    $("#mCSB_9_container").load("ajax/ajax_chat?a=view");
    setTimeout(function() {
        var div = $("#mCSB_9");
        div.scrollTop(div.prop('scrollHeight'));
    }, 1000);


    setInterval(function() {
        $("#mCSB_9_container").load("ajax/ajax_chat?a=view");
    }, 10000);



    $("#btn_buy").on("click", function() {
        $("#trading_message").load("ajax/ajax?action=GET_TRADING_MESSAGE");
        $("#sellbuy_warning").css("display", "flex");
    });

    $("#btn_sell").on("click", function() {
        $("#trading_message").load("ajax/ajax?action=GET_TRADING_MESSAGE");
        $("#sellbuy_warning").css("display", "flex");
    });

    $("#close_modal").on("click", function() {
        $("#sellbuy_warning").css("display", "none");
    });

    $("#close_modal_btn").on("click", function() {
        $("#sellbuy_warning").css("display", "none");
    });

    $("#chat_send").on("click", function() {
        var chat_message = $("#chat_input").val();

        if(chat_message == "") {
            noti("Please enter text to send", "error");
        } else {
            $.ajax({
                url: "ajax/ajax_chat",
                type: "POST",
                data: {
                    action_post: "send",
                    msg: chat_message
                },
                success: function(response) {
                    if(response == '1') {
                        $("#mCSB_9_container").load("ajax/ajax_chat?a=view");
                        noti("Message sent", "success");
                        $('#chat_input').val("");
                        setTimeout(function() {
                            var div = $("#mCSB_9");
                            div.scrollTop(div.prop('scrollHeight'));
                        }, 1000);
                        var audio = new Audio();
                        audio.preload = 'auto';
                        audio.src = 'sounds/chat.mp3';
                        audio.play();
                    } else if(response == '2') {
                        noti("Please enter text to send", "error");
                    } else if(response == '3') {
                        noti("Last you wrote, wait a bit :)", "error");
                    } else if(response == '4') {
                        noti("You cannot chat, please contact support", "error");
                    } else {
                        var json = JSON.parse(response);
                        var json_chat = json['chat_error'];
                        noti(json_chat, "error");
                    }

                }
            })
        }
    });


    var pairs_value = $("#pairs").val();

    $.ajax({
        url: "../ajax/trading_live",
        type: "POST",
        data: {
            action: "TRADING_BTC_USDT",
            pairs: pairs_value
        },
        success: function(response) {
            var random_number = Math.floor((Math.random() * 10) + 4);
            var json = JSON.parse(response);

            var tr_block_id = 6; //start 6
            var new_tr_block_id = 7; // start 7

            var json_red_count = 1; //limit 1000
            var json_green_count = 10 //limit 1000

            setInterval(function() {

                function random_number() {
                    // Random Number Red
                    var random_number_2 = Math.floor((Math.random() * 7) + 1);
                    var random_true = '';
                    if(random_number_2 == 1) {
                        random_true = '-5';
                    } else if(random_number_2 == 2) {
                        random_true = '-8';
                    } else if(random_number_2 == 3) {
                        random_true = '-10';
                    } else if(random_number_2 == 4) {
                        random_true = '-20';
                    } else if(random_number_2 == 5) {
                        random_true = '-40';
                    } else if(random_number_2 == 6) {
                        random_true = '-60';
                    } else if(random_number_2 == 7) {
                        random_true = '-80';
                    } else {
                        random_true = '';
                    }

                    return random_true;
                }

                var two_price_red = parseFloat(json[json_red_count][0]) * parseFloat(json[json_red_count][1]);
                var two_price_green = parseFloat(json[json_green_count][0]) * parseFloat(json[json_green_count][1]);

                // red order book
                $("#mCSB_1_container").prepend('<tr id="red_tr_'+new_tr_block_id+'" class="red-bg'+random_number()+'"><td class="red">'+parseFloat(json[json_red_count][0])+'</td> <td>'+json[json_red_count][1]+'</td><td>'+two_price_red.toFixed(4)+'</td> </tr>');

                // green order book
                $("#mCSB_3_container").prepend('<tr id="green_tr_'+new_tr_block_id+'" class="green-bg'+random_number()+'"><td class="green">'+parseFloat(json[json_green_count][0])+'</td> <td>'+json[json_green_count][1]+'</td><td>'+two_price_green.toFixed(4)+'</td> </tr>');

                json_red_count = json_red_count + 1;
                json_green_count = json_green_count + 1;

                if(json_red_count > 50) {
                    json_red_count = 1;
                }

                if(json_green_count > 70) {
                    json_green_count = 10;
                }

                var remove_tr_id = new_tr_block_id - tr_block_id;
                $("#red_tr_" + remove_tr_id).remove();
                $("#green_tr_" + remove_tr_id).remove();
                new_tr_block_id = new_tr_block_id + 1;





            }, 250);


        }
    })


    //recent orders

    $.ajax({
        url: "../ajax/trading_live",
        type: "POST",
        data: {
            action: "TRADING_RECENT_LIVE",
            pairs: pairs_value
        },
        success: function(response) {

            var json_price = JSON.parse(response);
            var json_count = 1;
            var recent_tr_block_id = 8; //start 6
            var recent_new_tr_block_id = 9; // start 7


            setInterval(function() {


                var json_live_price = parseFloat(json_price[json_count][0]);
                var json_live_amount = parseFloat(json_price[json_count][1]);
                var json_live_amount_fix = json_live_amount.toFixed(7);
                var json_live_m = json_price[json_count][2];
                json_count = json_count + 1;

                if(json_count > 99) {
                    json_count = 1;
                }

                //now time
                var dt = new Date();
                var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

                var recent_number = Math.floor((Math.random() * 2) + 1);

                if(json_live_m == true) {
                    recent_status = 'green';
                } else {
                    recent_status = 'red';
                }


                // recent trade
                $("#mCSB_4_container").prepend('<tr id="recent_tr_'+recent_new_tr_block_id+'"> <td>'+time+'</td> <td class="'+recent_status+'">'+json_live_price+'</td> <td>'+json_live_amount_fix+'</td> </tr>');


                var remove_recent_id = recent_new_tr_block_id - recent_tr_block_id;
                $("#recent_tr_" + remove_recent_id).remove();
                recent_new_tr_block_id = recent_new_tr_block_id + 1;

            }, 250);



        }

    })


    setInterval(function() {
        var messageId = $("#alertMessageId").val();
        if(messageId == '0') {
            $.ajax({
                url: "ajax/ajax",
                type: "POST",
                data: {
                    action: "CHECK_USER_ALERT_MESSAGE"
                },
                success: function(response) {
                    if(response != "false") {

                        var json = JSON.parse(response);
                        var alert_message_text = json['alert_message_text'];
                        var alert_message_id = json['alert_message_id'];


                        $("#alert_message_modal").css("display", "flex");
                        $("#userAlertBox").html(alert_message_text);
                        $("#alertMessageId").val(alert_message_id);


                    }

                }
            })
        }
    }, 5000);


    $("#alert_close_modal").on("click", function() {
        $("#alert_message_modal").css("display", "none");
        var alertMessageId = $("#alertMessageId").val();

        $.ajax({
            url: "ajax/ajax",
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
            url: "ajax/ajax",
            type: "POST",
            data: {
                action: "VIEWED_ALERT_MESSAGE",
                message_id: alertMessageId
            },
            success: function(response) {

            }
        })
    });

    function preloaderFadeOutInit(){
        $('.preloader').fadeOut('slow');
        $('body').attr('class','');
    }
    // Window load function
    jQuery(window).on('load', function () {
        (function ($) {
            preloaderFadeOutInit();
        })(jQuery);
    });

    function buy_perc(perc) {
        var buy_available = $("#buy_available").html();

        var new_amount = parseFloat(buy_available) / 100 * parseFloat(perc);
        new_amount = new_amount.toFixed(6);

        $("#buy_amount").val(new_amount);
    }

    function sell_perc(perc) {
        var buy_available = $("#buy_available").html();

        var new_amount = parseFloat(buy_available) / 100 * parseFloat(perc);
        new_amount = new_amount.toFixed(6);

        $("#sell_amount").val(new_amount);
    }

</script>
</x-app-layout>
