<x-recipe-layout>
    <div class='flex justify-between mb-4 gap-8'>
        {{-- Recipe Body --}}
        <div class='w-full'>
            <h2>Recent Recipes</h2>
            {{-- Recipe List --}}
            <x-recipe-list
                :recipes='$recipes'
            />
        </div>
    </div>
</x-recipe-layout>
