
<x-app-layout>

    <div class="col-xl-12">
        <?php
        //for forms
        //$links=[
//            ['Firsticon and id','name'],
//            ['Secondicon','name'],
//            ['Thirdicon','Litecoin'],
//            ['ETCusd','USD'],
//            ['...','...'],
//        ];
        $links=[
            ['btc','Bitcoin'],
            ['eth','Ethereum'],
            ['ltc','Litecoin'],
            ['usd','USD'],
        ];
        ?>
        <x-from.swiched-forms :links="$links">

            <x-slot name="title">
                Withdraw
            </x-slot>

            <x-slot name="form_btc">
                <livewire:user.withdraw-from-btc-form/>
            </x-slot>

            <x-slot name="form_eth">
                <form action="#" class="py-5">

                    <div class="form-group row align-items-center">
                        <div class="col-sm-4">
                            <label for="inputEmail3" class="col-form-label"><span style="color:#fff">Destination ETH address</span>
                                <br>
                                <small>Please double check this address</small>
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group mb-3">

                                <input id="eth_address" type="text" class="form-control text-left" placeholder="Please enter recipient's ETH  address">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <div class="col-sm-4">
                            <label for="inputEmail3" class="col-form-label"><span style="color:#fff">Amount ETH </span>
                                <br>
                                <small>Maximum amount withdrawable: <span class="click_balance" id="eth_bal">0</span> ETH</small>
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group mb-3">

                                <input id="eth_amount" type="text" class="form-control text-left" placeholder="Please enter an amount in ETH">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <div class="col-sm-6">
                            <label for="inputEmail3" class="col-form-label"><span style="color:#fff">Ethereum Network Fee</span>
                                <br>
                                <small>Transactions on the Ethereum network are priorirized by
                                    fees</small>
                            </label>
                        </div>
                        <div class="col-sm-6">
                            <h4 style="font-size: 1rem;" class="text-right">0.00150068 ETH</h4>
                        </div>
                    </div>

                    <div class="text-right">
                        <button style="padding: 7px 15px 7px 15px;" onclick="withdraw('eth', event)" class="btn btn-primary"><i class="mdi mdi-forward">&nbsp;&nbsp;</i>Withdraw Now</button>
                    </div>
                </form>
            </x-slot>

            <x-slot name="form_ltc">
                <livewire:user.withdraw-from-litecoin-form/>
            </x-slot>
            <x-slot name="form_usd">
                <form action="#" class="py-5">

                    <div class="form-group row align-items-center">
                        <div class="col-sm-4">
                            <label for="inputEmail3" class="col-form-label">Select card
                                <br>
                                <small>Choose a debit card for transfer</small>
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group mb-3">

                                <select id="usd_card" style="display: none;">
                                    <option data-class="icon_master" value="master">MasterCard</option>
                                    <option data-class="icon_visa" value="visa">VISA</option>
                                    <option data-class="icon_maestro" value="maestro">Maestro</option>
                                </select><div class="nice-select" tabindex="0"><span class="current">MasterCard</span><ul class="list"><li data-value="master" class="option selected">MasterCard</li><li data-value="visa" class="option">VISA</li><li data-value="maestro" class="option">Maestro</li></ul></div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-sm-4">
                            <label for="inputEmail3" class="col-form-label"><span>Card Number</span>
                                <br>
                                <small>Please double check card number</small>
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group mb-3">

                                <input id="usd_number" type="text" class="form-control text-left" placeholder="#### **** **** ####">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <div class="col-sm-4">
                            <label for="inputEmail3" class="col-form-label"><span>Card holder</span>
                                <br>
                                <small>Please enter Name and Surname</small>
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group mb-3">

                                <input id="usd_name" type="text" class="form-control text-left" placeholder="Satoshi Nakomoto">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <div class="col-sm-4">
                            <label for="inputEmail3" class="col-form-label"><span>Expiration Date</span>
                                <br>
                                <small>Please select Month and Year</small>
                            </label>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">

                                <select id="usd_month" style="display: none;">
                                    <option data-class="icon_master" value="00">Month</option>
                                    <option data-class="icon_visa" value="01">01</option>
                                    <option data-class="icon_maestro" value="02">02</option>
                                    <option data-class="icon_maestro" value="03">03</option>
                                    <option data-class="icon_maestro" value="04">04</option>
                                    <option data-class="icon_maestro" value="05">05</option>
                                    <option data-class="icon_maestro" value="06">06</option>
                                    <option data-class="icon_maestro" value="07">07</option>
                                    <option data-class="icon_maestro" value="08">08</option>
                                    <option data-class="icon_maestro" value="09">09</option>
                                    <option data-class="icon_maestro" value="10">10</option>
                                    <option data-class="icon_maestro" value="11">11</option>
                                    <option data-class="icon_maestro" value="12">12</option>
                                </select><div class="nice-select" tabindex="0"><span class="current">Month</span><ul class="list"><li data-value="00" class="option selected">Month</li><li data-value="01" class="option">01</li><li data-value="02" class="option">02</li><li data-value="03" class="option">03</li><li data-value="04" class="option">04</li><li data-value="05" class="option">05</li><li data-value="06" class="option">06</li><li data-value="07" class="option">07</li><li data-value="08" class="option">08</li><li data-value="09" class="option">09</li><li data-value="10" class="option">10</li><li data-value="11" class="option">11</li><li data-value="12" class="option">12</li></ul></div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">

                                <select id="usd_year" style="display: none;">
                                    <option data-class="icon_master" value="0000">Year</option>
                                    <option data-class="icon_visa" value="2022">2022</option>
                                    <option data-class="icon_maestro" value="2023">2023</option>
                                    <option data-class="icon_maestro" value="2024">2024</option>
                                    <option data-class="icon_maestro" value="2025">2025</option>
                                    <option data-class="icon_maestro" value="2026">2026</option>
                                    <option data-class="icon_maestro" value="2027">2027</option>
                                    <option data-class="icon_maestro" value="2028">2028</option>
                                    <option data-class="icon_maestro" value="2029">2029</option>
                                    <option data-class="icon_maestro" value="2030">2030</option>
                                </select><div class="nice-select" tabindex="0"><span class="current">Year</span><ul class="list"><li data-value="0000" class="option selected">Year</li><li data-value="2022" class="option">2022</li><li data-value="2023" class="option">2023</li><li data-value="2024" class="option">2024</li><li data-value="2025" class="option">2025</li><li data-value="2026" class="option">2026</li><li data-value="2027" class="option">2027</li><li data-value="2028" class="option">2028</li><li data-value="2029" class="option">2029</li><li data-value="2030" class="option">2030</li></ul></div>

                            </div>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <div class="col-sm-4">
                            <label for="inputEmail3" class="col-form-label"><span>Enter amount</span>
                                <br>
                                <small>Select currency and enter amount</small>
                            </label>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">

                                <select id="usd_currency" style="display: none;">
                                    <option data-class="icon_master" value="btc">Bitcoin - 0 BTC</option>
                                    <option data-class="icon_visa" value="eth">Ethereum - 0 ETH</option>
                                    <option data-class="icon_maestro" value="ltc">Litecoin - 0 LTC</option>
                                </select><div class="nice-select" tabindex="0"><span class="current">Bitcoin - 0 BTC</span><ul class="list"><li data-value="btc" class="option selected">Bitcoin - 0 BTC</li><li data-value="eth" class="option">Ethereum - 0 ETH</li><li data-value="ltc" class="option">Litecoin - 0 LTC</li></ul></div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">

                                <input id="usd_amount" type="text" class="form-control text-left" placeholder="0.000000">
                                <span id="usd_amount_dollar" style="position: absolute; margin-top: 47px; color: #1a4e2a; background: #7bf996; padding: 6px; border-radius: 5px; right: 2px; font-weight: 600;">$0.00</span>
                            </div>
                        </div>
                    </div>
                    <br><br>

                    <div class="text-right">
                        <button style="padding: 7px 15px 7px 15px;" onclick="withdrawUsd(event)" class="btn btn-primary"><i class="mdi mdi-forward">&nbsp;&nbsp;</i>Withdraw to Card</button>
                    </div>
                </form>
            </x-slot>


        </x-from.swiched-forms>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Important Information</h4>
            </div>
            <div class="card-body">
                <div class="important-info">
                    <ul>
                        <li>
                            <i class="mdi mdi-checkbox-blank-circle"></i>
                            We strongly recommend that you copy &amp; paste the address to help avoid errors. Please note that we are not responsible for coins mistakenly sent to the wrong address.
                        </li>
                        <li>
                            <i class="mdi mdi-checkbox-blank-circle"></i>
                            Transactions normally take about 30 to 60 minutes to send, on occasion it can take a few hours if the crypto network is slow.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script>
            // Livewire.on('accept_verification', function(){
            //     // $("."+$( ".nav-tabs .active" ).data('value')+"_form").submit();
            //     $(".withdraw_btn").trigger("click");
            // })
        </script>
    </x-slot>

</x-app-layout>
