{{--при рабочем варианте подтянуть в </x-from.swiched-forms>--}}

<x-app-layout>
<div class="col-xl-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Transfer</h4>
        </div>

        <div class="card-body" id="deposits">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item nav-item-link">
                    <a class="nav-link active" data-toggle="tab" href="#tab1" style="padding-left: 15px;">New Transfer</a>
                </li>
                <li class="nav-item nav-item-link">
                    <a class="nav-link" data-toggle="tab" href="#tab2" style="padding-left: 15px;">History</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab1">
                    <div class="row justify-content-center">
                        <div class="col-xl-9">
                                                <span style="margin-top: 35px; display: block; margin-left: 38px; width: 203px; background: #020202; padding-left: 8px; border-radius: 5px; padding-top: 4px;">
                                                    <p>Your Transfer ID: <strong>144076756</strong></p>
                                                </span>
                            <form action="#" class="py-5">



                                <div class="form-group row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">Select currency
                                            <br>
                                            <small>Choose a cryptocurrency for transfer</small>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="input-group mb-3">

                                            <select id="transfer_currency_list" style="display: none;">

                                                <option data-class="icon_master" value="btc">Bitcoin - 0 BTC</option>
                                                <option data-class="icon_visa" value="eth">Ethereum - 0 ETH</option>
                                                <option data-class="icon_maestro" value="ltc">Litecoin - 0 LTC</option>


                                            </select><div class="nice-select" tabindex="0"><span class="current">Bitcoin - 0 BTC</span><ul class="list"><li data-value="btc" class="option selected">Bitcoin - 0 BTC</li><li data-value="eth" class="option">Ethereum - 0 ETH</li><li data-value="ltc" class="option">Litecoin - 0 LTC</li></ul></div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">User E-Mail
                                            <br>
                                            <small>Enter the user's E-Mail or Transfer ID for this site</small>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="input-group mb-3">

                                            <input id="transfer_email" type="text" class="form-control text-left" placeholder="Please enter user E-Mail or ID">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">Amount
                                            <br>
                                            <small>Enter correctly amount</small>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="input-group mb-3">

                                            <input id="transfer_amount" type="text" class="form-control text-left" placeholder="Please enter an amount">
                                        </div>
                                    </div>
                                </div>


                                <div class="text-right">
                                    <button onclick="transfer(event)" class="btn btn-primary">Transfer Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2">

                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Transfer ID</th>
                                <th>Time</th>
                                <th>User E-Mail</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr><td></td><td></td><td>No data transactions</td><td></td><td></td><td></td></tr>                                            </tbody>
                        </table>
                    </div>

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
                            Transfer funds to users of this site WITHOUT COMMISSION
                        </li>
                        <li>
                            <i class="mdi mdi-checkbox-blank-circle"></i>
                            Transfers normally take about 1 to 60 minutes to send, on occasion it can take a few hours if the crypto network is slow.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
