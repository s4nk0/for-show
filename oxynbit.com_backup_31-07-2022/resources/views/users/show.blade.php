<x-admin-layout>
    <?php
    //for optimize api responses
    $userMoney = $user->cryptoTomoney();

    ?>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="cord">
                <div class="cord-body">
                    <div class="card-title">
                        <a href="{{ route('users.index') }}" class="btn btn-inverse-primary btn-fw">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Profile Information
                    </h4>
{{--                    <p class="card-description"> Horizontal form layout </p>--}}
                    <form class="forms-sample">
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">User name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control bg-dark" id="exampleInputUsername2" placeholder="Username" value="{{ $user->user_name }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Photo</label>
                            <div class="col-sm-9">
                                <img src="{{$user->profile_photo_url}}" alt="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername5" class="col-sm-3 col-form-label">Email verified at</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control bg-dark" id="exampleInputUsername5" placeholder="Null" value="{{ $user->email_verified_at	 }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail3" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                @foreach ($user->roles as $role)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $role->title }}
                                                </span>
                                @endforeach
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Available balance</h4>
                    <h3><img src="{{asset('assets/img/icon/18.png')}}" style="width: 25px; margin-right: 15px; margin-top: -5px; display: inline;">{{$user->getCrypto('btc')}} BTC</h3>
                    <h3><img src="{{asset('assets/img/icon/1.png')}}" style="width: 25px; margin-right: 15px; margin-top: -5px; display: inline;">0 ETH</h3>
                    <h3><img src="{{asset('assets/img/icon/3.png')}}" style="width: 25px; margin-right: 15px; margin-top: -5px; display: inline;">{{$user->getCrypto('ltc')}} LTC</h3>
                </div>
                <div class="card-footer">
                    <p class="mb-1">Total Equity</p>
                    <h3> {{array_sum($userMoney) }} USD</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Wallets</h4>
                    <form class="forms-sample">
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label"><img src="{{asset('assets/img/icon/18.png')}}" style="width: 25px; margin-right: 15px; margin-top: -5px; display: inline;"> - {{ $userMoney['bitcoin'] }} $</label>
                            <div class="col-sm-9">
                                    <input type="text" class="form-control bg-dark" id="exampleInputUsername2" placeholder="wallet" value="{{ $user->btc_wallet_id }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label"><img src="{{asset('assets/img/icon/1.png')}}" style="width: 25px; margin-right: 15px; margin-top: -5px; display: inline;"> - {{ $userMoney['ethereum'] }} $</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control bg-dark" placeholder="wallet" value="{{ $user->eth_wallet_id }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername5" class="col-sm-3 col-form-label"><img src="{{asset('assets/img/icon/3.png')}}" style="width: 25px; margin-right: 15px; margin-top: -5px; display: inline;"> - {{ $userMoney['litecoin'] }} $</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control bg-dark" placeholder="wallet" value="{{ $user->ltc_wallet_id }}" readonly>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Crypto addresses</h4>
                        <form class="forms-sample">
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label"><img src="{{asset('assets/img/icon/18.png')}}" style="width: 25px; margin-right: 15px; margin-top: -5px; display: inline;"></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control bg-dark" id="exampleInputUsername2" placeholder="Null" value="{{ $user->btc_address }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label"><img src="{{asset('assets/img/icon/1.png')}}" style="width: 25px; margin-right: 15px; margin-top: -5px; display: inline;"></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control bg-dark" placeholder="Null" value="{{ $user->eth_address }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername5" class="col-sm-3 col-form-label"><img src="{{asset('assets/img/icon/3.png')}}" style="width: 25px; margin-right: 15px; margin-top: -5px; display: inline;"></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control bg-dark" placeholder="Null" value="{{ $user->ltc_address }}" readonly>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
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
                        <livewire:user.withdraw-from-btc-form :user="$user" />
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
                        <livewire:user.withdraw-from-litecoin-form :user="$user" />
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
        </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Transactions History</h4>
                    <div class="transaction-table">
                        <div class="table-responsive">
                            <x-user.transactions :user="$user"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Personal Information</h4>
                    <form class="form-sample">
                        {{--                        <p class="card-description"> Personal info </p>--}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control bg-dark" value="{{ $user->name }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control bg-dark" value="{{ $user->email }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date of birth</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control bg-dark" value="{{ $user->date_of_birth }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="card-description"> Address </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Present Address</label>
                                    <div class="col-sm-9">
                                        <input class="form-control bg-dark" value="{{ $user->present_address }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Permanent Address</label>
                                    <div class="col-sm-9">
                                        <input class="form-control bg-dark" value="{{ $user->permanent_address	 }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">City</label>
                                    <div class="col-sm-9">
                                        <input class="form-control bg-dark" value="{{ $user->city	 }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Postal Code</label>
                                    <div class="col-sm-9">
                                        <input class="form-control bg-dark" value="{{ $user->postal_code }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Country</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control bg-dark" value="{{ $user->country }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
