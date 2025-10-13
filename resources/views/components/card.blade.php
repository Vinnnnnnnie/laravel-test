@props(['highlight' => false, 'user' => false, 'owner' => false])
<a {{ $attributes }} @class(['highlight' => $highlight, 'user' => $user, 'owner' => $owner, 'card'])>
    <div class='w-full'>
    {{ $slot }}
    </div>
</a>
