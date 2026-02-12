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
    <div class="bg-gray-100 dark:bg-gray-900 p-4 flex flex-col">
        <h2>Edit Recipe</h2>
        <form class='flex flex-col gap-4' action='{{ route('recipes.update', $recipe->id) }}' method='POST' enctype="multipart/form-data">
            @csrf
            <div class='dark:bg-gray-950 bg-gray-50 w-full flex justify-center align-items-center'>
                <img id='image-preview' src='{{ route('image.recipes',$recipe->image_path) }}' class='aspect-auto h-fit max-h-80 self-center'>
            </div>            
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
            <ul class=" select-none  flex flex-row gap-2 flex-wrap">
                @php // There must be a way to do this in the other foreach
                $recipeTagIds = [];
                    foreach ($recipe->tags as $tag)
                    {
                        $recipeTagIds[] = $tag->id;
                    }
                @endphp
                @foreach($tags as $tag)
                <li >
                    <input {{ in_array($tag->id, $recipeTagIds) ? 'checked' : '' }} type="checkbox" id="{{ $tag->id }}" name='tags[{{ $tag->id }}]' class="hidden peer" />
                    <label for="{{ $tag->id }}" class="select-none bg-gray-500 cursor-pointer flex items-center justify-center rounded-lg  
                            py-3 px-6 font-bold transition-colors duration-200 ease-in-out peer-checked:bg-blue-500  ">
                            <span>{{ $tag->name }}</span>
                    </label>
                </li>
                @endforeach
            </ul>
            <button class='bg-gray-200 dark:bg-gray-800 p-2' type='submit'>Save Recipe</button>
        </form>
    </div>
</x-recipe-layout>
<script>
    function readURL(input) {
        if (input.target.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                document.getElementById('image-preview').src = e.target.result;
            }
            
            reader.readAsDataURL(input.target.files[0]);
        }
    }
    document.getElementById('image').addEventListener('change', (e) => {
        readURL(e);
    })
</script>