<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script> {{-- POWERFUL APLINE --}}

</head>

<body>
    <x-mine.nav />
    <div class="grid grid-cols-12 h-[calc(100vh-48px)] ">
        <aside class="xl:col-span-2 md:col-span-4 col-span-12 border border-gray-200 bg-gray-100 flex w-full">
            <x-mine.sidebar />
        </aside>
        <main class="xl:col-span-10 md:col-span-8">
            <x-pages.home />
        </main>
    </div>

</body>

</html>
