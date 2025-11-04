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
    <main class='container items-center mx-auto w-450'>
        <div class='flex justify-between mb-4 gap-8'>
        {{-- User info --}}
            <div class='w-80'>
                <div class='profile'>
                    @auth
                    <img src='{{ route('image.users', auth()->user()->image_path)}}' class='w-20 max-w-20'>
                    <div>
                        <h2 class='text-xl font-bold'><a href={{ route('users.show', auth()->user()->id) }}>{{ auth()->user()->name }}</a></h2>
                        <p>{{ auth()->user()->email }}</p>
                        <p>{{ count(auth()->user()->recipe) }} @if (count(auth()->user()->recipe) > 1)Recipes @else Recipe @endif</p>
                    </div>
                    @endauth
                </div>
            </div>
            <div class='w-full'>
                {{ $slot }}
            </div>
            {{-- Friends List --}}
            <div class='friends-list'>
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
        </div>
    </main>
</body>
</html>
