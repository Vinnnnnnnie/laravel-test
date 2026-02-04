@props(
    ['highlight'=> false, 
    'owner' => false, 
    'user' => false, 
    'friend' => false,
    'comment' => NULL]
)
<div @class(['highlight' => $highlight,'user'=>$user, 'owner'=>$owner, 'friend' => $friend,  'comment'])>
    {{-- User image and content --}}
    <div class='flex w-full items-center justify-between gap-2'>
        <div>
            <img src='{{ route('image.users', $comment->user->image_path) }}' class='w-20 max-w-20'>
        </div>
        <div class="w-full">
            <h5><strong>{{ $comment->user->name }}</strong></h5>
            {{ $comment->comment }}
        </div>
    </div>
    {{-- Comment buttons --}}
    {{-- <div class='flex gap-2 justify-between mt-2'>
        <button class='btn'>Like</button><button class='btn'>Dislike</button>
    </div> --}}
</div>