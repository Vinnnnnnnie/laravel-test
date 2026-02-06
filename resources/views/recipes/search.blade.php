<x-recipe-layout>
    <div>
        @if(isset($users) && count($users) > 0)
        <h2>Users</h2>
            <ul class='flex flex-col gap-4'>
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
        <ul class='flex flex-col gap-4'>
            @if(isset($recipes))
                @foreach($recipes as $recipe)
                    <li>
                        <x-card href="{{ route('recipes.show', $recipe) }}" 
                            :user='$recipe->user_id === auth()->user()->id' 
                            :friend='session("friendslist")->pluck("friend_user_id")->contains($recipe->user_id)'
                            :recipe='$recipe'
                            />
                    </li>
                @endforeach
            @endif
        </ul>
        {{  $recipes->withQueryString()->links() }}
    </div>
</x-recipe-layout>
