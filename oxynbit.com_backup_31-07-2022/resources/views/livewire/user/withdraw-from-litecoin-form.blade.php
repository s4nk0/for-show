<span>
<form wire:submit.prevent="withdrawFromLitecoinForm" class="py-5 ltc_form" style="margin: 30px auto 10px;">
    @csrf
        <div class="form-group row align-items-center">
            <div class="col-sm-4">
                <label for="inputEmail3" class="col-form-label"><span style="color:#fff">Destination LTC address</span>
                    <br>
                    <small>Please double check this address</small>
                </label>
            </div>
            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <input id="btc_address" type="text" class="form-control text-left" placeholder="Please enter recipient's LTC address" wire:model="address">
                </div>
                 <x-jet-input-error for="address" class="mt-2" />
            </div>
        </div>
        <div class="form-group row align-items-center">
            <div class="col-sm-4">
                <label for="inputEmail3" class="col-form-label"><span style="color:#fff">Amount LTC</span>
                    <br>
                    <small>Maximum amount withdrawable: <span class="click_balance" id="btc_bal">0</span> LTC</small>
                </label>
            </div>
            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <x-jet-input id="amount"  type="number" step="any" class="form-control text-left" placeholder="Please enter an amount in LTC" wire:model="amount" autocomplete="amount"/>
                </div>
                <x-jet-input-error for="amount" class="mt-2" />
            </div>
        </div>
        <div class="form-group row align-items-center">
            <div class="col-sm-6">
                <label for="inputEmail3" class="col-form-label"><span style="color:#fff">Litecoin Network Fee</span>
                    <br>
                    <small>Transactions on the Bitcoin network are priorirized by
                        fees</small>
                </label>
            </div>
            <div class="col-sm-6">
                <h4 style="font-size: 1rem;" class="text-right">{{ \App\Models\Api::SERVICE_FEE_LTC }}  LTC</h4>
            </div>
        </div>
<div class="d-flex justify-content-end align-items-center">
       <x-jet-action-message class="mx-3" on="sent">
            {{ __('Sent successfully.') }}
        </x-jet-action-message>
           @if($errors->any() || $disabled_btn < 2)
        <button class="btn btn-primary " style="padding: 7px 15px 7px 15px;"  disabled>Withdraw Now</button>
        @else
            <livewire:withdraw-button/>
        @endif

</div>

</form>


</span>
