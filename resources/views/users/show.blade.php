<x-recipe-layout>
    {{-- User information --}}
    <div class='card flex flex-row gap-4'>
        @if($user->image_path)
        <img src='{{ route('image.users', $user->image_path)}}' class='w-50 max-w-50' alt='{{$user->name}} Profile Picture'>
        @endif
        <div class='flex flex-col gap-4'>
            <div class='flex flex-col justify-start w-full'>
                <h2>{{ $user->name}}</h2>
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
            </div>
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
                    <a href='{{ route('users.edit') }}' class="btn bg-green-500">Edit Profile</a>
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
        <x-recipe-list 
            :recipes='$recipes'
        />
    </div>
</x-recipe-layout>
