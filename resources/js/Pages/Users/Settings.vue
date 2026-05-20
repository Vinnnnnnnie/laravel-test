<script setup>
import RecipeLayout from '../Components/RecipeLayout.vue';

</script>
<template>
    <RecipeLayout>
        <div class="flex flex-col">
            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-sm flex flex-row gap-4">
                <div>
                    <h2>Settings</h2>
                    <section class="border-1 border-red-500 p-4 w-full rounded-sm my-2">
                        <h3 class="mb-2">Danger Zone</h3>
                        <button class="p-3 flex gap-2 align-baseline self-center items-center cursor-pointer rounded-sm  bg-red-500 hover:bg-red-500 font-semibold">Delete Account</button>
                        <desc>This will delete your account and all of your recipes</desc>
                    </section>
                </div>

            </div>
        </div>
        
    </RecipeLayout>
</template>