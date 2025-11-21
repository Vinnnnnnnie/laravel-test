<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RecipeBook</title>
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
            {{-- User info --}}
            @auth
                <div class='w-100 sticky top-4 h-fit'>
                    <div class='profile border-l-4 border-blue-500'>
                        
                        <img src='{{ route('image.users', auth()->user()->image_path)}}' class='w-20 max-w-20'>
                        <div>
                            <h2 class='text-xl font-bold'><a href={{ route('users.show', auth()->user()->id) }}>{{ auth()->user()->name }}</a></h2>
                            <p>{{ auth()->user()->email }}</p>
                            <p>{{ count(auth()->user()->recipe) }} @if (count(auth()->user()->recipe) > 1)Recipes @else Recipe @endif</p>
                        </div>
                    </div>
                </div>
            @endauth
            <div class='w-full'>
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
                    <div class='w-full'>
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
                <div class='w-100 sticky top-4 friends-list border-l-4 border-yellow-500 h-fit'>
                    <ul>
                        <li><h2>Your Friends</h2></li>
                        @session('friendslist')
                            @foreach($value as $friend)
                            <li>
                                <a class="btn flex gap-2 items-center m-2" href="{{ route('users.show', $friend->friend_user_id) }}">
                                    <img src='{{ route('image.users', $friend->image_path) }}' class='w-10 max-w-10'>
                                    <strong>{{ $friend->name }}</strong>
                                </a>
                            </li>
                            @endforeach
                        @endsession
                    </ul>
                </div>
            @endauth
        </div>
    </main>
    <footer>
        <div class="flex justify-center gap-12 p-12 text-center align-middle text-gray-400">
            <div>
                <h3><strong>More By Vincent</strong></h3>
                <ul>
                    <li>
                        <a href='http://vinnie.fyi'>Portfolio Website</a>
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
                    <li>Worldstar</li>
                    <li>Laravel Docs</li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>
