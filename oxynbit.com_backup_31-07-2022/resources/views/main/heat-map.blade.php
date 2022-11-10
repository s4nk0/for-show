<x-app-layout>
<div class="col-md-12">
    <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container">
        <div class="tradingview-widget-container__widget"></div>
        <script type="text/javascript"
                src="https://s3.tradingview.com/external-embedding/embed-widget-forex-heat-map.js" async>
            {
                "width": "100%",
                "height": 900,
                "currencies": [
                "EUR",
                "USD",
                "JPY",
                "GBP",
                "CHF",
                "AUD",
                "CAD",
                "NZD",
                "SEK",
                "NOK",
                "DKK",
                "HKD"
            ],
                "isTransparent": false,
                "colorTheme": "dark",
                "locale": "en"
            }
        </script>
    </div>
    <!-- TradingView Widget END -->
</div>
</x-app-layout>
