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
        <h1><a href='/'>Laravel Test Home Lab</a></h1>
        <nav>
            <a class='btn btn-primary' href='{{ route('bikes.index') }}'>Bikes</a>
            <a class='btn btn-primary' href='{{ route('recipes.index')}}'>Recipes</a>
            {{-- @if()
            @endif --}}
            @auth
                <span>Hello, {{ Auth::user()->name }}</span>
                <form action='{{ route('logout') }}' method='POST'>
                    @csrf
                    <button class='btn btn-primary' type='submit'>Logout</button>
                </form>
            @endauth
            @guest
                <a class='btn btn-primary' href='{{ route('show.login') }}'>Login</a>
                <a class='btn btn-primary' href='{{ route('show.register')}}'>Register</a>
            @endguest
        </nav>
    </header>
    <main class='container'>
        {{ $slot }}
    </main>
</body>
</html>