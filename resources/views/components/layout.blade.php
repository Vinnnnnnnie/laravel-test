<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>vinnie.fyi</title>
    @vite('resources/css/app.css')
</head>
<body class='bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 font-sans'>
    <header class='bg-gray-100 dark:bg-gray-900 shadow mb-6 border-b-1 border-gray-900 dark:border-gray-100'>
        <div class="flex flex-row justify-between text-center align-middle">
            <h1 class='font-mono'>vinnie.fyi</h1>
            <nav class="flex gap-12 items-center">
                <a class='font-semibold text-xl' href='/'>Home</a>
                {{-- <a class='btn' href='{{ route('bikes.index') }}'>Bikes</a> --}}
                <a class='font-semibold text-xl' href='{{ route('recipes.index')}}'>RecipeBook</a>
                <a class='font-semibold text-xl' href=''>Steam Activity</a>
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
    <main class='items-center mx-40'>
        <div class='flex justify-between mb-4 gap-8'>
            {{-- User info --}}
            @auth
                <div class='flex-grow-1 sticky top-4 h-fit flex flex-col gap-4'>
                    <div class='bg-gray-100 dark:bg-gray-900 flex items-center gap-4 p-4 border-l-4 border-blue-500'>
                        @if(auth()->user()->image_path)
                        <img src='{{ route('image.users', auth()->user()->image_path)}}' class='w-20 max-w-20'>
                        @endif
                        <div>
                            <h2 class='text-xl font-bold'><a href={{ route('users.show', auth()->user()->id) }}>{{ auth()->user()->name }}</a></h2>
                            <p>{{ auth()->user()->email }}</p>
                            <p>{{ count(auth()->user()->recipe) }} @if (count(auth()->user()->recipe) > 1)Recipes @else Recipe @endif</p>
                        </div>
                    </div>
                    <div class='bg-gray-100 dark:bg-gray-900 flex items-center gap-4 p-4'>
                        <div class='flex flex-col'>
                            <h2 class='text-xl font-bold'>Settings</h2>
                            <a href='' class='p-4 hover:bg-gray-200 dark:hover:bg-gray-800 flex-row flex items-center gap-4 w-100'>{{ svg('bi-gear-fill') }} General</a>
                            <a href=''  class='p-4 hover:bg-gray-200 dark:hover:bg-gray-800 flex-row flex items-center gap-4 w-100'>{{ svg('bi-lock-fill') }} Security and Login</a>
                            <a  href='' class='p-4 hover:bg-gray-200 dark:hover:bg-gray-800 flex-row flex items-center gap-4 w-100'>{{ svg('bi-globe') }} Language and Region</a>
                            <a href=''  class='p-4 hover:bg-gray-200 dark:hover:bg-gray-800 flex-row flex items-center gap-4 w-100'><x-bi-shield-fill></x-bi-shield-fill> Blocking</a>
                        </div>
                    </div>
                </div>
            @endauth
            <div class=' flex-grow-2'>
                <ul>
                    @if(session('success'))
                        <div class='bg-green-200 text-green-800 p-2 rounded mb-4 bold'>
                            {{ session('success') }}
                        </div>
                    @endif
                </ul>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class='px-4 py-2 bg-red-200 rounded-lg mb-2'>
                            @foreach ($errors->all() as $error)
                                <li class='text-red-500'>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @auth
                    {{-- Recipe Search --}}
                    <div class='w-full mb-2'>
                        <h2>Find Recipes</h2>
                        <form action='{{ route('recipes.search') }}' method='get' class='flex gap-2 card'>
                            @csrf
                            <input type='text' id='term' name='term' placeholder='Search Recipes...' class='w-full' value={{ old('term') }}>
                            <input type='submit' name='submit' class='btn' value='Go'>
                        </form>
                    </div>
                @endauth    
                {{ $slot }}
            </div>
            {{-- Friends List --}}
            @auth
                <div class=' flex-grow-1 sticky top-4 border-l-4 border-yellow-500 h-fit p-4 bg-gray-100 dark:bg-gray-900'>
                    <ul>
                        <li><h2>Followed</h2></li>
                        @session('friendslist')
                            @if(count($value) > 0)
                                @foreach($value as $friend)
                                <li>
                                    <a class="btn flex gap-2 items-center m-2" href="{{ route('users.show', $friend->friend_user_id) }}">
                                        <img src='{{ route('image.users', $friend->image_path) }}' class='w-10 max-w-10'>
                                        <strong>{{ $friend->name }}</strong>
                                    </a>
                                </li>
                                @endforeach
                            @else
                                <li>
                                    You're not following anyone yet
                                </li>
                            @endif
                        @endsession
                    </ul>
                </div>
            @endauth
        </div>
    </main>
    <footer class='bg-gray-100 border-gray-900 dark:bg-gray-900 border-t-1 dark:border-gray-100'>
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
                    <li>
                        <a href='https://www.linkedin.com/in/vincent-owens-653685264/'>LinkedIn</a>
                    </li>
                </ul>
            </div>
            <div>
                <h3><strong>Friends</strong></h3>
                <ul>
                    <li>Mohammed Abdul</li>
                    <li>Jotaro Joestar</li>
                    <li>Testing</li>
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
