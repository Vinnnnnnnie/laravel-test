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
        <div class="flex justify-between text-center align-middle">
        <h1>Laravel Test Home Lab</h1>
            @auth
                <div class="flex p-2 items-center">
                    <span class="font-bold text-lg mr-2 content-center">Hello, {{ Auth::user()->name }}</span>
                    <form action='{{ route('logout') }}' method='POST'>
                        @csrf
                        <button class='btn' type='submit'>Logout</button>
                    </form>
                </div>
            @endauth
            @guest
                <div class="flex p-2 items-center gap-2">
                    <a class='btn' href='{{ route('show.login') }}'>Login</a>
                    <a class='btn' href='{{ route('show.register')}}'>Register</a>
                </div>
            @endguest
        </div>
        <nav class="flex">
            <a class='btn' href='/'>Home</a>
            <a class='btn' href='{{ route('bikes.index') }}'>Bikes</a>
            <a class='btn' href='{{ route('recipes.index')}}'>Recipes</a>
        </nav>
    </header>
    <main class='container items-center mx-auto w-300'>
        {{ $slot }}
    </main>
</body>
</html>
