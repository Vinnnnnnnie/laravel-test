@props(
    ['highlight' => false, 
    'user' => false, 
    'owner' => false, 
    'friend' => false, 
    'fire' => false, 
    'saved' => false,
    'recipe' => NULL]
)
<div @class(['highlight' => $highlight, 'user' => $user, 'owner' => $owner, 'friend' => $friend, 'fire' => $fire, 'saved' => $saved, 'card'])>
    <div class='w-full'>
        <div class='flex flex-col gap-0.5 w-full justify-start'>
            <div class='flex justify-between items-center'>
                <x-recipe-profile
                    :user='$recipe->user'
                    :created='$recipe->created_at'
                />
                @if($saved)
                    <x-bi-bookmark-fill class='size-10 text-orange-500'/>
                @endif
            </div>
            
            <h2 class='fs-6'><a {{ $attributes }}>{{ $recipe->title }}</a></h2>
            @if($recipe->image_path)
            <div class='dark:bg-gray-950 bg-gray-50 w-full flex justify-center align-items-center'>
                <img src='{{ route('image.recipes',$recipe->image_path) }}' class='aspect-auto h-fit max-h-80 self-center'>
            </div>
            @endif
            <p class='flex items-center flex-row gap-2'>{{ svg('bi-clock') }} Preparation - {{ $recipe->preparation_time}} Minutes</p>
            <p class='flex items-center flex-row gap-2'><x-bi-thermometer-high/> Cooking - {{ $recipe->cooking_time}} Minutes</p>
            <p class='flex items-center flex-row gap-2'><x-bi-stoplights/>Difficulty - {{$recipe->difficulty}}</p>
            @if($recipe->tags)
                <ul class='flex flex-row flex-wrap gap-2'>
                    @foreach ($recipe->tags as $tag)
                        <span class='bg-blue-500 text-white p-2 rounded-md'>{{ $tag->name }}</span>
                    @endforeach
                </ul>
            @endif
            <div class='flex flex-row justify-between py-2'>
                <div class='flex flex-row gap-2 items-center'>
                    <x-bi-chat-fill /> {{ count($recipe->comments) }}
                </div>
                <div class='flex flex-row gap-2 items-center'>
                    <x-bi-bookmark-fill /> {{ count($recipe->savedUsers) }}
                </div>
            </div>
        </div>
    </div>
</a>
