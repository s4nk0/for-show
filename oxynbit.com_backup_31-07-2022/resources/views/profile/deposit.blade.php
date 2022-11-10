<x-app-layout>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Wallet Deposit Address</h4>
            </div>

            <div class="card-body" id="deposits">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item nav-item-link">
                        <a class="nav-link active nav-item-icon-btc" data-toggle="tab" href="#tab1">Bitcoin</a>
                    </li>
                    <li class="nav-item nav-item-link">
                        <a class="nav-link nav-item-icon-eth" data-toggle="tab" href="#tab2">Ethereum</a>
                    </li>
                    <li class="nav-item nav-item-link">
                        <a class="nav-link nav-item-icon-ltc" data-toggle="tab" href="#tab3">Litecoin</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab1">
                        <div class="qrcode">
                            <img src="https://chart.googleapis.com/chart?chs=250x250&amp;cht=qr&amp;chl={{ Auth::user()->btc_address }}" alt="" width="150" class="d-inline">
                        </div>
                        <form action="">
                            <div class="input-group">
                                <input id="btc_add" type="text" class="form-control" value="{{ Auth::user()->btc_address }}">
                                <div class="input-group-append">
                                    <button id="copy_btc"  type="button" class="input-group-text bg-primary text-white" >Copy</button>
                                </div>
                            </div>
                        </form>

                        <ul>

                            <li>
                                <i class="mdi mdi-checkbox-blank-circle"></i>
                                Coins will be deposited after 3 network confirmations.
                            </li>
                            <li>
                                <i class="mdi mdi-checkbox-blank-circle"></i>
                                Send only BTC to this deposit address. Sending coin or token other than BTC to this address may result in the loss of your deposit.
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <div class="qrcode">
                            <img src="https://chart.googleapis.com/chart?chs=250x250&amp;cht=qr&amp;chl=0" alt="" width="150" class="d-inline">
                        </div>
                        <form action="">
                            <div class="input-group">
                                <input id="eth_add" type="text" class="form-control" value="0">
                                <div class="input-group-append">
                                    <button id="copy_eth" class="input-group-text bg-primary text-white">Copy</button>
                                </div>
                            </div>
                        </form>

                        <ul>
                            <li>
                                <i class="mdi mdi-checkbox-blank-circle"></i>
                                We accept only <strong>ERC-20</strong> network for deposit! Do not send tokens via BEP-20 network, in this case you will loss your deposit.
                            </li>
                            <li>
                                <i class="mdi mdi-checkbox-blank-circle"></i>
                                Coins will be deposited after 6 network confirmations.
                            </li>
                            <li>
                                <i class="mdi mdi-checkbox-blank-circle"></i>
                                Send only ETH to this deposit address. Sending coin or token other than ETH to this address may result in the loss of your deposit.

                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <div class="qrcode">
                            <img src="https://chart.googleapis.com/chart?chs=250x250&amp;cht=qr&amp;chl={{ Auth::user()->ltc_address }}}" alt="" width="150" class="d-inline">
                        </div>
                        <form action="">
                            <div class="input-group">
                                <input id="ltc_add" type="text" class="form-control" value="{{ Auth::user()->ltc_address }}">
                                <div class="input-group-append">
                                    <button id="copy_ltc" class="input-group-text bg-primary text-white">Copy</button>
                                </div>
                            </div>
                        </form>

                        <ul>

                            <li>
                                <i class="mdi mdi-checkbox-blank-circle"></i>
                                Coins will be deposited after 6 network confirmations.
                            </li>
                            <li>
                                <i class="mdi mdi-checkbox-blank-circle"></i>
                                Send only LTC to this deposit address. Sending coin or token other than LTC to this address may result in the loss of your deposit.
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </div>


</x-app-layout>

