<x-layout>
    <ul>
    @if(session('success'))
        <div class='bg-green-200 text-green-800 p-2 rounded mb-4 bold'>
            {{ session('success') }}
        </div>
    @endif
    
    </ul>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class='px-4 py-2 bg-red-200 rounded-lg'>
                @foreach ($errors->all() as $error)
                    <li class='text-red-500'>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- User information --}}
    <div class='card flex flex-row gap-4'>
        <img src='{{ route('image.users', $user->image_path)}}' class='w-50 max-w-50'>
        <div class='flex flex-col gap-4'>
            <div class='flex justify-start w-full'><h2>{{ $user->name}}</h2></div>
            <p><strong>{{ $user->email }}</strong></p>
            <p>I love food. Ever since I tasted my first piece of kale, I haven't been able to stay away from delicious food.
                I love food. Ever since I tasted my first piece of kale, I haven't been able to stay away from delicious food.
                I love food. Ever since I tasted my first piece of kale, I haven't been able to stay away from delicious food.
                I love food. Ever since I tasted my first piece of kale, I haven't been able to stay away from delicious food.
                I love food. Ever since I tasted my first piece of kale, I haven't been able to stay away from delicious food.
                I love food. Ever since I tasted my first piece of kale, I haven't been able to stay away from delicious food.
                I love food. Ever since I tasted my first piece of kale, I haven't been able to stay away from delicious food.
            </p>
        </div
        {{-- @if(UserFriend::select()->where('user_id', auth()->user()->id)->where('friend_user_id', $user->id)->exists()) --}}
        <form action='{{ route('friends.store') }}' method='post'>
            @csrf
            <input hidden id='user_id' name='user_id' value='{{ auth()->user()->id }}'>
            <input hidden id='friend_user_id' name='friend_user_id' value='{{ $user->id }}'>
            <input type='submit' class="btn bg-green-500" value='Add Friend'>
        </form>
        {{-- @else --}}
        <form action='{{ route('friends.destroy') }}' method='post'>
            @csrf
            @method('DELETE')
            <input hidden id='user_id' name='user_id' value='{{ auth()->user()->id }}'>
            <input hidden id='friend_user_id' name='friend_user_id' value='{{ $user->id }}'>
            <input type='submit' class="btn bg-red-500" value='Remove Friend'>
        </form>
        {{-- @endif --}}
    </div>
    
    {{-- Recipe List --}}
        <div class='w-full'>
            <div class='flex justify-between items-center mb-4'>
                <h2>Recent Recipes</h2><a class='btn' href="{{ route('recipes.create') }}"> + Create a New Recipe</a>
            </div>
            <ul>
                @foreach($recipes as $recipe)
                    <li>
                        {{-- If recipe has a lot of likes, could have a fire border,
                        if it is new, it could have a blue new border,
                        if it is disliked a lot, give it a controversial border --}}

                        {{-- Border or tag I suppose --}}
                    
                        <x-card href="{{ route('recipes.show', $recipe) }}" :user='$recipe->user_id === auth()->user()->id'>
                            <div class='flex flex-col gap-0.5 w-100 justify-start'>
                                <div class='flex flex-row gap-2'>
                                    <img src='{{ route('image.users',$recipe->user->image_path) }}' class='w-20 max-w-20'>
                                    <div>
                                        <strong>{{ $recipe->user->name }}</strong>
                                        <p>{{ count($recipe->user->recipe) }} @if (count($recipe->user->recipe) > 1)Recipes @else Recipe @endif</p>
                                        <p>{{ $recipe->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>

                                <h3>{{ $recipe->title }}</h3>
                                <img src='{{ route('image.recipes',$recipe->image_path) }}' class='w-full max-w-full self-center'>
                                <p><strong>Prep Time: </strong>{{ $recipe->preparation_time}} Minutes</p>
                                <p><strong>Cook Time: </strong>{{ $recipe->cooking_time}} Minutes</p>
                                <p><strong>Difficulty: </strong>{{$recipe->difficulty}}</p>
                            </div>
                        </x-card>
                        @if($recipe->comment)
                            @foreach($recipe->comment as $comment)
                                <x-comment :owner='$comment->user_id === $recipe->user_id' :user='$comment->user_id === auth()->user()->id'>
                                    <div>
                                        <img src='{{ route('image.users', $comment->user->image_path) }}' class='w-20 max-w-20'>
                                        <strong>{{ $comment->user->name }}:</strong>
                                    </div>
                                    <div>
                                    {{ $comment->comment }}
                                    </div>
                                </x-comment>
                            @endforeach
                        @endif

                    </li>
                @endforeach
            </ul>
            {{  $recipes->links() }}
        </div>
    {{-- Friend information ? --}}
    {{-- Buttons --}}
</x-layout>
