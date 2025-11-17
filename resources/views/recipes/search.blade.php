<x-layout>
    <div>
        @if(isset($users) && count($users) > 0)
        <h2>Users</h2>
            <ul class='gap-1'>
                @foreach($users as $user)
                    <li>
                        <div class='w-100 sticky top-4 h-fit'>
                            <div class='profile'>
                                
                                <img src='{{ route('image.users', $user->image_path)}}' class='w-20 max-w-20'>
                                <div>
                                    <h2 class='text-xl font-bold'><a href={{ route('users.show', $user->id) }}>{{ $user->name }}</a></h2>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{  $users->withQueryString()->links() }}
        @endif
        <h2>Recipes</h2>
        <ul>
            @if(isset($recipes))
                @foreach($recipes as $recipe)
                    <li>
                        <x-card href="{{ route('recipes.show', $recipe) }}" :user='$recipe->user_id === auth()->user()->id'>
                            <div class='flex flex-col gap-0.5 w-100 justify-start'>
                                <div class='flex flex-row gap-2'>
                                    <img src='{{ route('image.users',$recipe->user_image) }}' class='w-20 max-w-20'>
                                    <div>
                                        <strong>{{ $recipe->user->name }}</strong>
                                        <p>{{ count($recipe->user->recipe) }} @if (count($recipe->user->recipe) > 1)Recipes @else Recipe @endif</p>
                                        <p>{{ $recipe->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>

                                <h3>{{ $recipe->title }}</h3>
                                <img src='{{ route('image.recipes',$recipe->recipe_image) }}' class='w-full max-w-full  self-center'>
                                <p><strong>Prep Time: </strong>{{ $recipe->preparation_time}} Minutes</p>
                                <p><strong>Cook Time: </strong>{{ $recipe->cooking_time}} Minutes</p>
                                <p><strong>Difficulty: </strong>{{$recipe->difficulty}}</p>
                            </div>
                        </x-card>
                    </li>
                @endforeach
            @endif
        </ul>
        {{  $recipes->withQueryString()->links() }}
    </div>
</x-layout>