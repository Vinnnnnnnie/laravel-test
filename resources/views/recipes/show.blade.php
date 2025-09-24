<x-layout>
    <h2>{{ $recipe->title }}</h2>
    <p><strong>Ingredients: </strong>{{ $recipe->ingredients }}</p>
    <p><strong>Instructions: </strong>{{ $recipe->instructions }}</p>
    <div class='flex gap-2'>
        <a class='btn' href="/recipes/{{ $recipe->id }}/edit">Edit Recipe</a>
        <form method="POST" action="/recipes/{{ $recipe->id }}/delete">
            @csrf
            @method('DELETE')
            <button class=btn type="submit">Delete Recipe</button>
        </form>
        <a class='btn' href="/recipes">Back to all Recipes</a>
    </div>
</x-layout>