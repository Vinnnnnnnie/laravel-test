@props(
    ['highlight' => false, 
    'user' => false, 
    'owner' => false, 
    'friend' => false, 
    'fire' => false, 
    'recipe' => NULL]
)
<a {{ $attributes }} @class(['highlight' => $highlight, 'user' => $user, 'owner' => $owner, 'friend' => $friend, 'fire' => $fire, 'card'])>
    <div class='w-full'>
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
    </div>
</a>
