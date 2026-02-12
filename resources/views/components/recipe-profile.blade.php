@props(
    [
        'user' => NULL,
        'created' => NULL
    ]
)
<div class='flex flex-row gap-2'>
    <img src='{{ route('image.users',$user->image_path) }}' class='w-20 max-w-20'>
    <div>
        <h5><a href='{{ route('users.show', $user) }}'>{{ $user->name }}</a></h5>
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
            <x-bi-arrow-up-circle-fill/> {{ $user->reputation }}
        </div>        
        <p>{{ $created->diffForHumans() }}</p>
    </div>
</div>