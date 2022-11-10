<x-modal>
    <x-slot name="title">
        Send payment
    </x-slot>

    <x-slot name="content">
        <p style="overflow-wrap: break-word;">Send from this address:<br />{{ $address_from }}</p>
        <x-input type="text" id="from" value="{{ $address_from }}" hidden></x-input>
        <x-input type="text" id="currency" value="{{ $out_currency }}" hidden></x-input>
        <x-input type="text" id="address" placeholder="Wallet address"></x-imput>
        <x-input type="text" id="amount" placeholder="Amount"></x-imput>
    </x-slot>

    <x-slot name="buttons">
        <x-button name="send" onclick="send_payment()">Send</x-button>
    </x-slot>
</x-modal>