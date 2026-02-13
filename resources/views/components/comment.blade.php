@props(
    ['highlight'=> false, 
    'owner' => false, 
    'user' => false, 
    'friend' => false,
    'comment' => NULL]
)
<div @class(['highlight' => $highlight,'user'=>$user, 'owner'=>$owner, 'friend' => $friend,  'comment'])>
    {{-- User image and content --}}
    <div class='flex w-full justify-between gap-2'>
        <x-profile-picture
            :size='20'
            :image='$comment->user->image_path'
        />
        {{-- {{ dd($comment->user) }} --}}
        <div class="w-full flex flex-col items-start h-full">
            <h5 class='text-l font-semibold'><a href='{{ route('users.show', $comment->user) }}'>{{ $comment->user->name }}</a></h5>
            {{ $comment->comment }}
        </div>
    </div>
    {{-- Comment buttons --}}
    {{-- <div class='flex gap-2 justify-between mt-2'>
        <button class='btn'>Like</button><button class='btn'>Dislike</button>
    </div> --}}
</div>