<x-layout>
    <h2>Create a New Recipe</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class='px-4 py-2 bg-red-200 rounded-lg'>
                @foreach ($errors->all() as $error)
                    <li class='text-red-500'>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="flex">
        <img id='image-preview' src='' width='400px'>
        <form class='flex form gap-2' method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
            @csrf
            <div hidden>
                <label for="user_id" class='form-label'>User Id</label>
                <input type="text" id="user_id" name="user_id" class='form-control w-full' value='{{ auth()->user()->id }}' required>
            </div>
            <div>
                <label for="title" class='form-label'>Recipe Title</label>
                <input type="text" id="title" name="title" class='form-control w-full' value='{{ old('title') }}' required>
            </div>
            <div>
                <label for="ingredients" class='form-label'>Ingredients</label>
                <textarea id="ingredients" name="ingredients" class='form-control w-full' required>{{ old('ingredients') }}</textarea>
            </div>
            <div>
                <label for="instructions" class='form-label'>Instructions</label>
                <textarea id="instructions" name="instructions" class='form-control w-full' required>{{ old('instructions') }}</textarea>
            </div>
            <div>
                <label for="preparation_time" class='form-label'>Preparation Time (minutes)</label>
                <input type="number" id="preparation_time" class='form-control w-full' name="preparation_time" value='{{ old('preparation_time') }}' required>
            </div>
            <div>
                <label for="cooking_time" class='form-label'>Cooking Time (minutes)</label>
                <input type="number" id="cooking_time" class='form-control w-full' name="cooking_time" value='{{ old('cooking_time') }}' required>
            </div>
            <div>
                <label class='form-label' for="servings">Servings</label>
                <input type="number" id="servings" name="servings" class='form-control w-full' value='{{ old('servings') }}' required>
            </div>
            <div class='w-full'>
                <label class='form-label'>Difficulty</label>
                <div class="flex  mb-2">
                    <input name="difficulty" id='easy' type="radio" value="Easy" {{ old('difficulty') == 'Easy' ? 'checked' : '' }}>
                    <label class='form-label' for="easy">Easy</label>
                </div>
                <div class="flex  mb-2">
                    <input name="difficulty" id='medium' type="radio" value="Medium" {{ old('difficulty') == 'Medium' ? 'checked' : '' }}>
                    <label class='form-label' for="medium">Medium</label>
                </div>
                <div class="flex  mb-2">
                    <input name="difficulty" id='hard' type="radio" value="Hard" {{ old('difficulty') == 'Hard' ? 'checked' : '' }}>
                    <label class='form-label' for="hard">Hard</label>
                </div>
            </div>
            <div>
                <label for="image" class='form-label'>Image</label>
                <input type="file" id="image" class='form-control w-full' name="image">
            </div>

            <button type="submit" class='btn'>Create Recipe</button>
        </form>
    </div>

    
</x-layout>
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
