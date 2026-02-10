<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RecipeShare</title>
    @vite('resources/css/app.css')
</head>
<body class='bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-100 font-sans'>
    <x-header/>
    <main class='items-center p-8'>
        <div class='flex justify-between gap-8'>
            {{-- User info --}}
            @auth
                <div class='flex-1 sticky top-4 h-fit flex flex-col gap-4'>
                    <x-user-card
                        :user='auth()->user()'
                    />
                    @auth
                    {{-- Recipe Search --}}
                    <div class='w-full mb-2'>
                        <h2>Find Recipes</h2>
                        <form action='{{ route('recipes.search') }}' method='get' class='flex gap-2 dark:bg-gray-900 bg-gray-100 p-4'>
                            @csrf
                            <input type='text' id='term' name='term' placeholder='Search Recipes...' class='w-full' value={{ old('term') }}>
                            <input type='submit' name='submit' class='btn' value='Go'>
                        </form>
                    </div>
                    <div class='flex justify-between items-center mb-4'>
                        <a class='btn' href="{{ route('recipes.create') }}"> + Create a New Recipe</a>
                    </div>
                @endauth    
                </div>
            @endauth
            <div class='flex-4 gap-4 basis-2xl bg-gray-200 dark:bg-gray-800'>
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
                
                {{ $slot }}
            </div>
            {{-- Friends List --}}
            @auth
                <div class='flex-1 sticky top-4 border-l-4 border-yellow-500 h-fit p-4 bg-gray-100 dark:bg-gray-900'>
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
    <x-footer/>
</body>
</html>
