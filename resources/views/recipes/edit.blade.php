<x-recipe-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card flex flex-col">
        <h2>Edit Recipe</h2>
        <form class='flex flex-col gap-4' action='{{ route('recipes.update', $recipe->id) }}' method='POST' enctype="multipart/form-data">
            @csrf
            <div hidden>
                <label class='text-xl font-semibold' for="id">Recipe id</label>
                <input class='bg-gray-200 dark:bg-gray-800 p-2' type="text" id="id" name="id" value='{{ $recipe->id }}' required>
            </div>
            <div class='flex flex-col'>
                <label class='text-xl font-semibold' for="image" class='form-label'>Image</label>
                <input type="file" id="image" class='form-control w-full' name="image">
            </div>
            <div class='flex flex-col'>
                <label class='text-xl font-semibold' for="title">Recipe Title</label>
                <input class='bg-gray-200 dark:bg-gray-800 p-2' type="text" id="title" name="title" value='{{ $recipe->title }}' required>
            </div>
            <div class='flex flex-col'>
                <label class='text-xl font-semibold' for="ingredients">Ingredients</label>
                <textarea class='bg-gray-200 dark:bg-gray-800 p-2' type="text" id="ingredients" name="ingredients" required>{{ $recipe->ingredients }}</textarea>
            </div>
            <div class='flex flex-col'>
                <label class='text-xl font-semibold' for="Instructions">Instructions</label>
                <textarea class='bg-gray-200 dark:bg-gray-800 p-2' type="text" id="instructions" name="instructions" required>{{ $recipe->instructions }}</textarea>
            </div>
            <div class='flex flex-col'>
                <label class='text-xl font-semibold' for="preparation_time">Preparation Time (minutes)</label>
                <input class='bg-gray-200 dark:bg-gray-800 p-2' type="number" id="preparation_time" name="preparation_time" value='{{ $recipe->preparation_time }}' required>
            </div>
            <div class='flex flex-col'>
                <label class='text-xl font-semibold' for="cooking_time">Cooking Time (minutes)</label>
                <input class='bg-gray-200 dark:bg-gray-800 p-2' type="number" id="cooking_time" name="cooking_time" value='{{ $recipe->preparation_time }}' required>
            </div>
            <div class='flex flex-col'>
                <label class='text-xl font-semibold' for="servings">Servings</label>
                <input class='bg-gray-200 dark:bg-gray-800 p-2' type="number" id="servings" name="servings" value='{{ $recipe->servings }}' required>
            </div>
            <div class='flex flex-col'>
                <label class='text-xl font-semibold' for="difficulty">Difficulty</label>
                <select class='bg-gray-200 dark:bg-gray-800 p-2' id="difficulty" name="difficulty" required>
                    <option value="">Select Difficulty</option>
                    <option value="Easy" {{ $recipe->difficulty == 'Easy' ? 'selected' : '' }}>Easy</option>
                    <option value="Medium" {{ $recipe->difficulty == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="Hard" {{ $recipe->difficulty == 'Hard' ? 'selected' : '' }}>Hard</option>
                </select>
            </div>
            <button class='bg-gray-200 dark:bg-gray-800 p-2' type='submit'>Save Recipe</button>
        </form>
    </div>
</x-recipe-layout>
