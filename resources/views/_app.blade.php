<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <livewire:styles>
</head>

<body>
    <div class="flex h-screen overflow-hidden">
        <x-sidebar />
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden" x-ref="contentarea">
            <div class="grid grid-cols-12 gap-6">
                <livewire:user-search />
            </div>
        </div>
        <livewire:scripts>
</body>

</html>
