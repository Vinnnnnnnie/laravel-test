<x-layout>
    <h2>{{ $recipe->title }}</h2>
    <p><strong>Ingredients: </strong>{{ $recipe->ingredients }}</p>
    <p><strong>Instructions: </strong>{{ $recipe->instructions }}</p>
    <div class='flex gap-2'>
        {{-- <a class='btn' href="{{ route('recipes.edit') }}">Edit Recipe</a> --}}
        <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}">
            @csrf
            @method('DELETE')
            <button class=btn type="submit">Delete Recipe</button>
        </form>
        <a class='btn' href="{{ route('recipes.index') }}">Back to all Recipes</a>
    </div>
</x-layout>