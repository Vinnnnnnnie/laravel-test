@props(['highlight'=> false, 'owner' => false, 'user' => false, 'friend' => false])
<div @class(['highlight' => $highlight,'user'=>$user, 'owner'=>$owner, 'friend' => $friend,  'comment'])>
    {{-- User image and content --}}
    <div class='flex w-full items-center justify-between gap-2'>
    {{ $slot }}
    </div>
    {{-- Comment buttons --}}
    {{-- <div class='flex gap-2 justify-between mt-2'>
        <button class='btn'>Like</button><button class='btn'>Dislike</button>
    </div> --}}
</div>