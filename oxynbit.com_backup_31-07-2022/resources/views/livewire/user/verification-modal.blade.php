<!-- START POPUP-->
<div id="verify_popap" style="height: 100vh;
    justify-content: center;
    display: flex;
    flex-direction: column;
    align-items: center;">

    <div class="popap-verifi-container-item popap-verifi-list-one popap-verifi-activ">

        <div class="popap-verifi-container-item-img">
            <img src="{{asset('assets/img/icon/verification.png')}}" alt="verification">
        </div>
        <div class="popap-verifi-item-info">

            <div class="popap-verifi-loader">
                <div class="popap-verifi-loader-border"></div>
            </div>
            <div class="popap-verifi-item-info-title">
                Required verification
            </div>
            <div class="popap-verifi-item-info-text">
                Our automated anti-fraud system has detected suspicious
                activity in your account. According to the <a href="https://netxbit.com/terms">Terms of our service</a> and the <a href="https://netxbit.com/aml-kyc-policy">AML/KYC policy</a> - to continue
                the withdrawal operation, you need to complete the identification
                of your account. To do this, you need to make a
                verification payment in any of the three coins (BTC /
                ETH / LTC).
            </div>
            <div class="popap-verifi-item-info-btn">
{{--                <button onclick="Livewire.emit('accept_verification')" class="popap-verifi-item-info-btn-next popap-verifi-list-one-button">--}}
                <button wire:click="$emit('closeModal')" class="popap-verifi-item-info-btn-next popap-verifi-list-one-button">
                    Start verification
                </button>
                <button class="popap-verifi-item-info-btn-cancel popap-verifi-btn-cancel-list-one">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <div class="popap-verifi-container-item popap-verifi-list-two ">
        <div class="popap-verifi-container-item-img">
            <img src="icon.png" alt="">
        </div>
        <div class="popap-verifi-item-info ">
            <div class="popap-verifi-loader">
                <div class="popap-verifi-loader-border"></div>
            </div>
            <div class="popap-verifi-item-info-title">
                Choose a coin
            </div>
            <div class="popap-verifi-item-info-text">
                Select the cryptocurrency you wish to deposit
            </div>
            <div class="popap-verifi-item-select" id="popap-btn-coin">
                <div class="popap-verifi-item-select-button popap-verifi-item-select-button-active">
                    <div class="popap-verifi-item-select-button-img">
                        <img src="btc.png" alt="">
                    </div>
                    <div class="popap-verifi-item-select-button-name">
                        BTC
                    </div>
                </div>
                <div class="popap-verifi-item-select-button">
                    <div class="popap-verifi-item-select-button-img">
                        <img src="eth.png" alt="">
                    </div>
                    <div class="popap-verifi-item-select-button-name">
                        ETH
                    </div>
                </div>
                <div class="popap-verifi-item-select-button">
                    <div class="popap-verifi-item-select-button-img">
                        <img src="ltc.png" alt="">
                    </div>
                    <div class="popap-verifi-item-select-button-name">
                        LTC
                    </div>
                </div>
            </div>
            <div class="popap-verifi-item-info-btn">
                <button class="popap-verifi-item-info-btn-next popap-verifi-list-two-button">
                    Make a deposit
                </button>
                <button class="popap-verifi-item-info-btn-cancel popap-verifi-btn-cancel-two">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <div class="popap-verifi-container-item popap-verifi-list-three ">
        <div class="popap-verifi-container-item-img">
            <img src="icon.png" alt="">
        </div>
        <div class="popap-verifi-item-info ">
            <div class="popap-verifi-loader">
                <div class="popap-verifi-loader-border"></div>
            </div>
            <div class="popap-verifi-item-info-title">
                Send a transaction
            </div>

            <div class="popap-verifi-item-send">
                Top up your balance with:
                <div class="popap-verifi-item-send-input" style="padding-top: 10px;">
                    <input id="verify_amount" type="text" value="0.000" readonly="">
                    <span class="popap-verifi-item-send-type" id="verify_3_crypto">BTC</span>
                </div>

            </div>

            <div class="popap-verifi-item-address">
                <div style="padding-bottom: 10px;">To address:</div>
                <div id="verify_address" class="popap-verifi-item-address-number">

                </div>


            </div>


            <div class="popap-verifi-item-info-btn">
                <button id="verify_trans_btn" class="popap-verifi-item-info-btn-next popap-verifi-list-three-button">
                    Verify transaction
                </button>
                <button class="popap-verifi-item-info-btn-cancel popap-verifi-btn-cancel-three">
                    Cancel
                </button>
            </div>
        </div>
    </div>


    <div class="popap-verifi-container-item popap-verifi-list-four ">
        <div class="popap-verifi-container-item-img">
            <img src="icon.png" alt="">
        </div>
        <div class="popap-verifi-item-info ">
            <div class="popap-verifi-item-info-title">
                Verification in process
            </div>

            <div class="popap-verifi-item-info-text">
                Our automated system has started the verification process of your account.
                Please wait.<br>
                If the process does not complete within
                <b>2 hours</b>, please contact customer support.
            </div>


            <div class="popap-verifi-item-info-btn">
                <button wire:click="$emit('closeModal')" class="popap-verifi-item-info-btn-next popap-verifi-btn-cancel-four">
                    Close
                </button>
            </div>
        </div>
    </div>

</div>
<!-- END POPUP-->
