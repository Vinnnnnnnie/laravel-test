<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Vincent's Website</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <header>
            <div class="flex justify-between text-center align-middle">
            <h1>RecipeBook</h1>
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
                {{-- <a class='btn' href='{{ route('bikes.index') }}'>Bikes</a> --}}
                <a class='btn' href='{{ route('recipes.index')}}'>Recipes</a>
            </nav>
        </header>
        <main class='items-center mx-auto w-300'>
            <div class='flex justify-between mb-4 gap-8'>
                <div class='w-full'>
                    {{ $slot }}
                </div>
            </div>
        </main>
        <footer>
            <div class="flex justify-center gap-12 p-12 text-center align-middle text-gray-400">
                <div>
                    <h3><strong>Projects</strong></h3>
                    <ul>
                        <li>
                            <a href='https://vinnie.fyi' class='fs-bold'>Portfolio Website</a>
                        </li>
                        <li>
                            <a href='https://www.github.com/Vinnnnnnnie'>GitHub</a>
                        </li>
                        <li>
                            <a href='https://ldjam.com/users/vinnnie/'>Ludum Dare</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3><strong>Friends</strong></h3>
                    <ul>
                        <li>Mohammed Abdul</li>
                        <li>Jotaro Joestar</li>
                    </ul>
                </div>
                <div>
                    <h3><strong>Other Links</strong></h3>
                    <ul>
                        <a href='https://laravel.com/docs/12.x/installation'>Laravel Docs</a>
                    </ul>
                </div>
            </div>
        </footer>
    </body>
</html>
