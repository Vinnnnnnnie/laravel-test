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
            <div class='bg-gray-800 flex items-center gap-4 p-4'>
                <img src='{{ route('image.users', auth()->user()->image_path)}}' class='w-20 max-w-20'>
                <div>
                    <h2 class='text-xl font-bold'>{{ auth()->user()->name }}</h2>
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
                    
                        <x-card href="{{ route('recipes.show', $recipe) }}">
                            <div style='display:flex;flex-direction:column;gap:0.5rem;'>
                                <div class='flex flex-row gap-2' style='flex-direction:row'>
                                    <img src='{{ route('image.users',$recipe->user->image_path) }}' class='w-20 max-w-20'>
                                    <div>
                                        <strong>{{ $recipe->user->name }}</strong>
                                        <p>{{ count($recipe->user->recipe) }} @if (count($recipe->user->recipe) > 1)Recipes @else Recipe @endif</p>
                                    </div>
                                </div>

                                <h3>{{ $recipe->title }}</h3>
                                <img src='{{ route('image.recipes',$recipe->image_path) }}' class='w-100 max-w-100'>
                                <p><strong>Prep Time: </strong>{{ $recipe->preparation_time}} Minutes</p>
                                <p><strong>Cook Time: </strong>{{ $recipe->cooking_time}} Minutes</p>
                                <p><strong>Difficulty: </strong>{{$recipe->difficulty}}</p>
                            </div>
                        </x-card>
                        @if($recipe->comment)
                            @foreach($recipe->comment as $comment)
                                <x-comment :highlight='$comment->user_id === $recipe->user_id'>
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
        <div class='friends-list w-80 p-4 bg-gray-800'>
            {{-- Friends List --}}
            {{-- This is a placeholder. Replace with dynamic content as needed. --}}
            <ul>
                <li><h2>Your Friends</h2></li>
                <li>
                    <div>
                        <span><strong>Ellen Maxwell</strong></span>
                        <p>7 Recipes</p>
                    </div>
                </li>
                <li>
                    <div>
                        <span><strong>Tom Bozier</strong></span>
                        <p>3 Recipes</p>
                    </div>
                </li>                
                <li>
                    <div>
                        <span><strong>Vera Stepanyan</strong></span>
                        <p>12 Recipes</p>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    
</x-layout>

                <li>{{ view('friends.index')}}</li>
