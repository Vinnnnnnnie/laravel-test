<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <footer class='bg-gray-100 border-gray-500 dark:bg-gray-900 border-t-1'>
        <div class="flex justify-center gap-12 p-12 text-center align-middle dark:text-gray-300 text-gray-700">
            <div>
                <h3 class="text-xl font-bold">Projects</h3>
                <ul>
                    <li>
                        <a href='https://vinnie.fyi' class='font-bold'>Portfolio Website</a>
                    </li>
                    <li>
                        <a href='https://www.github.com/Vinnnnnnnie'>GitHub</a>
                    </li>
                    <li>
                        <a href='https://ldjam.com/users/vinnnie/'>Ludum Dare</a>
                    </li>
                    <li>
                        <a href='https://www.linkedin.com/in/vincent-owens-653685264/'>LinkedIn</a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-bold">Documentation</h3>
                <ul>
                    <li>
                        <a href='https://laravel.com/docs/12.x/installation'>Laravel</a>
                    </li>
                    <li>
                        <a href='https://inertiajs.com/docs/v2/getting-started'>InertiaJS</a>
                    </li>
                    <li>
                        <a href='https://vuejs.org/guide/introduction.html'>Vue</a>
                    </li>
                    <li>
                        <a href='https://tailwindcss.com/docs/installation/using-vite'>TailwindCSS</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</template>