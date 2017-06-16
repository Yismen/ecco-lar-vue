<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dainsys</title>
    </head>
    <body>
        <style>
            .header {
                color: #cd4236;
                /*text-align: center;
                display: block;
                padding: 10px;
                background-color: #535345;*/
                font-family: 'Source Sans Pro',sans-serif;
            }
        </style>
        <div class="header">
            <h3>
                @hasSection('title')
                    @yield('title')
                @else
                    Place the title here
                @endif
            </h3>  
        </div>

        <div class="sub-title">
            <h4>
                @hasSection('subtitle')
                    @yield('subtitle')
                @else
                    Small subtitle here
                @endif
            </h4>
        </div>

        <div class="content">
            @hasSection('content')
                @yield('content')
            @else
                Display full body here
            @endif 
        </div>
    </body>
</html>




