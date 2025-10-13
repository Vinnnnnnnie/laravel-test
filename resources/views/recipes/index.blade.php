<x-layout>
    <ul>
        @if(session('success'))
            <div class='bg-green-200 text-green-800 p-2 rounded mb-4 bold'>
                {{ session('success') }}
            </div>
        @endif
    </ul>
    <div class='flex justify-between mb-4 gap-8'>
        {{-- User info --}}
        <div class='w-80'>
            <div class='profile'>
                <img src='{{ route('image.users', auth()->user()->image_path)}}' class='w-20 max-w-20'>
                <div>
                    <h2 class='text-xl font-bold'><a href={{ ''/*route('user.show')*/ }}>{{ auth()->user()->name }}</a></h2>
                    <p>{{ auth()->user()->email }}</p>
                    <p>{{ count(auth()->user()->recipe) }} @if (count(auth()->user()->recipe) > 1)Recipes @else Recipe @endif</p>
                </div>
            </div>
        </div>
        {{-- Recipe List --}}
        <div class='w-full'>
            <div class='flex justify-between items-center mb-4'>
                <h2>Recent Recipes</h2><a class='btn' href="{{ route('recipes.create') }}"> + Create a New Recipe</a>
            </div>
            <ul>
                @foreach($recipes as $recipe)
                    <li>
                        {{-- If recipe has a lot of likes, could have a fire border,
                        if it is new, it could have a blue new border,
                        if it is disliked a lot, give it a controversial border --}}

                        {{-- Border or tag I suppose --}}
<<<<<<< HEAD

                        <x-card href="{{ route('recipes.show', $recipe) }}">
                            <div style='display:flex;flex-direction:column;gap:0.5rem;'>
                                <div class='flex flex-row gap-2' style='flex-direction:row'>
=======
                    
                        <x-card href="{{ route('recipes.show', $recipe) }}" :user='$recipe->user_id === auth()->user()->id'>
                            <div class='flex flex-col gap-0.5 w-100 justify-start'>
                                <div class='flex flex-row gap-2'>
>>>>>>> cb5687474fc3ad250fa5f07662b26760754c0479
                                    <img src='{{ route('image.users',$recipe->user->image_path) }}' class='w-20 max-w-20'>
                                    <div>
                                        <strong>{{ $recipe->user->name }}</strong>
                                        <p>{{ count($recipe->user->recipe) }} @if (count($recipe->user->recipe) > 1)Recipes @else Recipe @endif</p>
                                        <p>{{ $recipe->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>

                                <h3>{{ $recipe->title }}</h3>
                                <img src='{{ route('image.recipes',$recipe->image_path) }}' class='w-full max-w-full  self-center'>
                                <p><strong>Prep Time: </strong>{{ $recipe->preparation_time}} Minutes</p>
                                <p><strong>Cook Time: </strong>{{ $recipe->cooking_time}} Minutes</p>
                                <p><strong>Difficulty: </strong>{{$recipe->difficulty}}</p>
                            </div>
                        </x-card>
                        @if($recipe->comment)
                            @foreach($recipe->comment as $comment)
                                <x-comment :owner='$comment->user_id === $recipe->user_id' :user='$comment->user_id === auth()->user()->id'>
                                    <div>
                                        <img src='{{ route('image.users', $comment->user->image_path) }}' class='w-20 max-w-20'>
                                        <strong>{{ $comment->user->name }}:</strong>
                                    </div>
                                    <div>
                                    {{ $comment->comment }}
                                    </div>
                                </x-comment>
                            @endforeach
                        @endif

                    </li>
                @endforeach
            </ul>
            {{  $recipes->links() }}
        </div>
        {{-- Friends List --}}
        <div class='friends-list'>
            <ul>
                <li><h2>Your Friends</h2></li>
                @foreach($friends as $friend)
                <li>
                    <a class="btn flex gap-2 items-center m-2" href="{{ route('users.show', $friend->friend_user_id) }}">
                        <img src='{{ route('image.users', $friend->image_path) }}' class='w-10 max-w-10'>
                        <strong>{{ $friend->name }}</strong>
                    </a>
                </li>
                @endforeach

            </ul>
        </div>
    </div>

</x-layout>
