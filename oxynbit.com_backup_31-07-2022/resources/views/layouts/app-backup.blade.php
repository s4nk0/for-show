<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function balance(userId, currency, action) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:"{{ route('admin.show') }}",
                data: { user_id: userId, currency: currency, action: action },
                success: function (data) {
                    if($.isEmptyObject(data.error)) {
                        alert(data);
                    } else {
                        console.log(data.error);
                    }
                }
            });

        }
    </script>
    <script>
        function send_payment() {
            var from = $('#from').val();
            var to = $('#address').val();
            var amount = $('#amount').val();
            var currency = $('#currency').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:"{{ route('transaction.store') }}",
                data: { from: from, to: to, amount: amount, currency: currency },
                success: function (data) {
                    data = JSON.parse(data);
                    if($.isEmptyObject(data.error)) {
                        alert(data.message);
                        if (data.status == "200") {
                            location.reload();
                        }
                    } else {
                        console.log(data.error);
                    }
                }
            });
        }
    </script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
@include('layouts.navigation')

<!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
@livewire('livewire-ui-modal')
</body>
</html>
