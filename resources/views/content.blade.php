<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>WeatherMate</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    </head>
    <body>
        <div id="app">
            <navbar></navbar>   
            @if($errors->first())
            <div class="banner">NO RESULT FOUND</div>
            @else
            <current :weather="{{ json_encode($weather,1) }}"></current>
            <div class="forecast row">
                <div class="container">
                @foreach($forecast['list'] as $item)
                <forecast :forecast="{{ json_encode($item) }}"></forecast>
                @endforeach
                </div>
            </div> 
            <div class="footer container">
                <div class="footer-copyright">
                    <span>
                        © 2019 WeatherMate, Inc. All Rights Reserved.
                    </span>
                </div>
                <div id="footer-terms" class="footer-terms">
                    <a href="/#">
                        Terms of Use
                    </a>
                    |
                    <a href="/#">
                        Privacy Policy
                    </a>
                    |
                    <a href="/#">
                        Cookie Policy
                    </a>
                    |
                    <a  href="/#">
                        TAG Disclosure
                    </a>
                </div>
            </div>
            @endif
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
