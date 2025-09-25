<x-layout>
    <ul>
        @if(session('success'))
            <div class='bg-green-200 text-green-800 p-2 rounded mb-4 bold'>
                {{ session('success') }}
            </div>
        @endif
    </ul>
    <div class='flex justify-between items-center mb-4'>
        {{-- <div class='friends list'>
            <ul>
                @foreach($friends as $friend)
                    <li>{{ $friend->name }}</li>
                @endforeach
            </ul>
        </div> --}}
        {{-- Recipe List --}}
        <div>
            <a href="{{ route('recipes.create') }}">Create a New Recipe</a>
            <h2>List of all Recipes</h2>
            {{  $recipes->links() }}
            <ul>
                @foreach($recipes as $recipe)
                    <li>
                        <x-card href="{{ route('recipes.show', $recipe) }}">
                            <div style='display:flex;flex-direction:column;gap:0.5rem;'>
                                <h3>{{ $recipe->title }}</h3>
                                <p><strong>Prep Time: </strong>{{ $recipe->preparation_time}}</p>
                                <p><strong>Cook Time: </strong>{{ $recipe->cooking_time}}</p>
                                <p><strong>Difficulty: </strong>{{$recipe->difficulty}}</p>
                            </div>
                        </x-card>
                        <x-comments>

                        </x-comments>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    {{  $recipes->links() }}
</x-layout>

