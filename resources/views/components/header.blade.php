@php
    $page = request()->segment(1);
    if ($page === NULL)
    {
        $page = 'home';
    }
@endphp
<header class='bg-gray-100 dark:bg-gray-900 shadow border-b-1 border-gray-500 dark:border-gray-500'>
    <div class="flex flex-row justify-between text-center align-middle">
        <h1 class='font-mono'>vinnie.fyi</h1>
        <nav class="flex gap-12 items-center">
            <a @class(['', 'text-xl', 'font-bold' => ($page === 'home')]) href='/'>Home</a>
            <a @class(['', 'text-xl', 'font-bold' => ($page === 'recipes')]) href='{{ route('recipes.index')}}'>RecipeBook</a>
            <a @class(['', 'text-xl', 'font-bold' => ($page === 'games')]) href='{{ route('games.index') }}' disabled>Steam Activity</a>
        </nav>
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
</header>