<x-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <h2>Edit Recipe</h2>
        <form action='{{ route('recipes.update', $recipe->id) }}' method='POST'>
            @csrf
            <div hidden>
                <label for="id">Recipe id:</label>
                <input type="text" id="id" name="id" value='{{ $recipe->id }}' required>
            </div>
            <div>
                <label for="title">Recipe Title:</label>
                <input type="text" id="title" name="title" value='{{ $recipe->title }}' required>
            </div>
            <div>
                <label for="ingredients">Ingredients:</label>
                <input type="text" id="ingredients" name="ingredients" value='{{ $recipe->ingredients }}' required>
            </div>
            <div>
                <label for="Instructions">Instructions:</label>
                <input type="text" id="instructions" name="instructions" value='{{ $recipe->instructions }}' required>
            </div>
            <div>
                <label for="preparation_time">Preparation Time (minutes):</label>
                <input type="number" id="preparation_time" name="preparation_time" value='{{ $recipe->preparation_time }}' required>
            </div>
            <div>
                <label for="cooking_time">Cooking Time (minutes):</label>
                <input type="number" id="cooking_time" name="cooking_time" value='{{ $recipe->preparation_time }}' required>
            </div>
            <div>
                <label for="servings">Servings:</label>
                <input type="number" id="servings" name="servings" value='{{ $recipe->servings }}' required>
            </div>
            <div>
                <label for="difficulty">Difficulty:</label>
                <select id="difficulty" name="difficulty" required>
                    <option value="">Select Difficulty</option>
                    <option value="Easy" {{ $recipe->difficulty == 'Easy' ? 'selected' : '' }}>Easy</option>
                    <option value="Medium" {{ $recipe->difficulty == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="Hard" {{ $recipe->difficulty == 'Hard' ? 'selected' : '' }}>Hard</option>
                </select>
            </div>
            <button type='submit'>Save Recipe</button>
        </form>
    </div>
</x-layout>