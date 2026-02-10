<x-recipe-layout>
    <div>
        @if(isset($users) && count($users) > 0)
        <h2>Users</h2>
            <ul class='flex flex-col gap-4'>
                @foreach($users as $user)
                    <li>
                        <div class='w-100 sticky top-4 h-fit'>
                            <div class='profile'>
                                
                                <img src='{{ route('image.users', $user->image_path)}}' class='w-20 max-w-20'>
                                <div>
                                    <h2 class='text-xl font-bold'><a href={{ route('users.show', $user->id) }}>{{ $user->name }}</a></h2>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{  $users->withQueryString()->links() }}
        @endif
        <h2>Recipes</h2>
        <x-recipe-list 
            :recipes='$recipes'
            :pagination='false'
        />
        {{  $recipes->withQueryString()->links() }}
    </div>
</x-recipe-layout>
