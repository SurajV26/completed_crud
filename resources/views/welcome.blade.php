<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body, html {
                height: 100%;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
            }
    
            .centered-heading {
                text-align: center;
                font-weight: bold;
            }
        </style>

    </head>
    <body>
        <h1 class="centered-heading"> 
            <a href="{{ route('employee.index') }}" class="btn btn-success"> <span style="font-weight:bold;">Click Me</span> </a> 
        </h1>     
    </body>
</html>
