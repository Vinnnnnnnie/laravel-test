<x-recipe-layout>
    <div class="card">
        <div href="{{ route('recipes.show', $recipe) }}">
            <div style='display:flex;flex-direction:column;gap:0.5rem;'>
                <div class='flex flex-row gap-2' style='flex-direction:row'>
                    <img src='{{ route('image.users',$recipe->user->image_path) }}' class='w-20 max-w-20'>
                    <div>
                        <strong>{{ $recipe->user->name }}</strong>
                        <p>{{ count($recipe->user->recipes) }} @if (count($recipe->user->recipes) > 1)Recipes @else Recipe @endif</p>
                        <p>{{ $recipe->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <h3>{{ $recipe->title }}</h3>
                <img src='{{ route('image.recipes',$recipe->image_path) }}' class='w-100 max-w-100'>
                <p><strong>Prep Time: </strong>{{ $recipe->preparation_time}} Minutes</p>
                <p><strong>Cook Time: </strong>{{ $recipe->cooking_time}} Minutes</p>
                <p><strong>Difficulty: </strong>{{$recipe->difficulty}}</p>
                <p><strong>Ingredients: </strong>{{ $recipe->ingredients }}</p>
                <p><strong>Instructions: </strong>{{ $recipe->instructions }}</p>
                <div class='flex gap-2'>
                    @if (Auth::id() === $recipe->user->id)
                    <a class='btn' href="{{ route('recipes.edit', $recipe) }}">Edit Recipe</a>
                    <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class=btn type="submit">Delete Recipe</button>
                    </form>
                    @endif
                    <a class='btn' href="{{ route('recipes.index') }}">Back to all Recipes</a>
                </div>
            </div>
        </div>
    </div>
    @if($recipe->comments)
        @foreach($recipe->comments as $comment)
            <x-comment 
                :highlight='$recipe->user_id === $comment->user_id' 
                :user='$comment->user_id === auth()->user()->id' 
                :friend='session("friendslist")->pluck("friend_user_id")->contains($comment->user_id)'
                :comment='$comment'
            />
        @endforeach
    @endif
    <div class='bg-gray-50 items-center p-3 flex ml-12 mt-4 dark:bg-gray-700 dark:text-gray-200 gap-2'>
        <div>
            <img src='{{ route('image.users', auth()->user()->image_path) }}' class='w-20 max-w-20'>
        </div>
        <div class='w-full'>
            <strong>{{ auth()->user()->name }}</strong>
            <form action='{{ route('comments.store', $recipe) }}' method='POST'>
                @csrf
                <input type='hidden' name='recipe_id' value='{{ $recipe->id }}'>
                <textarea name='comment' class='w-full' placeholder='Add your comment here...' required></textarea>
                <button class='btn' type='submit'>Submit Comment</button>
            </form>
        </div>
    </div>
</x-recipe-layout>
