<x-recipe-layout>
    {{-- User information --}}
    <div class='card flex flex-row gap-4'>
        @if($user->image_path)
        <img src='{{ route('image.users', $user->image_path)}}' class='w-50 max-w-50' alt='{{$user->name}} Profile Picture'>
        @endif
        <div class='flex flex-col gap-4'>
            <div class='flex justify-start w-full'><h2>{{ $user->name}}</h2></div>
            <p><strong>{{ $user->email }}</strong></p>
            <p>{{$user->bio}}</p>
        </div>
        <div>
            @if (session("friendslist")->pluck("friend_user_id")->contains($user->id))
                <form action='{{ route('friends.destroy') }}' method='post'>
                    @csrf
                    @method('DELETE')
                    <input hidden id='user_id' name='user_id' value='{{ auth()->user()->id }}'>
                    <input hidden id='friend_user_id' name='friend_user_id' value='{{ $user->id }}'>
                    <input type='submit' class="btn bg-red-500" value='Remove Friend'>
                </form>
            @elseif ($user->id !== auth()->user()->id)
                <form action='{{ route('friends.store') }}' method='post'>
                    @csrf
                    <input hidden readonly id='user_id' name='user_id' value='{{ auth()->user()->id }}'>
                    <input hidden readonly id='friend_user_id' name='friend_user_id' value='{{ $user->id }}'>
                    <input type='submit' class="btn bg-green-500" value='Add Friend'>
                </form>
            @else
                <form action='' method='post'>
                    @csrf
                    <input hidden id='user_id' name='user_id' value='{{ auth()->user()->id }}'>
                    <input hidden id='friend_user_id' name='friend_user_id' value='{{ $user->id }}'>
                    <input type='submit' class="btn bg-green-500" value='Edit Profile'>
                </form>  
            @endif
        </div>
    </div>
    
    {{-- Recipe List --}}
    {{-- {{ dd($recipes) }} --}}
    <div class='w-full'>
        <div class='flex justify-between items-center mb-4'>
            <h2>Recipes by {{$user->name}}</h2>
        </div>
        <ul class='flex flex-col gap-4'>
            @foreach($recipes as $recipe)
                <li>
                    {{-- If recipe has a lot of likes, could have a fire border,
                    if it is new, it could have a blue new border,
                    if it is disliked a lot, give it a controversial border --}}
                    {{-- Border or tag I suppose --}}
                    <x-card href="{{ route('recipes.show', $recipe) }}" 
                        :user='$recipe->user_id === auth()->user()->id' 
                        :friend='session("friendslist")->pluck("friend_user_id")->contains($recipe->user_id)'
                        :recipe='$recipe'
                    />
                </li>
            @endforeach
        </ul>
        {{  $recipes->links() }}
    </div>
</x-recipe-layout>
