<x-app-layout>
                @if (\Illuminate\Support\Facades\Auth::user()->two_factor_confirmed_at == null)
                <div class="col-xl-12 col-md-12">
                    <div class="card" style="background: #2e0c6b;">
                        <div class="card-body" style=" background: rgb(36,44,82);
background: linear-gradient(90deg, rgba(36,44,82,1) 0%, rgba(47,36,82,1) 100%); ">

                            <div class="form-row">
                                <div class="form-group col-xl-12">
                                    <p></p><h3 id="block_2fa_activate">Attention!</h3> Your account is not secure enough, please enable two-factor authentication<p></p>
                                    <img src="{{asset('assets/img/key.png')}}" style="position: absolute; margin-top: -59px; width: 85px; right: 30px;">
                                </div>

                                <div class="col-12">
                                    <a href="{{route('profile.show')}}#two_factor" class="btn btn-primary waves-effect px-4">Enable</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endif
                <style>
                    #block_2fa_activate {
                        animation: blinker 1s linear infinite;
                    }

                    @keyframes blinker {
                        50% {
                            opacity: 0.2;
                        }
                    }
                </style>

                <div id="security_2fa" class="popap-container" style="display: none;">
                    <div class="popap-container-item">
                        <div class="popap-container-item-close" id="close_modal">

                        </div>
                        <div class="popap-container-img">
                            <img src="{{asset('assets/img/warning.svg')}}" alt="">
                        </div>
                        <div class="popap-container-item-text-box">
                            <h3 class="popap-container-item-title" style="text-align: center;">
                                Enable two-factor authorization
                            </h3>
                            <p class="popap-container-item-text" id="trading_message" style="text-align: center;">
                                Send your code - <strong>144076756</strong> to our bot:
                                <br><a href="https://t.me/crypto_2fa_notif_bot" target="_blank">http://t.me/crypto_2fa_notif_bot</a>
                            </p>
                            <div class="popap-container-item-btn" id="close_modal_btn">
				                <span class="popap-container-item-button">
				                    Close
				                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="card profile_card">
                        <div class="card-body">
                            <div class="media">
                                <x-user.profile-photo class="mr-3 rounded-circle mr-0 mr-sm-3"/>
                                <div class="media-body">
                                    <span>Hello</span>
                                    <h4 class="mb-2">{{ Auth::user()->name }}</h4>
                                    <p class="mb-1"> <span><i class="fa fa-envelope mr-2 text-primary"></i></span>
                                        {{ Auth::user()->email }}								</p>
                                </div>
                            </div>

                            <ul class="card-profile__info">
                                <li class="mb-1">
                                    <h5 class="mr-4">Total Log:</h5>
                                    <span>1 Time (Today 1 Times)</span>
                                </li>

                            </ul>


                        </div>
                    </div>
                    <div style="position: relative;width: 100%;padding-right: 0px;padding-left: 0px;background: black;border-radius: 5px !important;">
                        <div class="card">
                            <div class="card-body" style="background: rgb(36,44,82);
background: linear-gradient(90deg, rgba(36,44,82,1) 0%, rgba(47,36,82,1) 100%); border-radius: 5px;">
                                <div class="row justify-content-between" style="padding: 7px 15px 7px 15px;">

                                    <div style="width: 100%;">
                                        <h5 style="padding-bottom: 5px;">Use bonus promo code</h5>
                                        <form action="#">
                                            <div class="input-group">
                                                <input id="promocode" type="text" class="form-control" placeholder="Enter promo-code">

                                                <button id="activate_promo" class="btn btn-primary">Activate</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="card acc_balance">
                        <div class="card-header">
                            <h4 class="card-title">Available balance</h4>
                        </div>
                        <div class="card-body">

                            <h3><img src="{{asset('assets/img/icon/18.png')}}" style="width: 25px; margin-right: 15px; margin-top: -5px; display: inline;">{{Auth::user()->getCrypto('btc')}} BTC</h3>
                            <h3><img src="{{asset('assets/img/icon/1.png')}}" style="width: 25px; margin-right: 15px; margin-top: -5px; display: inline;">0 ETH</h3>
                            <h3><img src="{{asset('assets/img/icon/3.png')}}" style="width: 25px; margin-right: 15px; margin-top: -5px; display: inline;">{{Auth::user()->getCrypto('ltc')}} LTC</h3>

                            <div class="d-flex justify-content-between my-3">
                                <div>
                                    <p class="mb-1">Total Equity</p>
                                    <h3>{{ array_sum(Auth::user()->cryptoTomoney()) }}   USD</h3>
                                </div>

                            </div>



                            <div class="btn-group mb-3">
                                <a id="deposit_btn" class="btn btn-success" href="{{ route('user.deposit') }}">Deposit</a>
                                <button id="withdraw_btn" class="btn btn-danger">Withdraw</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Transactions History</h4>
                        </div>
                        <div class="card-body">
                            <div class="transaction-table">
                                <div class="table-responsive">
                                    <x-user.transactions :user="Auth::user()"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

</x-app-layout>
