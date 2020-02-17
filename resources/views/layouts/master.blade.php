<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>My App</title>
</head>
<body>

    <div id="app">
        @include ('layouts.header')
        
        <section class="section">

            <div class="container">

                <router-view></router-view>

            </div>

        </section>   

    </div>

    <script src="{{ mix('/js/app.js')}}"></script>
</body>
</html>