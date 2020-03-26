<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .footer {
                margin-top:5em;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                /*text-align: center;*/
            }

            .title {
                text-align: center;
                font-size: 300%;
            }

            .weather-title {
                text-align: center;
                font-size: 300%;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content" id="osky-weather"></div>
        </div>
    </body>
    <script>
        var WEATHER_URL = "{{ url('/weather') }}";
    </script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ url('/js/skycons.js') }}"></script>
    <script>
        var skycons = new Skycons({"color": "pink"});
        // on Android, a nasty hack is needed: {"resizeClear": true}

        // you can add a canvas by it's ID...
        skycons.add("icon-weather", Skycons.PARTLY_CLOUDY_DAY);


        // if you're using the Forecast API, you can also supply
        // strings: "partly-cloudy-day" or "rain".

        // start animation!
        skycons.play();

        // you can also halt animation with skycons.pause()

        // want to change the icon? no problem:
        skycons.set("icon-weather", Skycons.PARTLY_CLOUDY_NIGHT);

        skycons.set("icon-weather", Skycons.CLEAR_DAY);
        skycons.set("icon-weather", Skycons.CLEAR_NIGHT);

    </script>
</html>
