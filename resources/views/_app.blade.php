<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
    initial-scale=1, shrink-to-fit=no, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Laravel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <livewire:styles>
        <style>
            [x-cloak] {
                display: none !important;
            }

            body {
                overscroll-behavior: auto;
            }
        </style>
        <script>
            if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
                document.querySelector('html').classList.remove('dark');
                document.querySelector('html').style.colorScheme = 'light';
            } else {
                document.querySelector('html').classList.add('dark');
                document.querySelector('html').style.colorScheme = 'dark';
            }
        </script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="dark:bg-gray-800">
    <x-layouts-header />
    <div class="flex h-screen overflow-hidden">
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden" x-ref="contentarea">
            <livewire:body-table />
        </div>
        <livewire:scripts>
</body>

</html>
