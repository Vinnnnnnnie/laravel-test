<x-recipe-layout>
    <div class='flex justify-between mb-4 gap-8'>
        {{-- Recipe Body --}}
        <div class='w-full'>
            <div class='flex justify-between items-center mb-4'>
                <h2>Recent Recipes</h2><a class='btn' href="{{ route('recipes.create') }}"> + Create a New Recipe</a>
            </div>
            {{-- Recipe List --}}
            <x-recipe-list
                :recipes='$recipes'
            />
        </div>
    </div>
</x-recipe-layout>
