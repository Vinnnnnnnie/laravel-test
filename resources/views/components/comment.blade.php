<div class='comment'>
    {{-- User image and content --}}
    <div class='flex items-center gap-2'>
    {{ $slot }}
    </div>
    {{-- Comment buttons --}}
    <div class='flex gap-2 justify-between mt-2'>
        <button class='btn'>Like</button><button class='btn'>Dislike</button>
    </div>
</div>