@props(
    ['highlight' => false, 
    'user' => false, 
    'owner' => false, 
    'friend' => false, 
    'fire' => false, 
    'recipe' => NULL]
)
<div @class(['highlight' => $highlight, 'user' => $user, 'owner' => $owner, 'friend' => $friend, 'fire' => $fire, 'card'])>
    <div class='w-full'>
        <div class='flex flex-col gap-0.5 w-full justify-start'>
            <div class='flex flex-row gap-2'>
                <img src='{{ route('image.users',$recipe->user->image_path) }}' class='w-20 max-w-20'>
                <div>
                    <h5><a href='{{ route('users.show', $recipe->user) }}'>{{ $recipe->user->name }}</a></h5>
                    <p>{{ count($recipe->user->recipes) }} @if (count($recipe->user->recipes) > 1)Recipes @else Recipe @endif</p>
                    <p>{{ $recipe->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <h2 class='fs-6'><a {{ $attributes }}>{{ $recipe->title }}</a></h2>
            @if($recipe->image_path)
            <div class='bg-black w-full flex justify-center align-items-center'>
                <img src='{{ route('image.recipes',$recipe->image_path) }}' class='aspect-auto h-fit max-h-80 self-center'>
            </div>
            @endif
            <p class='flex items-center flex-row gap-2'>{{ svg('bi-clock') }} Preparation - {{ $recipe->preparation_time}} Minutes</p>
            <p class='flex items-center flex-row gap-2'><x-bi-thermometer-high/> Cooking - {{ $recipe->cooking_time}} Minutes</p>
            <p class='flex items-center flex-row gap-2'><x-bi-stoplights/>Difficulty - {{$recipe->difficulty}}</p>
            @if($recipe->tags)
                <ul class='flex flex-row gap-2'>
                    @foreach ($recipe->tags as $tag)
                        <span class='bg-blue-500 text-white p-2 rounded-md'>{{ $tag->name }}</span>
                    @endforeach
                </ul>
            @endif
            {{ svg('bi-chat-fill') }} {{ count($recipe->comments) }}
        </div>
    </div>
</a>
