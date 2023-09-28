<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WINRY | Wedding Invitation</title>
        <link rel="icon" href="/images/logo.png">
        <link ref="preload" href="https://wedding.winry5g.com/build/assets/image_w_1-92d94a33.JPG"></link>        
        <style>
            html, body {
                margin: 0;
                padding: 0;
            }

            .no-scroll {
                position: fixed;
                overflow-y: hidden;
            }
        </style>
        @vite('resources/css/app.css')
    </head>
    <body>
        <div id="app"></div>
        @vite('resources/js/app.js')
    </body>
</html>
