<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Test</title>
    @vite('resources/css/app.css')
</head>
<body>
    <header>
        <nav>
            <h1>Laravel Test</h1>
            <a class='btn btn-primary' href='/bikes'>Bikes</a>
            <a class='btn btn-primary' href='/recipes'>Recipes</a>
        </nav>
    </header>
    <main class='container'>
        {{ $slot }}
    </main>
</body>
</html>