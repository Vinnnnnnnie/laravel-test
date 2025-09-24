<x-layout>
    <h2>List of all Recipes</h2>
    {{  $recipes->links() }}
    <ul>
        @foreach($recipes as $recipe)
            <li>
                <x-card href="{{ route('recipes.show', $recipe->id) }}">
                        <div style='display:flex;flex-direction:column;gap:0.5rem;'>
                        <h3>{{ $recipe->title }}</h3>
                        <p><strong>Engine Size: </strong></p>
                        <p><strong>Color: </strong></p>
                    </div>
                    
                </x-card>
            </li>
        @endforeach
    </ul>
    {{  $recipes->links() }}
    {{-- <a href="{{ route('recipe.create') }}">Create a New Bike</a> --}}
</x-layout>

