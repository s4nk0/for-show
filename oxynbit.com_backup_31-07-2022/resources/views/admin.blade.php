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
        <table class="mx-12 bg-white">
            <thead>
                <tr class="border-b-2">
                    <th class="px-2 py-3 text-left">Username</th>
                    <th class="px-2 py-3 text-left">Email</th>
                    <th class="px-2 py-3 text-left">BTC</th>
                    <th class="px-2 py-3 text-left">LTC</th>
                    <th class="px-2 py-3 text-left">ETH</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                        <tr class="border-b">
                            <td class="p-2 text-left">{{ $user->name }}</td>
                            <td class="p-2 text-left">{{ $user->email }}</td>
                            <td class="p-2 text-left" style="overflow-wrap: break-word;">{{ $user->btc_wallet_id }}<x-button onclick="balance({{ $user->id }}, 'btc', 'check' )">Check balance</x-button></td>
                            <td class="p-2 text-left" style="overflow-wrap: break-word;">{{ $user->ltc_wallet_id }}<x-button onclick="balance({{ $user->id }}, 'ltc', 'check' )">Check balance</x-button></td>
                            <td class="p-2 text-left" style="overflow-wrap: break-word;">{{ $user->eth_wallet_id }}<x-button onclick="balance({{ $user->id }}, 'eth', 'check')">Check balance</x-button></td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
