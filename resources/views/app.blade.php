<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @routes
        @vite('resources/js/app.js')
        @vite('resources/css/app.css')
        @inertiaHead
    </head>
    <body class='bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-100 font-sans'>
        @inertia
    </body>
</html>