@props(
    ['recipes' => NULL,
    'pagination' => true]
)
<ul class='2xl:grid 2xl:grid-cols-2 flex flex-col gap-4'>
    @foreach($recipes as $recipe)
        <li class='col-span-1 row-span-1'>
            {{-- If recipe has a lot of likes, could have a fire border,
            if it is new, it could have a blue new border,
            if it is disliked a lot, give it a controversial border --}}
            {{-- Border or tag I suppose --}}
            <x-card href="{{ route('recipes.show', $recipe) }}" 
                :user='$recipe->user_id === auth()->user()->id' 
                :friend='session("friendslist")->pluck("friend_user_id")->contains($recipe->user_id)'
                :recipe='$recipe'
            />
        </li>
    @endforeach
</ul>
@if($pagination)
{{  $recipes->links() }}
@endif