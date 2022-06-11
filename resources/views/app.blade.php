<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('/js/app.js') }}" defer></script>
        @inertiaHead
    </head>

    <body class="bg-light">
        <div class="d-flex justify-content-end"><input id="input" type="text"><div id="result"></div></div>
        <script>
            let input = document.getElementById('input');
            let result = document.getElementById('result');
            input.oninput = function (e) {
                result.innerText = input.value;
            }
        </script>
        @inertia

        @if (app()->isLocal())
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js" async></script>
        @endif
    </body>
</html>
