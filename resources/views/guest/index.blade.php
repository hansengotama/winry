<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WINRY | Wedding Invitation</title>
        <link rel="icon" href="/images/logo.png">

        <style>
            :root {
                --app-height: 100%;
            }

            html, body {
                margin: 0;
                padding: 0;
            }
        </style>
        @vite('resources/css/app.css')
    </head>
    <body>
        <div id="app"></div>
        @vite('resources/js/app.js')

        <script>
            const appHeight = () => {
                const doc = document.documentElement
                doc.style.setProperty('--app-height', `${window.innerHeight}px`);
            }

            window.addEventListener('resize', appHeight)
            appHeight()
        </script>
    </body>
</html>
