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
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div href="{{ route('recipes.show', $recipe) }}">
            <div style='display:flex;flex-direction:column;gap:0.5rem;'>
                <div class='flex flex-row gap-2' style='flex-direction:row'>
                    <img src='{{ route('image.users',$recipe->user->image_path) }}' class='w-20 max-w-20'>
                    <div>
                        <strong>{{ $recipe->user->name }}</strong>
                        <p>{{ count($recipe->user->recipe) }} @if (count($recipe->user->recipe) > 1)Recipes @else Recipe @endif</p>
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
                    {{-- <a class='btn' href="{{ route('recipes.edit') }}">Edit Recipe</a> --}}
                    <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class=btn type="submit">Delete Recipe</button>
                    </form>
                    <a class='btn' href="{{ route('recipes.index') }}">Back to all Recipes</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if($recipe->comment)
        @foreach($recipe->comment as $comment)
            <x-comment :highlight='$recipe->user_id === $comment->user_id'>
                <div class="">
                    <img src='{{ route('image.users', $comment->user->image_path) }}' class='w-20 max-w-20'>
                </div>
                <div class="w-full">
                    <h5><strong>{{ $comment->user->name }}</strong></h5>
                    {{ $comment->comment }}
                </div>
            </x-comment>
        @endforeach
    @endif
    <div>
        <img src='{{ route('image.users', auth()->user()->image_path) }}' class='w-20 max-w-20'><strong>{{ auth()->user()->name }}:</strong>
        <form action='{{ route('comments.store', $recipe) }}' method='POST'>
            @csrf
            <input type='hidden' name='recipe_id' value='{{ $recipe->id }}'>
            <textarea name='comment' class='w-full' placeholder='Add your comment here...' required></textarea>
            <button class='btn' type='submit'>Submit Comment</button>
        </form>
    </div>
</x-layout>