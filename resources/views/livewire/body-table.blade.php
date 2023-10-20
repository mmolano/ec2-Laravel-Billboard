<div wire:id="body-table">

    <div class="p-3 mt-5">
        <div class="overflow-x-auto">
            <div class="max-w-6xl m-auto">
                <section class="my-4">
                    <form wire:submit.prevent="render">
                        <div class="flex" x-data="{ openDrop: false }">
                            <button @click="openDrop = !openDrop"
                                class="relative flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                                type="button">すべて <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg></button>
                            <div @click.outside="openDrop = false" @keydown.escape.window="openDrop = false"
                                x-show="openDrop" x-transition:enter="transition ease-out duration-200 transform"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-out duration-200"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="absolute top-[97px] z-15 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdown-button">
                                    <li>
                                        <button type="button"
                                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">タイトル</button>
                                    </li>
                                    <li>
                                        <button type="button"
                                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">登録者</button>
                                    </li>
                                    <li>
                                        <button type="button"
                                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">コメント</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="relative w-full">
                                <input wire:model="search" type="search" id="search-dropdown"
                                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                                    placeholder="検索...">
                                <button type="submit"
                                    class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </section>
                @if (session('success') || $errors->hasAny('custom'))
                    @php
                        $bgColor = session('success') ? 'green' : 'red';
                        $textColor = session('success') ? 'green' : 'red';
                        $message = session('success') ?: $errors->first('custom');
                    @endphp
                    <div class="bg-{{ $bgColor }}-100 text-{{ $textColor }}-600 px-3 py-2 rounded mb-2">
                        <span class="text-sm font-bold">{{ $message }}</span>
                    </div>
                @elseif ($errors->any())
                    <div class="bg-red-100 text-red-600 px-3 py-2 rounded mb-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-sm font-bold">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div
                    class="col-span-full xl:col-span-6 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                    <header class="flex justify-between px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                        <h2 class="font-semibold text-slate-800 dark:text-slate-100">掲示版のリスト</h2>
                        <x-modal-new />
                    </header>
                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead
                                    class="text-xs font-semibold uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">登録者</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">タイトル</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">コメント</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-center">登録日時</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-center">Actions</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-slate-100 dark:divide-slate-700">
                                    @foreach ($posts as $post)
                                        <x-table-row :post="$post" />
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-3 sm:m-10">
                {{ $posts->withQueryString()->links('livewire::tailwind') }}
            </div>
        </div>
    </div>
</div>
