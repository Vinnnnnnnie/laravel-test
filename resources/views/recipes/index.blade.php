<x-layout>
    <div class='flex justify-between mb-4 gap-8'>
        {{-- Recipe Body --}}
        <div class='w-full'>
            <div class='flex justify-between items-center mb-4'>
                <h2>Recent Recipes</h2><a class='btn' href="{{ route('recipes.create') }}"> + Create a New Recipe</a>
            </div>
            {{-- Recipe List --}}
            <ul>
                @foreach($recipes as $recipe)
                    <li>
                        {{-- If recipe has a lot of likes, could have a fire border,
                        if it is new, it could have a blue new border,
                        if it is disliked a lot, give it a controversial border --}}

                        {{-- Border or tag I suppose --}}
                        {{-- Need to reduce the stuff in this by putting it all into the component --}}
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
                                <h2 class='fs-6'>{{ $recipe->title }}</h2>
                                @if($recipe->image_path)
                                <img src='{{ route('image.recipes',$recipe->image_path) }}' class='w-full max-w-full  self-center'>
                                @endif
                                <p><strong>Prep Time: </strong>{{ $recipe->preparation_time}} Minutes</p>
                                <p><strong>Cook Time: </strong>{{ $recipe->cooking_time}} Minutes</p>
                                <p><strong>Difficulty: </strong>{{$recipe->difficulty}}</p>
                            </div>
                        </x-card>
                    </li>
                @endforeach
            </ul>
            {{  $recipes->links() }}
        </div>
    </div>
</x-layout>