@props(['highlight' => false, 'user' => false, 'owner' => false, 'friend' => false])
<a {{ $attributes }} @class(['highlight' => $highlight, 'user' => $user, 'owner' => $owner, 'friend' => $friend, 'card'])>
    <div class='w-full'>
    {{ $slot }}
    </div>
</a>
