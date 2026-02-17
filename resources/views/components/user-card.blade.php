@props(
    ['user' => NULL]
)
<div class='bg-gray-100 dark:bg-gray-900 flex items-center gap-4 p-4 border-l-4 border-blue-500 w-full'>
    @if($user->image_path)
    <div class='dark:bg-gray-950 aspect-square overflow-hidden min-w-30 min-h-30 w-30 h-30 flex items-center justify-center bg-gray-50 align-items-center rounded-sm'>
        <img src='{{ route('image.users', $user->image_path)}}' class='w-full h-full object-cover'>
    </div>
    @endif
    <div class=''>
        <h2 class='text-xl font-bold mb-0 flex flex-row items-center justify-between w-full'>
            <a href={{ route('users.show', $user->id) }}>{{ $user->name }}</a> 
        </h2>
        <div class='text-green-500 flex flex-row gap-2 font-bold items-center'>
            @if($user->reputation < 5)
                Arsonist
            @elseif($user->reputation < 10)
                Barbecuer
            @elseif($user->reputation < 20)
                Cook
            @elseif($user->reputation < 30)
                Chef
            @elseif($user->reputation < 50)
                Gourmand
            @elseif($user->reputation < 100)
                Michellin
            @elseif($user->reputation > 99)
                Master Chef
            @endif
            {{ svg('bi-arrow-up-circle-fill') }} {{ $user->reputation }}
        </div>
        <p>{{ count($user->recipes) }} @if (count($user->recipes) > 1)Recipes @else Recipe @endif</p>
    </div>
</div>