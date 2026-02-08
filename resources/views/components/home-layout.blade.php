@php
    $page = request()->segment(1);
    if ($page === NULL)
    {
        $page = 'home';
    }
@endphp
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>vinnie.fyi</title>
    @vite('resources/css/app.css')
</head>
<body class='bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-100 font-sans'>
    <x-header/>
    <main class='items-center striped-background'>
        <div class='grid grid-cols-12 divide-solid divide-x-1 divide-gray-500 justify-between gap-8 '>
            {{-- <div class="col-start-1 col-span-2 bg-gray-800"></div> --}}
            <div class='col-start-2 col-span-10 flex-2 gap-4 bg-gray-200 dark:bg-gray-800 border-gray-500 p-4 border-x-1'>
                
                {{ $slot }}
            </div>
            {{-- <div class="col-start-11 col-span-2 bg-gray-800 border-l-1 border-gray-500"></div> --}}
        </div>
    </main>
    <x-footer/>
</body>
</html>
