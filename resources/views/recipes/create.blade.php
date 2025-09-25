<x-layout>
    <h2>Create a New Recipe</h2>
    <div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class='px-4 py-2 bg-red-200 rounded-lg'>
                @foreach ($errors->all() as $error)
                    <li class='text-red-500'>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>
    <form method="POST" action="{{ route('recipes.store') }}">
        @csrf
        <div>
            <label for="title">Recipe Title:</label>
            <input type="text" id="title" name="title" value='{{ old('title') }}' required>
        </div>
        <div>
            <label for="ingredients">Ingredients:</label>
            <textarea id="ingredients" name="ingredients" required>{{ old('ingredients') }}</textarea>
        </div>
        <div>
            <label for="instructions">Instructions:</label>
            <textarea id="instructions" name="instructions" required>{{ old('instructions') }}</textarea>
        </div>
        <div>
            <label for="preparation_time">Preparation Time (minutes):</label>
            <input type="number" id="preparation_time" name="preparation_time" value='{{ old('preparation_time') }}' required>
        </div>
        <div>
            <label for="cooking_time">Cooking Time (minutes):</label>
            <input type="number" id="cooking_time" name="cooking_time" value='{{ old('cooking_time') }}' required>
        </div>
        <div>
            <label for="servings">Servings:</label>
            <input type="number" id="servings" name="servings" value='{{ old('servings') }}' required>
        </div>
        <div>
            <label for="difficulty">Difficulty:</label>
            <select id="difficulty" name="difficulty" required>
                <option value="">Select Difficulty</option>
                <option value="Easy" {{ old('difficulty') == 'Easy' ? 'selected' : '' }}>Easy</option>
                <option value="Medium" {{ old('difficulty') == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Hard" {{ old('difficulty') == 'Hard' ? 'selected' : '' }}>Hard</option>
            </select>
        </div>
        <button type="submit">Create Recipe</button>
    </form>
</x-layout>
