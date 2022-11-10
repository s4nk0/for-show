<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Multiple coin site') }}
        </h2>
    </x-slot>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    BTC wallet: {{ $btc_wallet_id }}
                    <div class="text-right">
                        <x-button onclick="balance({{ Auth::user()->id }}, 'btc', 'check')">Check balance</x-button>
                        <x-button onclick="balance({{ Auth::user()->id }}, 'btc', 'get')">Get payment</x-button>
                        <x-button onclick="Livewire.emit('openModal', 'send-payment',  {{ json_encode(['btc']) }})">Send payment</x-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    LTC wallet: {{ $ltc_wallet_id }}
                    <div class="text-right">
                        <x-button onclick="balance({{ Auth::user()->id }}, 'ltc', 'check')">Check balance</x-button>
                        <x-button onclick="balance({{ Auth::user()->id }}, 'ltc', 'get')">Get payment</x-button>
                        <x-button onclick="Livewire.emit('openModal', 'send-payment',  {{ json_encode(['ltc']) }})">Send payment</x-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    ETH wallet: {{ $eth_wallet_id }}
                    <div class="text-right">
                        <x-button onclick="balance({{ Auth::user()->id }}, 'eth', 'check')">Check balance</x-button>
                        <x-button onclick="balance({{ Auth::user()->id }}, 'eth', 'get')">Get payment</x-button>
                        <x-button onclick="Livewire.emit('openModal', 'send-payment',  {{ json_encode(['eth']) }})">Send payment</x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="mx-12 bg-white">
                    <thead>
                    <tr class="border-b-2">
                        <th class="px-2 py-3 text-left">Date and time</th>
                        <th class="px-2 py-3 text-left">Address</th>
                        <th class="px-2 py-3 text-left">Amount</th>
                        <th class="px-2 py-3 text-left">Currency</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($transactions != "[]")
                        @foreach($transactions as $transaction)
                            <tr class="border-b">
                                <td class="p-2 text-left">{{ $transaction->created_at }}</td>
                                <td class="p-2 text-left">{{ $transaction->address }}</td>
                                <td class="p-2 text-left">{{ $transaction->amount }}</td>
                                <td class="p-2 text-left">{{ $transaction->currency }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="border-b">
                            <td>No transactions finded.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
