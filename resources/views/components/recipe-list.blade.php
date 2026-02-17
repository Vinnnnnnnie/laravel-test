@props(
    ['recipes' => NULL,
    'pagination' => true]
)
@php
    $user = auth()->user();
@endphp
<ul class='2xl:grid 2xl:grid-cols-2 flex flex-col gap-4'>
    @if(count($recipes) > 0)
        @foreach($recipes as $recipe)
            <li class='col-span-1 row-span-1'>
                {{-- If recipe has a lot of likes, could have a fire border,
                if it is new, it could have a blue new border,
                if it is disliked a lot, give it a controversial border --}}
                {{-- Border or tag I suppose --}}
                <x-card href="{{ route('recipes.show', $recipe) }}" 
                    :user='$recipe->user_id === $user->id' 
                    :friend='$user->friends()->get()->contains($recipe->user_id)'
                    :saved='$user->savedRecipes()->get()->contains($recipe->id)'
                    :recipe='$recipe'
                />
            </li>
        @endforeach
    @else
            <li>
                <span class='text-3xl py-4'>
                    No recipes found. Why not 
                    <a class='btn flex flex-row gap-2' href="{{ route('recipes.create') }}"><x-bi-plus-circle/> Create a New Recipe?</a>
                </span>

            </li>
    @endif
</ul>
@if($pagination)
{{  $recipes->links() }}
@endif