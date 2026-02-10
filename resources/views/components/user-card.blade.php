@props(
    ['user' => NULL]
)
<div class='bg-gray-100 dark:bg-gray-900 flex items-center gap-4 p-4 border-l-4 border-blue-500 w-full'>
    @if($user->image_path)
    <img src='{{ route('image.users', $user->image_path)}}' class='w-20 max-w-20'>
    @endif
    <div class='w-full'>
        <h2 class='text-xl font-bold mb-0 flex flex-row items-center justify-between w-full'>
            <a href={{ route('users.show', $user->id) }}>{{ $user->name }}</a> 
            <a href=''>{{ svg('bi-gear-fill') }}</a>
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
        <p>{{ $user->email }}</p>
        <p>{{ count($user->recipes) }} @if (count($user->recipes) > 1)Recipes @else Recipe @endif</p>
    </div>
</div>