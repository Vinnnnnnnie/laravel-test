<x-layout>
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
    <div class='flex justify-between mb-4 gap-8'>
        {{-- Recipe List --}}
        <div class='w-full'>
            {{-- Recipe Search --}}
            <div class='w-full'>
                <h2>Find Recipes</h2>
                <form action='{{ route('recipes.search') }}' method='get' class='flex gap-2 card'>
                    @csrf
                    <input type='text' id='term' name='term' placeholder='Search Recipes...' class='w-full'>
                    <input type='submit' class='btn' value='Go'>
                </form>
                
            </div>
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
                    
                        <x-card href="{{ route('recipes.show', $recipe) }}" :user='$recipe->user_id === auth()->user()->id' :friend='session("friendslist")->pluck("friend_user_id")->contains($recipe->user_id)'>
                            <div class='flex flex-col gap-0.5 w-100 justify-start'>
                                <div class='flex flex-row gap-2'>
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
                        {{-- Display comments or not --}}
                        {{-- @if($recipe->comment)
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
                        @endif --}}

                    </li>
                @endforeach
            </ul>
            {{  $recipes->links() }}
        </div>
        {{-- Friends List --}}
        {{-- <div class='friends-list'>
            <ul>
                <li><h2>Your Friends</h2></li>
                @foreach($friendslist as $friend)
                <li>
                    <a class="btn flex gap-2 items-center m-2" href="{{ route('users.show', $friend->friend_user_id) }}">
                        <img src='{{ route('image.users', $friend->image_path) }}' class='w-10 max-w-10'>
                        <strong>{{ $friend->name }}</strong>
                    </a>
                </li>
                @endforeach

            </ul>
        </div> --}}
    </div>

</x-layout>
