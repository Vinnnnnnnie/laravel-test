@props(['highlight' => false, 'user' => false, 'owner' => false, 'friend' => false, 'fire' => false])
<a {{ $attributes }} @class(['highlight' => $highlight, 'user' => $user, 'owner' => $owner, 'friend' => $friend, 'fire' => $fire, 'card'])>
    <div class='w-full'>
    {{ $slot }}
    </div>
</a>
