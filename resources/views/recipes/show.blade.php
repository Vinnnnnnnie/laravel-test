<x-recipe-layout>
    <div class="card p-4">
        <div class='w-full flex flex-col gap-4'>
                <div class='flex flex-row gap-2'>
                    <x-profile-picture
                        :size='30'
                        :image='$recipe->user->image_path'
                    />
                    <div>
                        <strong>{{ $recipe->user->name }}</strong>
                        <p>{{ count($recipe->user->recipes) }} @if (count($recipe->user->recipes) > 1)Recipes @else Recipe @endif</p>
                        <p>{{ $recipe->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class='flex flex-col-reverse w-full xl:flex-row gap-4'>
                    {{-- Recipe Details --}}
                    <div class='flex-1 flex-col flex gap-2'>
                        <h2>{{ $recipe->title }}</h3>
                        <p><strong>Prep Time: </strong>{{ $recipe->preparation_time}} Minutes</p>
                        <p><strong>Cook Time: </strong>{{ $recipe->cooking_time}} Minutes</p>
                        <p><strong>Difficulty: </strong>{{$recipe->difficulty}}</p>
                        <div>
                            <h4 class='text-xl font-semibold'>Ingredients</h4>
                            <pre class='font-sans text-wrap'>{{ $recipe->ingredients }}</pre>
                        </div>
                        <div>
                            <h4 class='text-xl font-semibold'>Instructions</h4>
                            <pre class='font-sans text-wrap'>{{ $recipe->instructions }}</pre>
                        </div>
                        {{-- Recipe Tags --}}
                        @if($recipe->tags)
                        <h4 class='text-xl font-semibold'>Tags</h4>
                        <ul class='flex flex-row gap-2'>
                            @foreach ($recipe->tags as $tag)
                                <span class='bg-blue-500 text-white p-2 rounded-md'>{{ $tag->name }}</span>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    {{-- Image and Container --}}
                    <div class='dark:bg-gray-950 bg-gray-50 w-full flex flex-1 justify-center align-items-center'>
                        <img src='{{ route('image.recipes',$recipe->image_path) }}' class='w-100 max-w-100'>
                    </div>
                </div>
                {{-- Buttons --}}
                <div class='flex gap-2'>
                    @if (Auth::id() === $recipe->user->id)
                    <a class='btn' href="{{ route('recipes.edit', $recipe) }}">Edit Recipe</a>
                    <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class=btn type="submit">Delete Recipe</button>
                    </form>
                    @endif
                    @if($recipe->savedUsers()->get()->contains(auth()->user()->id))
                    <form action='{{ route('users.removeSavedRecipe', $recipe) }}' method='post'>
                        @csrf
                        <input type='submit' class="btn bg-green-500" value='Remove Saved Recipe'>
                    </form>
                    @else
                    <form action='{{ route('users.addSavedRecipe', $recipe) }}' method='post'>
                        @csrf
                        <input type='submit' class="btn bg-green-500" value='Save Recipe'>
                    </form>
                    @endif
                    <a class='btn' href="{{ route('recipes.index') }}">Back to all Recipes</a>
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
        <x-profile-picture
            :size='20'
            :image='auth()->user()->image_path'
        />
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
