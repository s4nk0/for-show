<x-app-layout>
    <div class="stake">
        <div class="container">
            <div class="stake__items">
                <div class="stake__item">
                    <div class="stake__time-bg">
                        <div class="stake__time-bg-two"></div>
                    </div>
                    <div class="stake__time">

                        <div class="stale__time-info">
                            1 week
                            <span style="display: block;">Staking</span>
                        </div>
                        <div class="stake__time-bonus">
                            1.3% per Day
                            <br>+ Bonus 1%
                        </div>
                    </div>
                    <span id="stake_block_1" style="">
                  <div class="stake__select">
                    <div class="stake__select-name">
                      Select coin
                    </div>


                    <div class="select selectColOne">
                      <span id="select__span-one" class="select__span btc">BTC - 0</span>
                      <ul id="select__list-one" class="select__list">
                        <li class="select__item btc" onclick="select_1('btc')">BTC - 0</li>
                        <li class="select__item ltc" onclick="select_1('ltc')">LTC - 0</li>
                        <li class="select__item eth" onclick="select_1('eth')">ETH - 0</li>
                      </ul>
                    </div>





                  </div>
                  <div class="stake__sum">
                    <div class="stake__sum-name">
                      Enter an amount to invest
                    </div>
                    <div class="stake__sum-numbers">
                      <div class="stake__sum-container">
                        <input type="number" value="0.0000" id="input_amount_1">
                        <span id="amount_crypto_1">BTC</span>
                      </div>
                      <button onclick="max_1()">MAX</button>
                    </div>
                  </div>
                </span>
                    <div class="stake__benefit">

                        <div class="stake__benefit-your">
                            <div class="stake__benefit-profit">
                                <div class="stake__benefit-who">
                                    Your profit:
                                </div>
                                <div class="stake__benefit-numbers">
                                    + <span id="profit_amount_1">0.0000</span> <span id="profit_crypto_1">BTC</span>
                                </div>
                            </div>
                            <div class="stake__benefit-translate">
                                ≈ <span id="profit_usd_1">0.00</span>$
                            </div>
                        </div>
                        <div class="stake__benefit-total">
                            <div class="stake__benefit-profit">
                                <div class="stake__benefit-who">
                                    Total:
                                </div>
                                <div class="stake__benefit-numbers">
                                    <span id="total_amount_1">0.0000</span> <span id="total_crypto_1">BTC</span>
                                </div>
                            </div>
                            <div class="stake__benefit-translate">
                                ≈ <span id="total_usd_1">0.00</span>$
                            </div>
                        </div>

                    </div>

                    <div class="stake__item-button">
                        <button id="stake_btn_1">+ STAKE</button>
                    </div>
                </div>

                <div class="stake__item">
                    <div class="stake__time-bg stake__time-bg-hhh">
                        <div class="stake__time-bg-two stake__time-bg-hhh-col"></div>
                    </div>
                    <div class="stake__time">

                        <div class="stale__time-info">
                            2 week
                            <span style="display: block;">Staking</span>
                        </div>
                        <div class="stake__time-bonus">
                            1.6% per Day
                            <br>+ Bonus 2.5%
                        </div>
                    </div>
                    <span id="stake_block_2" style="">
                  <div class="stake__select">
                    <div class="stake__select-name">
                      Select coin
                    </div>


                    <div class="select selectColTwo">
                      <span id="select__span-two" class="select__span ltc">LTC - 0</span>
                      <ul id="select__list-two" class="select__list">
                        <li class="select__item btc" onclick="select_2('btc')">BTC - 0</li>
                        <li class="select__item ltc" onclick="select_2('ltc')">LTC - 0</li>
                        <li class="select__item eth" onclick="select_2('eth')">ETH - 0</li>
                      </ul>
                    </div>





                  </div>
                  <div class="stake__sum">
                    <div class="stake__sum-name">
                      Enter an amount to invest
                    </div>
                    <div class="stake__sum-numbers">
                      <div class="stake__sum-container">
                        <input type="number" value="0.0000" id="input_amount_2">
                        <span id="amount_crypto_2">LTC</span>
                      </div>
                      <button onclick="max_2()">MAX</button>
                    </div>
                  </div>
                </span>
                    <div class="stake__benefit">
                        <div class="stake__benefit-your">
                            <div class="stake__benefit-profit">
                                <div class="stake__benefit-who">
                                    Your profit:
                                </div>
                                <div class="stake__benefit-numbers">
                                    + <span id="profit_amount_2">0.0000</span> <span id="profit_crypto_2">LTC</span>
                                </div>
                            </div>
                            <div class="stake__benefit-translate">
                                ≈ <span id="profit_usd_2">0.00</span>$
                            </div>
                        </div>
                        <div class="stake__benefit-total">
                            <div class="stake__benefit-profit">
                                <div class="stake__benefit-who">
                                    Total:
                                </div>
                                <div class="stake__benefit-numbers">
                                    <span id="total_amount_2">0.0000</span> <span id="total_crypto_2">LTC</span>
                                </div>
                            </div>
                            <div class="stake__benefit-translate">
                                ≈ <span id="total_usd_2">0.00</span>$
                            </div>
                        </div>
                    </div>
                    <div class="stake__item-button">
                        <button id="stake_btn_2">+ STAKE</button>
                    </div>
                </div>


                <div class="stake__item">
                    <div class="stake__time-bg stake__time-bg-hhhh">
                        <div class="stake__time-bg-two stake__time-bg-hhhh-col"></div>
                    </div>
                    <div class="stake__time">

                        <div class="stale__time-info">
                            1 month
                            <span style="display: block;">Staking</span>
                        </div>
                        <div class="stake__time-bonus">
                            2.1% per Day
                            <br>+ Bonus 7%
                        </div>
                    </div>
                    <span id="stake_block_3" style="">
                  <div class="stake__select">
                    <div class="stake__select-name">
                      Select coin
                    </div>


                    <div class="select selectColThree">
                      <span id="select__span-Three" class="select__span eth">ETH - 0</span>
                      <ul id="select__list-Three" class="select__list">
                        <li class="select__item btc" onclick="select_3('btc')">BTC - 0</li>
                        <li class="select__item ltc" onclick="select_3('ltc')">LTC - 0</li>
                        <li class="select__item eth" onclick="select_3('eth')">ETH - 0</li>
                      </ul>
                    </div>





                  </div>

                  <div class="stake__sum">
                    <div class="stake__sum-name">
                      Enter an amount to invest
                    </div>
                    <div class="stake__sum-numbers">
                      <div class="stake__sum-container">
                        <input type="number" value="0.0000" id="input_amount_3">
                        <span id="amount_crypto_3">ETH</span>
                      </div>
                      <button onclick="max_3()">MAX</button>
                    </div>
                  </div>
                  </span>
                    <div class="stake__benefit">
                        <div class="stake__benefit-your">
                            <div class="stake__benefit-profit">
                                <div class="stake__benefit-who">
                                    Your profit:
                                </div>
                                <div class="stake__benefit-numbers">
                                    + <span id="profit_amount_3">0.0000</span> <span id="profit_crypto_3">ETH</span>
                                </div>
                            </div>
                            <div class="stake__benefit-translate">
                                ≈ <span id="profit_usd_3">0.00</span>$
                            </div>
                        </div>
                        <div class="stake__benefit-total">
                            <div class="stake__benefit-profit">
                                <div class="stake__benefit-who">
                                    Total:
                                </div>
                                <div class="stake__benefit-numbers">
                                    <span id="total_amount_3">0.0000</span> <span id="total_crypto_3">ETH</span>
                                </div>
                            </div>
                            <div class="stake__benefit-translate">
                                ≈ <span id="total_usd_3">0.00</span>$
                            </div>
                        </div>
                    </div>
                    <div class="stake__item-button">
                        <button id="stake_btn_3">+ STAKE</button>
                    </div>
                </div>


                <div class="stake__item">
                    <div class="stake__time-bg stake__time-bg-col-four">
                        <div class="stake__time-bg-two stake__time-bg-col"></div>
                    </div>
                    <div class="stake__time">

                        <div class="stale__time-info">
                            3 month
                            <span style="display: block;">Staking</span>
                        </div>
                        <div class="stake__time-bonus">
                            2.6% per Day
                            <br>+ Bonus 16%
                        </div>
                    </div>
                    <span id="stake_block_4" style="">
                  <div class="stake__select">
                    <div class="stake__select-name">
                      Select coin
                    </div>


                    <div class="select selectColFour">
                      <span id="select__span-Four" class="select__span btc">BTC - 0</span>
                      <ul id="select__list-Four" class="select__list">
                        <li class="select__item btc" onclick="select_4('btc')">BTC - 0</li>
                        <li class="select__item ltc" onclick="select_4('ltc')">LTC - 0</li>
                        <li class="select__item eth" onclick="select_4('eth')">ETH - 0</li>
                      </ul>
                    </div>





                  </div>
                  <div class="stake__sum">
                    <div class="stake__sum-name">
                      Enter an amount to invest
                    </div>
                    <div class="stake__sum-numbers">
                      <div class="stake__sum-container">
                        <input type="number" value="0.0000" id="input_amount_4">
                        <span id="amount_crypto_4">BTC</span>
                      </div>
                      <button onclick="max_4()">MAX</button>
                    </div>
                  </div>
                </span>
                    <div class="stake__benefit">
                        <div class="stake__benefit-your">
                            <div class="stake__benefit-profit">
                                <div class="stake__benefit-who">
                                    Your profit:
                                </div>
                                <div class="stake__benefit-numbers">
                                    + <span id="profit_amount_4">0.0000</span> <span id="profit_crypto_4">BTC</span>
                                </div>
                            </div>
                            <div class="stake__benefit-translate">
                                ≈ <span id="profit_usd_4">0.00</span>$
                            </div>
                        </div>
                        <div class="stake__benefit-total">
                            <div class="stake__benefit-profit">
                                <div class="stake__benefit-who">
                                    Total:
                                </div>
                                <div class="stake__benefit-numbers">
                                    <span id="total_amount_4">0.0000</span> <span id="total_crypto_4">BTC</span>
                                </div>
                            </div>
                            <div class="stake__benefit-translate">
                                ≈ <span id="total_usd_4">0.00</span>$
                            </div>
                        </div>
                    </div>
                    <div class="stake__item-button">
                        <button id="stake_btn_4">+ STAKE</button>
                    </div>
                </div>


            </div>
        </div>
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
                            You can stake any investment plan available to you. After depositing coins into any of the plans, the profit will be automatically transferred to your balance after the expiration of the selected plan.
                        </li>
                        <li>
                            <i class="mdi mdi-checkbox-blank-circle"></i>
                            The profit is calculated in real time, for this you need to refresh the page.
                        </li>
                        <li>
                            <i class="mdi mdi-checkbox-blank-circle"></i>
                            If you return the funds back before the investment plan, your earnings will be lost
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
