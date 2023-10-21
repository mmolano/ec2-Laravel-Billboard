<div x-data="{ openModal: false }">
    <button @click="openModal = ! openModal"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        + メッセージ
    </button>
    <div x-cloak x-show="openModal" tabindex="-1" x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full bg-[#50494952]">
        <div class="relative w-full max-w-2xl max-h-full m-auto mt-1">
            <div @click.outside="openModal = false" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">
                        新しいメッセージ
                    </h2>
                    <button type="button" @click="openModal = false"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="defaultModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form class="mb-6" method="POST" action="{{ route('post') }}">
                        @csrf
                        <label for="title" class="sr-only">タイトル</label>
                        <input id="title" name="title" type="text" minlength="6"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:border-gray-700 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                            placeholder="タイトルを書く..." required></input>
                        <div
                            class="mt-4 py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <label for="content" class="sr-only">コンテンツ</label>
                            <textarea id="content" rows="6" name="content" minlength="2"
                                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                placeholder="コンテンツを書く..." required></textarea>
                        </div>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            メッセージ作成
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
